<?php
/**
 * @file
 *
 * Doxygen main page
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016-2018
 * @version 5.1.0
 * @date 2019-05-04
 */
/**
@mainpage Index

This is a Library of PHP Modules for the home automation software <a href="https://www.symcon.de">"Symcon"</a>

@section Library Overview
@image html PHPModules.png "Modul hierarchy"

@section Installation
@par "Github Modul URL:" https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi.git
@par Branch: 5.1

 - Within Symcon Konsole go to "Kern Instancen" ->Modules
 - Press "Hinzufügen" Button
 - Enter Module Repository "https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi.git"
 - Click on "Edit" Icon and change Branch(Zweig) to "5.1"

@section Devices

@subsection WSDEV

 WSDEV :Generic Weather Sensor Device Modul
 
 Displays depending of the capability of the connected sensor out of the following measures:
@snippet WSDEV/module.php capvars

@par Prefix: WSD_
@par Properties
- \b DeviceID: ID/Serial of the connected Device. Will be matched when receiving Data
- \b Typ: Typ/Model of the Device, if available. Will be matched when receiving Data
- \b Class: Class of the creator. Will be matched when receiving Data
- \b Caplist; Keywords of actual capabilies for matching status variables,
 seperated by semicolon, set by splitter. Idents must match definitions in $capvars
@par "Standard Actions:"
- \b None


@subsection EnergyDev

 EnergyDev :Generic Energy Sensor Device Modul
 
Displays depending of the capability of the connected sensor out of the following measures:
@snippet Energy/module.php capvars
@par Properties
- \b DeviceID: ID/Serial of the connected Device. Will be matched when receiving Data
- \b Typ: Typ/Model of the Device, if available. Will be matched when receiving Data
- \b Class: Class of the creator. Will be matched when receiving Data
- \b Caplist; Keywords of actual capabilies for matching status variables,
 seperated by semicolon, set by splitter. Idents must match definitions in $capvars

@par Standard Actions (if supported by the attached splitter and the physical device)
- \b None


@subsection SwitchDev

SwitchDev :Generic Device module to present weather data

Displays depending of the capability of the connected sensor out of the following measures:
@snippet Switch/module.php capvars

@par Prefix: SWD_
@par Properties
- \b DeviceID: ID/Serial of the connected Device. Will be matched when receiving Data
- \b Typ: Typ/Model of the Device, if available. Will be matched when receiving Data
- \b Class: Class of the creator. Will be matched when receiving Data
- \b CapList; Keywords of actual capabilies for matching status variables,
   seperated by semicolon, set by splitter. Idents must match definitions in $capvars.
    If the standard action for the matching status variable should be enable the Splitter should append ":1"
 to the capability to be send when creating an instance.
 @code
 IPS_SetProperty($id,'CapList','Switch:1;Timer;Dimer:1;');
 @endcode

@par "Standard Actions:"
(if supported by the attached splitter and the physical device. The Splitter must set the action flag in CapList property, see caplist)
- Switch Status
- Dimmer Intensity
- Timer

@par "Public Functions:"
- \b SetSwitchMode: raise a switch command
@code
SWD_SetSwitchMode($id,$newstate);
@endcode

- \b DimUp: Raise the level of  dimmer one step (up to 100%)
@code
SWD_DimUp($id);
@endcode

- \b DimDown : Lower the level of  dimmer one step (down to 0%)
@code
SWD_DimDown($id);
@endcode

- \b SetIntensity : Set the dimming Level in percent
@code
SWD_SetIntensity($id,$percent);
@endcode

- \b SetDuration : (FS20 via CUL only)  Switch to the given or opposite current state and reverse after time expires
@code
SWD_SetDuration($id,$seconds,$action=null);
@endcode
@section Splitter

@subsection WS300PC

WS300PC Splittermodul for reading ELV %WS300PC Datalogger. The Logger will be accessed via USB serial port.

@par "Supported Devices:"
The logger supports 8 external T/H WS300 Series Sensor (S300TH,PS50), one KS300 Kombisensor (T/H, Wind, Rain)
and the internal Indoor Sensor (T/H, Pressure, Forecast(Willi) Indicator).

@par "Data Handling:"
 The Data will be presented as Weather Device instances

@par Prefix: WS300PC_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default 'WS300PC Devices'):  name of category for subsequent devices
- \b Logfile (Default none): optional fully qualified filename of a logfile.
File will be in csv format with one line per sensor. Header will be in the first line

- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Debug: Flag to enable debug output via IPS_LogMessages
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b RainPerCount (Default 295): How much rain will be added for one count (mm/1000), Range: 200-500
- \b Altitude (Default 0): Altitude of location for pressure correction, Range: -130 - 8000
- \b ReadInterval (Default 5): internal Logging interval in min, Range: 5-30
@par "Public Functions:"
- \b Update: manual data refresh
@code
WS300PC_Update($id);
@endcode

- \b Get_Version: Returns WS300PC firmware version. Usefull for testing communication
@code
WS300PC_GetVersion($id);
@endcode

- \b ReadCurrentRecord($id): Read current Record from WS300PC
@code
WS300PC_ReadCurrentRecord($id);
@endcode

- \b WS300PC_ReadNextRecord($id): Read and delete oldest available historic record.
@code
WS300PC_ReadNextRecord($id);
@endcode

Reading all historic records at once will take a lot of time and exeeds usually max_execution_time. 
But you can execute it from outside of symcon using JSON API. see ws300pc_history.pl for an example.

- \b WriteConfig: Writes a new configuration record
(contains RainPerCount, Altitude and ReadIntervall to WS300PC. This will trigger a device reset and a 10min sync period)
@code
WS300PC_WriteConfig($id);
@endcode

 @see http://www.elv.de/PC-Funk-Wetterstation-WS-300-PC/x.aspx/cid_726/detail_32113 (german)

@subsection WDE1

WDE1 Splittermodul for reading ELV %WDE1 Datalogger.  The Logger will be accessed via serial port.

@warning This module is deprecated/unsupported as of 2017. I dont have this anymore.


@par "Supported Devices:"
The Logger supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).

@par "Data Handling:"
 The Data will be presented as Weather Device instances

@par Prefix: WDE1_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%WDE1 Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b RainPerCount (Default 295): How much rain will be counted for one count (mm/1000), Range: 200-500
- \b Logfile (Default none): optional fully qualified filename of a logfile.
File will be in csv format with one line per sensor. Header will be in the first line
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category

@par "Public Functions:"
- \b None

 @see http://www.elv.de/output/controller.aspx?cid=74&detail=10&detail2=44549

@subsection FS20WUE

 FS20WUE Splittermodul for reading ELV %FS20WUE Receiver. The Receiver will be accessed via serial port provides WS300 Series Weather and FS20 Data records.

@warning This module is deprecated/unsupported as of 2017. I dont have this anymore.

@par "Supported Devices:"
- Weather: The Receiver supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).
- FS20: reading of ELV FS20 telegrams for Switch devices, but cannot control such device.

@par "Data Handling:"
- Weather: The Data will be presented as Weather Device instances
- FS20: The Data will be presented as Switch instances. FS20 codes will be transformed

@par Prefix: WUE_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%FS20WUE Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b RainPerCount (Default 295): How much rain will be counted for one count (mm/1000), Range: 200-500
- \b Logfile (Default none): optional fully qualified filename of a logfile.
File will be in csv format with one line per sensor. Header will be in the first line
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category

@par "Public Functions:"
- \b None

@see http://www.elv.de/fs20-und-wetterdaten-uart-empfaenger-fs20-wue-komplettbausatz.html

@subsection AVMAHA

 AVMAHA :Splitter for AVM Smarthome Devices. Reads AVM AHA Smarthome Services from Fritz!OS (Ftritz!Box etc.) via http

@par "supported Devices:"
- Fritz Powerline 546E
- Fritz Dect200 Switch: need FritzOS6.20+ for Temperature, 6.98 for Voltage
- Fritz Repeater 100: need FritzOS6.50+
- Fritz Dect301 Heating: show Temperature and battery, no heating control implemented, need FritzOS 7.08+
- Fritz Dect400 Button: lastpressed Timestamp as SwitchDev and Batttery), need FritzOS 7.08+

@par "Data Handling:"
- Power measures will be displayed in an Energey Device instance
- Temperature mesures will be displayed in a Weather Sensor Device instance
- Switch status will be displayed in a Switch Device instance. Changes on the status will be transmitted to the connected actor

@par Prefix: AHA_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default 'AVM SmartHome Devices on $hostname'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b UpdateInterval (Default 60): Query Interval in sec
- \b Host (default fritz.box): Hostname or IP of AHA Server
- \b User (default none): Username for Frotz!OS login (if required)
- \b Password (default none): Password for Fritz!OS Login
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category

@par "Public Functions:"
- Query: manual data refresh
@code
AHA_Query($id);
@endcode
@par Actions:
Switching of capable Devices like DECT!200 and Fritz!Powerline 546. Changes on status will be transmitted to the connected actor

@subsection TE923

TE923 :Splitter for %TE923 based weather stations (TFA Nexus,Ventus 831, Mebus 923 etc) using TE923con output

@par "Supported Devices:" 5 external Temp/Hum Sensors(1-5), Rain, Wind, UV(not seen yet) and the internal indoor Sensor
@par "Data Handling:" The Data will be presented as Weather Device instances
@par Prefix: TE923_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%TE923 Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b URL: URL to query TE923con
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Logfile (Default none): optional fully qualified filename of a logfile.

@par "Public Functions:"
- Query: manual data refresh
@code
TE923_Query($id);
@endcode

@par Simple CGI Script to retrieve data:
This requires a running webservice providing output from <a href="http://te923.fukz.org/">te923con</a> binary.
The following simple get_data.cgi script to be placed in your webservers cgi-bin directory is sufficient
@code
#!/bin/bash
TE923=./te923con
#header content type end empty line
echo "Content-type: text/plain"
echo
#end header

#parameter
PARAM="${QUERY_STRING:-$1}"
#run
if [ -x $TE923 ]; then
#binary must be placed into same dir
#this runs only if apache user www-data is member of group plugdev
#and udev rule is added
case "$PARAM" in
data) $TE923 -i 'i';;
status)  $TE923 -s -i 'i';;
debug)  $TE923 -D -i 'i';;
version)  $TE923 -v;;
esac
fi
@endcode

@par Web Server configuration (example Raspbian Stretch):
The webserver must support cgi execution. On Raspbian (stretch) install apache2 and enable cgi and cgid mods.
You have to install a udev rule to permit the webserver user access to usb
@code
apt install apache2
systemctl enable apache2
a2enmod cgi cgid
a2enconf serve-cgi-bin
adduser www-data plugdev
cat >/etc/udev/rules.d/99-te923.rules <<EOF
ATTRS{idVendor}=="1130", ATTRS{idProduct}=="6801", MODE="0660", GROUP="plugdev", RUN="/bin/sh -c 'echo -n $id:1.0 > /sys/bus/usb/drivers/usbhid/unbind'"
EOF
udevadm control --reload-rules
#reboot to activate changes
reboot
@endcode

@subsection WS2500PC

WS2500PC :Splitter for %WS2500PC Receiver of WS2000 based Sensors using ws2500 binary output

@par "Supported Devices:" 8 external Temp/Hum Sensors(1-8), Rain, Wind, UV(not seen yet),Light(Brighness) 
and the Indoor Sensor with Temp/Hum and Pressure 
@par "Data Handling:" The Data will be presented as Weather Device instances
@par Prefix: WS2500PC_
@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%WS2500PC Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b URL: URL to query ws2500 cgi eg. http://raspberry/cgi-bin/get_ws2500_data.cgi
- \b RainPerCount (Default 295): How much rain will be added for one count (mm/1000), Range: 200-500
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Logfile (Default none): optional fully qualified filename of a logfile.

@par "Public Functions:"
- Query: manual data refresh
@code
WS2500PC_Query($id);
@endcode

@par Hint:
This requires a running webservice providing output from <a href="http://userpages.uni-koblenz.de/~krienke/ftp/unix/ws2500/">ws2500</a> binary.
The following simple get_ws2500_data.cgi script to be placed in your webservers cgi-bin directory  along ws2500 binary is sufficient
The webserver must support cgi execution. On Raspbian (stretch) install apache2 and enable cgi and cgid mods
@code
apt install apache2
a2enmod cgi cgid
a2enconf serve-cgi-bin
systemctl stop apache2
systemctl start apache2
@endcode

@code
#!/bin/bash
WS2500=./ws2500
#header content type end empty line
echo "Content-type: text/plain"
echo
#end header

#parameter
PARAM="${QUERY_STRING:-$1}" #oder $1
#run
if [ -x $WS2500 ]; then
#binary must be placed into same dir
#this runs only if apache user www-data is member of group plugdev
#and udev rule is added
case "$PARAM" in
data) $WS2500 -n -t -C /tmp/lastValues.txt -p /dev/ttyS0 |tee -a ws2500.dat;; #this will read all new records 
status)  $WS2500 -s -p /dev/ttyS0 ;;
debug)  $WS2500 -g -D -C /tmp/lastValues.txt -p /dev/ttyS0 ;;
version)  $WS2500 -v;;
esac
fi
@endcode

 @see http://userpages.uni-koblenz.de/~krienke/en/component/content/article?id=14:weather-en

@subsection NUT

  NUT : Splitter modul to query a %NUT daemon for attached UPS/USV via Socket

@par "supported Devices:"
Any via %NUT accessible UPS/USV.
@par "Data Handling:"
The Data will be presented as Energy Device instances
@par Prefix: NUT_

@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%NUT Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b Host: Host to query remote %NUT deamon
- \b Port (Default:3493): Port to query remote %NUT deamon
- \b UPSname Name of UPS as set in %NUT configuration. This identifies the USV if there are more than one attached.
     May be empty, then it will take the first UPS as shown by LIST UPS command
- \b IDfield (default ups.serial) %NUT field which holds the UPS identifier
- \b NomPower (default 100) the 100% load value in Watt. An USV which provides "ups.realpower.nominal" will
     set this value as property only if the previous value is default
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Logfile (Default none): optional fully qualified filename of a logfile.

@par "Public Functions:"
 - Query: manual data refresh
@code
 NUT_Query($id);
@endcode

 @par Hint:
  The DeviceID should be supplied via ups.serial field. The Status Variable refers to the ups.status field.
  For explanation see http://networkupstools.org/documentation.html

@subsection APCUPSD

APCUPSD : Splitter modul to query a %APCUPSD daemon for attached UPS/USV via Socket

@par "supported Devices:"
Any via %APCUPSD accessible UPS/USV.
@par "Data Handling:"
The Data will be presented as Energy Device instances
@par Prefix: APCUPSD_

@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%APCUPSD Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b Host: Host to query remote %APCUPSD deamon
- \b Port (Default:3551): Port to query remote %APCUPSD deamon
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Logfile (Default none): optional fully qualified filename of a logfile.

@par "Public Functions:"
- Query: manual data refresh
@code
APCUPSD_Query($id);
@endcode

@par Hint:
The DeviceID should be supplied via ups.serial field. The Status Variable refers to the ups.status field.
For explanation see http://networkupstools.org/documentation.html


@subsection CUL
 CUL : IPSymcon PHP Splitter Module to receives Data from a CULFW driven tranceiver gadget like Busware
 
These devices receives and decodes a lot of common smarthome protocols used by ELV Sensors and devices. 

@par "Supported Busware Devices: CUL,CUN,CUNO,COC

- decoded Protocols
  - ELV EM1000 Energy Messures EM-WZ, EM-GZ and EMEM
  - ELV FS20: Any contact sensor and switch actor. Dimmer are implemented, but because lack of such device untested
  - ELV HMS: HMS100T(also used as Emulation for connected 1Wire DS1820 Sensors), HMS100TF,HMS100-TFK ...
  - ELV WS300: S300TH,PS50,KS300 Weather Sensors
  - ELV FHT: TFK  Window opening Sensor only. %FHT Heating Controls like FHT80b are not implemented!
  - ELV ESA: some of the Energy Sensors. see source code. Untested!

@par "Data Handling:"
 * Power measures will be displayed in an Energey Device instance
 * Temperature mesures will be displayed in a Weather Sensor Device instance
 * Switch status will be displayed in a Switch Device instance. Changes on the status will be transmitted to the connected actor

@par Actions:
 Switching of FS20 Devices. Changes on status will be transmitted to the connected actor

@par Prefix: CUL_

 @par Hint
Receivers may be connect to a serial port or client socket instance. You must create such one for
your %CUL instance as parent for yourself.

@par device learning

Its important for the proper creation of IPS devices these must be received from the CUx Splitter
instead of manually created. Only this ensures a set of valid parameters. As example a FS20 dimming device must
be created by receiving a dimming command apply the dimming functions, otherwise it will left as a switch.
You may use your remote control or a learning procedure for this. as an alternative, you may create a valid CUL
response string and send this manually to the CUL splitter. This procedure is described in this forum entry
https://www.symcon.de/forum/threads/31352-neue-PHP-Module-als-Ersatz-meiner-Delphi-Module?p=303129#post303129 (in german)

@see http://culfw.de/commandref.html for valid CUL response strings

@subsection OWNet

OWN: The %OWNet Splitter will query a OWServer via OWNet daemon for attached 1Wire sensors
@par Prefix: OWN_

@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%OWNet Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b Host: Host to query remote %OWNet daemon
- \b Port (Default:4304): Port to query remote %OWNet daemon
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category

@par Actions (if supported by the attached splitter and the physical device)

- \b None

@see http://owfs.org/index.php?page=owserver
@see http://owfs.org/index.php?page=ownet-php
@see http://owfs.org/index.php?page=standard-devices

@subsection XS1

XS1: The %XS1 Splitter queries an Ezcontrol XS1 Homeautomation Receiver/Controler

@warning This module is deprecated/unsupported as of 2017. I dont have this anymore.


@par Prefix: XS1_

@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%OWNet Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b Host: Host to query remote %OWNet daemon
- \b Port (Default:4304): Port to query remote %OWNet daemon
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category

@par Actions (if supported by the attached splitter and the physical device)

- \b Switching of attached actors

@see vendor docs on http://www.ezcontrol.de/content/view/36/28/ (german)

@subsection MQTTPUB

MQTTPUB: IOModule to publish IPS Variable updates to an MQTT brocker
@par Prefix: MQTTPUB_

  The module allows subscriptions to IPS Variable update messages and forwards this as json record to
a MQTT broker. An external client may subscribe to these broker messages and proceed further

@par Properties

 - \b Active (Default: Off/Inactive):
 - \b Host MQTT Broker Host/IP to connect
 - \b Port (Default:1883): MQTT Broker Port to connect
 - \b Topic (Default 'IPS/status/%varid%/%varident%/%path%'):  Topic pattern to pass to broker (see below)
 - \b ClientID (Default 'symcon'): $ClientID@$host will be used wenn connecting to broker

IPS_SetProperty only:
 - \b User (Default empty)
 - \b Password (Default empty)
 - \b Subscriptions Json array string with registered subscriptions. To register subscriptions pls use public functions only

@par Actions

 - \b None


@par "Public Functions:"

 - \b MQTTPUP_Publish($id,$varid): trigger immediately publishing variable $varid to the broker
 - \b MQTTPUB_Subscribe($id,$varid): Subscribes VM_UPDATE messages for variable $varid on IPS Messageloop
 - \b MQTTPUB_UnSubscribe($id,$varid): UnSubscribes VM_UPDATE messages for variable $varid from IPS Messageloop
 - \b MQTTPUB_Subscribe_All($id,$objectid,$ident=null): Subscribes all variable IDs below $objectid to IPS Messageloop,
optionally only thus equal which supplied ident
 - \b MQTTPUB_UnSubscribe_ALL($id,$objectid,$ident=null): UnSubscribes all variable IDs below $objectid from IPS Messageloop,
optionally only thus equal which supplied ident

@par Data Handling

- Topic:
 - Topic may be configured with config dialog window. You may set template variables within definition
   IPS/status/%varid%/%varident%/%path%/varname

   will result in
@code
IPS/status/42440/Watt/APCUPSD_Devices/Back-UPS_RS_900G/Watt
@endcode

- Payload is a Json string with the following components:
  - Path: IPS tree of names from root to the variable
  - TS: Unix Timestamp message received in %MQTTPUB module
  - UTF8Value: stringyfied actual value of variable
  - VariableChanged: VariableChange Field of variable object
  - VariableIdent: Ident of variable
  - VariableType: VariableType Field of variable object
  - VariableUpdated: VariableUpdated Field of variable object

    Sample:
    @code
    {'Path': 'APCUPSD Devices/Back-UPS RS 900G/Watt',
    'TS': 1477132802,
    'UTF8Value': '124',
    'VariableChanged': 1477132502,
    'VariableID': 42440,
    'VariableIdent': 'Watt',
    'VariableType': 2,
    'VariableUpdated': 1477132802}
    @endcode

A sample consumer script ips_mqtt2db.py for logging into a mysql database is provided


@section debug Debug:

By activating the Instance Debug Tab a lot of noise will appear

@section gendoc general documentation

 - https://www.symcon.de
 - https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/
 - http://www.symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 - https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi

 */