#!/usr/bin/perl -w
# Mapper class for IP-Symcon JSON API
# see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
# (C) Thomas Dressler 2013-2016 www.tdressler.net/ipsymcon
# requires IPSymcon V4.0+
# V4.0 30.04.2016

package IPS_JSON;
use strict;
use REST::Client;
use MIME::Base64;
use JSON;
use Carp;
use Encode; #utf8
use base 'Exporter';
use Data::Dumper;
use vars qw($VERSION @EXPORT @EXPORT_OK @ISA);

@ISA = qw(Exporter);
@EXPORT = qw(get_vars query_ips setUrl setTimeout getError get_script getDebug);
@EXPORT_OK = qw{%ips_vartypes};
$VERSION="V4.1 14.05.2016";


our %ips_vartypes=(0=>'ValueBoolean',
		   1=>'ValueInteger',
		   2=>'ValueFloat',
		   3=>'ValueString',
		   4=>'ValueArray',
		   5=>'ValueVariant');
sub new {
    my $class=shift;
    my $url=shift||'http://localhost:82/api/';
    my $user=shift;
    my $pass=shift;
	my $timeout=shift||2;
    my $self={Url=>$url,Timeout=>$timeout,Username=>$user,Password=>$pass,Error=>undef,Debug=>$ENV{DEBUG}};
    bless $self,$class;
    return $self;
}

#auto loader
sub AUTOLOAD {
    our $AUTOLOAD;
    my $this=shift;
    my @params = @_;

    # return immediately if called as the DESTROY method
    return if $AUTOLOAD =~ /::DESTROY$/;
    # is this a get method
    if ( $AUTOLOAD =~ /.*::get(\w+)/ ) {
        if ( exists $this->{$1} ) {
            return $this->{$1};
        } else {
            warn(ref($this) . q(::AUTOLOAD: 'get' variable/method not found));
            return undef;
        } # if ( exists $this->{$1} )
    } # if ( $AUTOLOAD =~ /.*::get(_\w+)/ )
    #set method
    if ( $AUTOLOAD =~ /.*::set(\w+)/ ) {
        $this->{$1} = $params[0];
        return $this->{$1};
    } # $AUTOLOAD =~ /.*::set(_\w+)/ and do
    if ( $AUTOLOAD =~ /.*::(\w+)$/ ) {
	my $method=$1;
	return $this->query_ips($method,@params);
    } # $AUTOLOAD =~ /.*::IPS_(_\w+)/ and do
    warn(ref($this) . qq(: no such attribute: $AUTOLOAD));
} # sub AUTOLOAD


