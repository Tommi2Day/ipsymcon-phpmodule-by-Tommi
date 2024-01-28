# Perl/PHP Wrapper for IP-Symcon function calls
 
 This wrapper helps you to execute scripts written for IPSymcon also on other PHP boxes
 using IPSymcon JSON API. It defines all of known functions and will map this to a JSON call.
 
 ### Requirements:
 * Symcon (https://www.symcon.de/en/) Version 6.0+
 * PHP 8.0+ (https://www.php.net/)
 * PHP JSON extension (https://www.php.net/manual/en/book.json.php)
 * MBString extension (https://www.php.net/manual/en/book.mbstring.php)
 
### Usage:
 
```
//include wrapper only if not in native IPS
if (!function_exists('IPS_GetKernelVersion')) {
//we are outside of IPS and need the JSON wrapper
include('ips_wrapper.php');
}
//now you can call ips functions as usual
$version=IPS_GetKernelVersion();
print $version;
```
 
### Prepare
 - install mbstring extension (`apt-get install php-mbstring`)
 - enable IPS remote access from   [IPS Tray](https://www.symcon.de/service/dokumentation/komponenten/tray/fernzugriff/)
 - create a new script object with the content of gen_ips_wrapper.php using
  [IPS console](http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/)
 - run this script as usual
 - grab  the generated ips_wrapper.php file from IPSymcon scripts folder
 - All ips function headers are listed in ips_wrapper.php. You need to include the class file IPS_JSON.php as well.
 - you may create an additional file IPS_JSON_config.cfg which will summarize your JSON API settings as below.
 This will have precendence over the generated values.
```
$config='IPS_JSON_config.cfg';
// IPsymcon API Definitions
$host='localhost';
$port='3777';
$user='license user name/email';
$password='remote-access';
```
 

### Examples:
 
  #### general examples
 
 - [test_ips_wrapper.php](examples/test_ips_wrapper.php): simple test function call
 - [IPS_JSON_config.cfg](examples/IPS_JSON_config.cfg): configuration file example
 - [run_ips_script.pl](examples/run_ips_script.pl): Perl example to start an IPS internalscript
 - [run_ips_script.php](examples/run_ips_script.php):  PHP example to start an IPS internalscript

 #### Icinga/Nagios examples

  - [check_ips_json.php](examples/check_ips_json.php): simple php check script for Icinga/Nagios
  - [check_ips_json.pl](examples/check_ips_json.pl): simple perl check script for Icinga/Nagios
  - [check_ips_temperature_json.pl](examples/check_ips_temperature_json.pl): read an IPS temperature sensor for Icinga/Nagios
  - [check_ips_sample_json.txt](examples/check_ips_sample_json.txt): icinga/nagios check configuration steps
 
 #### additional documentation
 You may generate additional documentation using <a href="http://www.stack.nl/~dimitri/doxygen/index.html"> Doxygen</a>
 ```
 cd doc
 doxygen doc_wrapper.doxygen
 ```
 see [generated output](http://www.tdressler.net/ipsymcon/docs/doc_wrapper/html/)
 
 #### see also (mostly in german)
  - examples in [examples](examples)
  - [JSON Wrapper Homepage](http://www.tdressler.net/ipsymcon/jsonapi.html)
  - [Symcon API](http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/)
  
 ### License:
  CC By-NC 4.0 (http://creativecommons.org/licenses/by-nc/4.0/)