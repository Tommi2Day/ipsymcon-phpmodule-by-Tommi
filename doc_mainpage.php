<?php
/**
 * @file
 *
 * Doxygen main page
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.1
 * @date 2016-04-08
 */
/**
@mainpage Index

This is a Library of PHP Modules for the home automation software <a href="https://www.symcon.de">"Symcon"</a>

@par "Github Modul URL:" https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi

 @image html PHPModules.png "Modul hierarchy"

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
- \b Debug: Flag to enable debug output via IPS_LogMessages
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
- \b Debug: Flag to enable debug output via IPS_LogMessages
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
- \b Debug: Flag to enable debug output via IPS_LogMessages
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
- \b Debug: Flag to enable debug output via IPS_LogMessages
@par "Public Functions:"
- \b None

 @see http://www.elv.de/output/controller.aspx?cid=74&detail=10&detail2=44549

@subsection FS20WUE

 FS20WUE Splittermodul for reading ELV %FS20WUE Receiver. The Receiver will be accessed via serial port provides WS300 Series Weather and FS20 Data records.

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
- \b Debug: Flag to enable debug output via IPS_LogMessages
@par "Public Functions:"
- \b None

@see http://www.elv.de/fs20-und-wetterdaten-uart-empfaenger-fs20-wue-komplettbausatz.html

@subsection AVMAHA

 AVMAHA :Splitter for AVM Smarthome Devices. Reads AVM AHA Smarthome Services from Fritz!OS (Ftritz!Box etc.) via http

@par "supported Devices:"
- Fritz Powerline 546E
- Fritz Dect200(need FritzOS6.20+ for Temperature),
- Repeater 100 (need FritzOS6.50+)

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
- \b Debug: Flag to enable debug output via IPS_LogMessages
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
- \b Debug: Flag to enable debug output via IPS_LogMessages
@par "Public Functions:"
- Query: manual data refresh
@code
TE923_Query($id);
@endcode

@par Hint:
This requires a running webservice providing output from <a href="http://te923.fukz.org/">te923con</a> binary.
The following simple get_data.cgi script to be placed in your webservers cgi-bin directory is sufficient

@code
#!/bin/bash
TE923=/usr/bin/te923con
#header content type end empty line
echo "Content-type: text/plain"
echo
#end header

#parameter
PARAM="$QUERY_STRING" #oder $1
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
- \b Debug: Flag to enable debug output via IPS_LogMessages
@par "Public Functions:"
- Query: manual data refresh
@code
WS2500PC_Query($id);
@endcode

@par Hint:
This requires a running webservice providing output from <a href="http://userpages.uni-koblenz.de/~krienke/ftp/unix/ws2500/">ws2500</a> binary.
The following simple get_ws2500_data.cgi script to be placed in your webservers cgi-bin directory  along ws2500 binary is sufficient

@code
#!/bin/bash
WS2500=./ws2500
#header content type end empty line
echo "Content-type: text/plain"
echo
#end header

#parameter
PARAM="$QUERY_STRING" #oder $1
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
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Logfile (Default none): optional fully qualified filename of a logfile.
- \b Debug: Flag to enable debug output via IPS_LogMessages
@par "Public Functions:"
 - Query: manual data refresh
@code
 NUT_Query($id);
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
your %CUL instance as parent for yourself

 @see http://culfw.de/commandref.html


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
- \b Debug: Flag to enable debug output via IPS_LogMessages

@par Actions (if supported by the attached splitter and the physical device)

- \b None

@see http://owfs.org/index.php?page=owserver
@see http://owfs.org/index.php?page=ownet-php
@see http://owfs.org/index.php?page=standard-devices

@subsection XS1

XS1: The %XS1 Splitter queries an Ezcontrol XS1 Homeautomation Receiver/Controler
@par Prefix: XS1_

@par Properties
- \b  Active (Default: Off/Inactive):
- \b Category (Default '%OWNet Devices'):  name of category for subsequent devices
- \b ParentCategory (Default 0): ID of parent category for newly created category
- \b Host: Host to query remote %OWNet daemon
- \b Port (Default:4304): Port to query remote %OWNet daemon
- \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
- \b Debug: Flag to enable debug output via IPS_LogMessages

@par Actions (if supported by the attached splitter and the physical device)

- \b Switching of attached actors

@see vendor docs on http://www.ezcontrol.de/content/view/36/28/ (german)

@section adddoc additional documentation in german

- %WS300PC, %FS20WUE, %WDE1: http://www.tdressler.net/ipsymcon/ws300series.html
- %AVMAHA Module: http://www.tdressler.net/ipsymcon/fritz_aha.html
- %TE923 Weather Station Module: http://www.tdressler.net/ipsymcon/te923.html
- %NUT Module: http://www.tdressler.net/ipsymcon/nut_ips.html
- %OWNet Module: http://www.tdressler.net/ipsymcon/ownet_reader.html
- %XS1 Module: http://www.tdressler.net/ipsymcon/xs1_ips.html

@section debug Debug:

By activating the Debug property (if available) a lot of noise will appear as LogMessages

@section gendoc general documentation

 - https://www.symcon.de

 - https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/

 - http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/

 - https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi

 */