#-----API Call-------
#ask IPS using JSON API
sub query_ips {
        my $this=shift;
	my $method=shift;
	my @arguments=@_;
	my $error;
	my $user=$this->getUsername;
	my $pass=$this->getPassword;
	my $auth=encode_base64($user. ':' . $pass );
	my $json=JSON->new();
	#http headers
	my $headers = { 'Accept' =>'application/json',
			'Content-type'=> 'application/json; charset=utf-8',
			'Authorization' => 'Basic '.$auth  };
	#api function definition
	my $rpc = {
         "jsonrpc" => "2.0",
         "method" => $method,
         "params" => \@arguments,
         "id" => "null"
	};
	#reset error
	$this->setError(undef);
	#build json string
	my $params=$json->encode($rpc);
	#build query object
	my $client = REST::Client->new();
	$client->setTimeout($this->getTimeout);
	#action
	print "POST ".$this->getUrl." User: $user Content: $params \n" if ($this->getDebug);
	$client->POST( $this->getUrl , $params , $headers );
	#get answer
	my $response=$client->responseContent();
	print "Response: $response\n" if ($this->getDebug);
	#check if it looks like json
	if ($response=~/^{"/) {
		#looks good, try to decode
		my $answer=$json->decode($response);
		#any error codes
		$this->setError($answer->{error}->{message});
		print "Answer Error: ".$this->getError ."\n" if ($this->getDebug && $this->getError);
		return $answer->{result};	#code
	}else{
		#not json, must be an error
		($error)=split(/\n/,$response);
		$this->setError($error);
		print "Response Error: $error \n" if ($this->getDebug);
		return undef;
	}
	
}

#---------full variable access -----------
#get variable details by subsequent call of IPS_GetObject,IPS_GetVariable and IPS_GetVariableProfile
sub get_var {
    my ($this,$id)=@_;
    my ($res,$error);
	$res=$this->IPS_VariableExists($id);
	if (!defined($res)) {
	    $error=$this->getError;
	    $this->setError("IPS_VariableExists Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	if (!$res) {
	    $this->setError( "Variable $id doesnt exist");
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	#query object detail
	my $obj=$this->IPS_GetObject($id);
	if (!$obj) {
		$error=$this->getError;
		$this->setError("IPS_GetObject Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	my $name=$obj->{ObjectName};
	#name should not have spaces
	if ($name) {
		$name=~ s/\s+/,/g;
	}else{
		$name='Value';
	}
	#query variable details
	my $var=$this->IPS_GetVariable($id);
	if (!$var) {
		$error=$this->getError;
		$this->setError("IPS_GetVariable Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	
	#type aware value retrieving
	my $type=$var->{VariableType};
	my $typname=$IPS_JSON::ips_vartypes{$type};
	$res=$this->GetValue($id);
	
	#update time
	my $last=$var->{VariableUpdated};
	#suffix
	my $suffix='';
	my $digits=undef;
	my $profilename=$var->{VariableCustomProfile}||$var->{VariableProfile};
	if ($profilename) {
		#query variable profile
		my $profile=$this->IPS_GetVariableProfile($profilename);
		if ($profile) {
			$suffix=$profile->{Suffix};
			$digits=$profile->{Digits};
		}
		 
	}
	my $data={'value'=>$res,'type'=>$type,'last'=>$last,'name'=>$name,'suffix'=>$suffix,'digits'=>$digits};
	return $data;

}
#---------script details -----------
#get script details by subsequent call of IPS_GetObject and IPS_GetScript
sub get_script {
	my ($this,$id)=@_;
    my ($res,$error);
	$res=$this->IPS_ScriptExists($id);
	if (!defined($res)) {
	    $error=$this->getError;
	    $this->setError("IPS_ScriptExists Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	if (!$res) {
	    $this->setError( "Script $id doesnt exist");
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	#query object detail
	my $obj=$this->IPS_GetObject($id);
	if (!$obj) {
		$error=$this->getError;
		$this->setError("IPS_GetObject Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	my $name=$obj->{ObjectName};
	#name should not have spaces
	if ($name) {
		$name=~ s/\s+/,/g;
	}else{
		$name='Value';
	}
	#query variable details
	my $var=$this->IPS_GetScript($id);
	if (!$var) {
		$error=$this->getError;
		$this->setError("IPS_GetScript Request failed:".$error);
		print "Error: ".$this->getError." \n" if ($this->getDebug);
		return undef;
	}
	#update time
	my $last=$var->{LastExecute};
	my $file=$var->{ScriptFile};
	my $is_broken=$var->{IsBroken};
	my $data={'last'=>$last,'name'=>$name,'file'=>$file,'is_broken'=>$is_broken};
	return $data;
}
#-----helper ---------
#check if is it a string
sub is_string {
	my ($this,$s)=@_;
	my $ret=0;
	if ((ref \$s eq 'SCALAR') && (length($s)>0)) {
		$ret= 1 if not (is_float($s));
	}
	
	
	return $ret;
}
#check if it an integer
sub is_int {
	my ($this,$s)=@_;
	my $ret=0;
	if ($s && (ref \$s eq 'SCALAR') && (length($s)>0)) {
		$ret=1 if ($s=~/^[0-9\s]+$/) ;
	}
	return $ret;
}
#check if it a float, also matches integers
sub is_float {
	my ($this,$s)=@_;
	my $ret=0;
	if ($s && (ref \$s eq 'SCALAR') && (length($s)>0)) {
		$ret=1 if ($s=~/^[0-9\.\s]+$/) ;
	}
	return $ret;
	
}
#array_walk_rekursive helper
sub obj_map
{
#http://belski.net/archives/16-Map-objects-recursive-in-perl.html
    my $this=shift;
    my $obj = shift;
    my $fn = shift;
 
    if( "HASH" eq ref $obj ) {
        while( my ( $k, $v ) = each %$obj ) {
            $obj->{$k} = $this->obj_map( $v, $fn, @_ );
        }
    } elsif ( "ARRAY" eq ref $obj ) {
        my $i = 0;
        foreach my $v ( @$obj ) {
            @$obj[$i++] = $this->obj_map( $v, $fn, @_ );
        }
    } else {
        return &$fn( $obj, @_ );
    }
 
 
    return $obj;
}
#convert to/from json types
sub bool {
     my ($this,$s)=@_;
     #return($s)?\1:\0;
     return($s)?JSON::true:JSON::false;
}
sub from_bool {
     my ($this,$s)=@_;
	 my $ret;
	 if (JSON::is_bool($s)) {
		$ret=($s eq JSON::true)?1:0;
	 }else{
		$ret=undef;
	 }
	 return $ret
}
#convert to float
sub float {
     my ($this,$s)=@_;
     $s=$s*1.0 if is_int($s);
     return($s);
}
sub integer {
	my ($this,$s)=@_;
     $s=$s+0 if is_int($s);
     return($s);
}

1;
__END__

=pod

=head1 NAME

IPS_JSON - Wrapper around IPSymcon JSON API

=head1 SYNOPSIS

	$ips=IPS_JSON->new($url,$user,$password,2);
	print $ips->IPS_GetKernelVersion();
	$obj=$ips->IPS_GetObject($objectid);
	if ($obj) {
		print $obj->{ObjectName};
	}else{
		print "Error:".$ips->getError;
	}

=head1 DESCRIPTION

This package utilizes IPSYMCON Json API as of IPsymcon V3.1 (Feb 2014)

=head2 new($url,$timeout)

constructor

=over 6

=item $url

full url for accessing IPSymcon JSON API. This url may contain the username/password if defined

=item $timeout

Timeout for query (default 2s)

=item samples

	$host="ipshost";
	$port="82";
	$user='lizenz@email.ips';
	$password='fernsteuer-password';
	$url="http://".$host.":".$port."/api/";#need trailing slash!
    	$ips=IPS_JSON->new($url,$user,$password,2); >>

=back

=head2 get* and set*(<value>)

Access to class variables.The following class variables exists

=over 6

=item Url

supplied URL string)

=item Username

Lizenz Benutzername (e.g. Email)

=item Password

Fernkonfigurations Kennwort 

=item Timeout

timeout value (default 2s)

=item Error

Error messages (if any)

=back

=head2 <ips_method>(<ips_parameters>)

calling any IPSymcon function via JSON API using perl AUTOLOAD

=over 6

=item ips_method

IPSymcon function to be called

=item ips_parameter

list of parameters needed for the choosed IPSymcon function

=item samples

	print $ips->IPS_GetKernelVersion(); 

	$obj=$ips->IPS_GetObject($objectid);
    	if ($obj) {
		print $obj->{ObjectName};
    	}else{
		print "Error:".$ips->getError;
    	}

=back

=head2 $var=get_var($id)

retrieves variable details as hash reference

=over 6

=item $id

integer $id: IPS Variable ID

=item return

$var={'value'=>Value of Variable,'type'=>Type of,'last'=>Last Updated,'name'=>Name of,'suffix'=>Suffix,'digits'=>Digits (from Profile};

=back

=head2 $script=get_script($id)

retrieves Script details as hash reference

=over 6

=item $id

integer $id: IPS Script ID

=item return

$script={'last'=>Last executed,'name'=>Name of Script,'file'=>Filename of Script,'is_broken'=>Broken Indicator};

=back

=head1  SEE ALSO

L<http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/>

L<http://www.ip-symcon.de/service/dokumentation/befehlsreferenz/>

L<http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/>

=cut

