# ipsymcon-phpmodule
PHPModules for Symcon V5+

This is a Library of PHP Modules for the home automation software "Symcon"


### Requirements:
* Symcon (https://www.symcon.de/en/) Version 5.1+

### Installation
* Within Symcon Konsole go to "Kern Instancen" ->Modules
* Press "Hinzufügen" Button
* Enter Module Repository "https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi.git"
* Click on "Edit" Icon and change Branch(Zweig) to "5.1"

### Modules provides in this library:

 ![Module Hierarchy](docs/images/PHPModules.png)


### Weather Device
Generic Device module to present weather data

Prefix: WSD_

### Energy Device
Generic Device module to present energy data

##### Prefix: END_

### Switch Device
Generic Device module to present weather data

##### Prefix: SWD_

##### Public Functions:

forward data to splitter only, real actor control will need a Splitter with matching capabilities like AVMAHA or CUL

* SWD_SetSwitchMode($id,$state): set the switch to the desired state
* SWD_SetIntensity($id,$percent): Dim to the given level
* SWD_SetDuration($id,$seconds,$action=null): (FS20 via CUL only)  Switch to the given or opposite current state and reverse after time expires
* SWD_DimUp($id): Dim one Level(Step) Up
* SWD_DimDown($id): Dim one Level(Step) down

### WS300PC
Splittermodul for reading ELV WS300PC Datalogger. The Logger will be accessed via serial port.

##### Supported Devices:

The logger supports 8 external T/H WS300 Series Sensor (S300TH,PS50), one KS300 Kombisensor (T/H, Wind, Rain)
and the internal Indoor Sensor (T/H, Pressure, Forecast(Willi) Indicator).

##### Data Handling: 
The Data will be presented as Weather Device instances

##### Prefix: WS300PC_

##### Public Functions:
* WS300PC_ReadCurrentRecord($id): read current sensor status, returns csv fragment. Is empty, an error occured
* WS300PC_ReadNextRecord($id): Read next history record, returns csv fragment. If empty, is error or no more records are available
Reading of all historic data at once in a loop will consume a lot of time and will usually exceed PHP max_execution_time. 
See ws300pc_history.pl for an idea running it outside using IPS_JSON Wrapper Api
* WS300PC_WriteConfig($id): write internal configuration record. this will include the properties
        RainPerCount, Altitude and RecordInterval. After executing the Logger will go in Resync for 10min
* WS300PC_GetVersion($id): Query and returns Logger firmware version

### WDE1
Splittermodul for reading ELV WDE1 Datalogger.  The Logger will be accessed via serial port.

<span style="color:red">
This module is deprecated/unsupported as of 2017. I dont have this device anymore.
</span>

##### Supported Devices:
The Logger supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).

##### Data Handling: 
The Data will be presented as Weather Device instances

##### Prefix: WDE1_

### FS20WUE
Splittermodul for reading ELV FS20WUE Receiver.  The Receiver will be accessed via serial port.

##### Supported Devices:
* Weather: The Receiver supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).
* FS20: reading of ELV FS20 telegrams for Switch devices, but cannot control such device.

##### Data Handling:
* Weather: The Data will be presented as Weather Device instances
* FS20: The Data will be presented as Switch instances. FS20 codes will be transformed

##### Prefix: WUE_

### AVMAHA

AVM AHA-API IPSymcon PHP Splitter Module Class

read AVM AHA Smarthome Services from Fritz!OS (Ftritz!Box etc.)

##### supported Devices: 
* Fritz Powerline 546E
* Fritz Dect200(need FritzOS6.20+ for Temperature, 6.98 for Voltage), 
* Repeater 100 (need FritzOS6.50+)

##### Data Handling:
* Power measures will be displayed in an Energey Device instance
* Temperature mesures will be displayed in a Weather Sensor Device instance
* Switch status will be displayed in a Switch Device instance.

##### Actions:
 * Switching of capable Devices like DECT!200 and Fritz!Powerline 546.
Changes on the status will be transmitted to the connected actor

##### Prefix: AHA_

### TE923
Splitter for TE923 based weather stations (TFA Nexus,Ventus 831, Mebus 923 etc) using TE923con output
 * This requires a running webservice providing output from <a href="http://te923.fukz.org/">te923con</a> binary.
 The following simple get_data.cgi script is sufficient. Copy the te923con binary along with the cgi to your 
 webserver cgi-bin directory
 <pre>
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
 </pre>

The webserver must support cgi execution. On Raspbian (Stretch) install apache2 and enable cgi and cgid mods
You have to install a udev rule to permit the webserver user access to usb 
<pre>
apt install apache2
systemctl enable apache2
a2enmod cgi cgid
a2enconf serve-cgi-bin
adduser www-data plugdev
cat >/etc/udev/rules.d/99-te923.rules << EOF 
ATTRS{idVendor}=="1130", ATTRS{idProduct}=="6801", MODE="0660", GROUP="plugdev", RUN="/bin/sh -c 'echo -n $id:1.0 > /sys/bus/usb/drivers/usbhid/unbind'"
EOF
udevadm control --reload-rules
#reboot to activate changes
reboot
</pre>
##### Supported Devices:
5 external Temp/Hum Sensors(1-5), Rain, Wind, UV(not seen yet) and the internal indoor Sensor

##### Data Handling: 
The Data will be presented as Weather Device instances

##### Prefix: TE923_

### WS2500PC
Splitter for %WS2500PC Receiver of WS2000 based Sensors using ws2500 binary output
 * This requires a running webservice providing output from <a href="http://userpages.uni-koblenz.de/~krienke/ftp/unix/ws2500/">ws2500</a> binary.
   The following simple get_ws2500_data.cgi script to be placed in your webservers cgi-bin directory  along ws2500 binary is sufficient
 <pre>
 #!/bin/bash
 WS2500=./ws2500
 #header content type end empty line
 echo "Content-type: text/plain"
 echo
 #end header

 #parameter
 PARAM="${QUERY_STRING:-$1}" 
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
 </pre>

The webserver must support cgi execution. On Raspbian (Stretch) install apache2 and enable cgi and cgid mods 
<pre>
apt install apache2
a2enmod cgi cgid
a2enconf serve-cgi-bin
systemctl stop apache2
systemctl start apache2
</pre>

##### Supported Devices:
8 external Temp/Hum Sensors(1-8), Rain, Wind, UV(not seen yet),Light(Brighness)
and the Indoor Sensor with Temp/Hum and Pressure

##### Data Handling: 
The Data will be presented as Weather Device instances

##### Prefix: WS2500PC_

### NUT
Splittermodul to query a NUT daemon for attached UPS/USV

##### supported Devices:
Any via NUT accessible UPS/USV.

##### Data Handling:
The Data will be presented as Energy Device instances
  The DeviceID should be supplied via ups.serial field. The Status Variable refers to the ups.status field.
  For explanation see
 http://networkupstools.org/documentation.html

##### Prefix: NUT_

### APCUPSD
Splittermodul to query an APCUPSD daemon for attached UPS/USV

##### supported Devices:
Any via APCUPSD accessible UPS/USV.

##### Data Handling:
The Data will be presented as Energy Device instances
  The DeviceID should be supplied via ups.serial field. The Status Variable refers to the ups.status field.
  For explanation see
 http://www.apcupsd.org/manual/manual.html

##### Prefix: APCUPSD_

### CUL

CUL IPSymcon PHP Splitter Module Class

receives Data from a CULFW driven tranceiver gadget like Busware
These devices receives and decodes a lot of common smarthome protocols used by ELV Sensors and devices
supported Receivers may be connect to a serial port or client socket instance. You must create such one for
your CUL instance as parent for yourself

##### supported Devices:
* Receivers: CUL,CUN,CUNO,COC

##### decoded Protocols

 * ELV EM1000: Energy Messures EM-WZ, EM-GZ and EMEM
 * ELV FS20: Any TFK and Switch actor. Dimmer are implemented, but because lack of such device untested
 * ELV HMS: HMS100T(also used as Emulation for connected 1Wire DS1820 Sensors), HMS100TF,HMS100-TFK ...
 * ELV WS300: S300TH,PS50,KS300 Weather Sensors
 * ELV FHT: TFK  Window opening Sensor only. FHT Heating Controls like FHT80b are not implemented!
 * ELV ESA: some of the Energy Sensors. see source code. Untested!

##### Data Handling:
* Power measures will be displayed in an Energey Device instance
* Temperature mesures will be displayed in a Weather Sensor Device instance
* Switch status will be displayed in a Switch Device instance. Changes on the status will be transmitted to the connected actor

##### Actions:
 * Switching of FS20 Devices.
 Changes of the status variable will be transmitted to the connected actor

##### Prefix: CUL_

##### IPS Device module learning

Its important for the proper creation of IPS devices these must be received from the CUx Splitter
instead of manually created. Only this ensures a set of valid parameters. As example a FS20 dimming device must 
be created by receiving a dimming command apply the dimming functions, otherwise it will left as a switch.
You may use your remote control or a learning procedure for this. as an alternative, you may create a valid CUL
response string and send this manually to the CUL splitter. This procedure is described in this forum entry 
https://www.symcon.de/forum/threads/31352-neue-PHP-Module-als-Ersatz-meiner-Delphi-Module?p=303129#post303129 (in german)

see http://culfw.de/commandref.html for valid CUL response strings


### OWNet

Splittermodule to query a 1Wire Device connected to server running OWServer with OWNet API

##### Supported Devices:
* DS18B20, DS18S20, DS1820 temperature sensors

##### Data Handling:
The Temperature sensors will be presented as weather devices

##### Prefix: OWN_
For more details about OWServer see
http://owfs.org/index.php?page=owserver

### XS1

Splittermodule to access Ezcontrol XS1 Homeautomation Receiver/Controler

<span style="color:red">
This module is deprecated/unsupported as of 2017. I dont have this anymore.
</span>

##### Supportet Devices:
* XS1 may receive and control up to 128 Sensors metrics and 64 actors.
Because lack of availablility, not all Actors and Sensors types are implemented. See sources.

##### Data Handling:
Data will be quieried via http JSON API. Unfortunately, the API will hide the physical device typ
by mapping to internal generixc types. So far as possible we map these types to our own system.
* Power Consumtion Sensors will be mapped to Energy Devices
* Environment Measures will be presented as Weather Devices
* Alarming Sensors and all Actors will be presented as Switch Devices


Actions (if supported by the physical device)
 * Switching(On/Off) of attached actors.
 Changes of the status variable will be transmitted to the connected actor

##### Prefix: XS1_

For a complete XS1 description see vendor documentation at http://www.ezcontrol.de/content/view/36/28/ (german)

### MQTTPUB

IOModule to publish IPS Variable updates to an MQTT brocker

The module allows subscriptions of IPS Variable update messages and forwards this as json record to 
a MQTT broker. An external client may subscribe to these broker messages and proceed further 

##### Prefix: MQTTPUB_

##### Public Functions:
* MQTTPUP_Publish($id,$varid): trigger immediately publishing variable $varid to the broker 
* MQTTPUB_Subscribe($id,$varid): Subscribes VM_UPDATE messages for variable $varid on IPS Messageloop
* MQTTPUB_UnSubscribe($id,$varid): UnSubscribes VM_UPDATE messages for variable $varid from IPS Messageloop
* MQTTPUB_Subscribe_All($id,$objectid,$ident=null): Subscribes all variable IDs below $objectid to IPS Messageloop,
optionally only thus equal which supplied ident
* MQTTPUB_UnSubscribe_ALL($id,$objectid,$ident=null): UnSubscribes all variable IDs below $objectid from IPS Messageloop,
optionally only thus equal which supplied ident 

##### MQTT Topic:
The topic may be configured with config dialog window. You may set template variables within definition
 ```
 IPS/status/%varid%/%varident%/%path%
 ```
will result in
```
IPS/status/42440/Watt/APCUPSD_Devices/Back-UPS_RS_900G/Watt
```
##### Payload:
Payload is a Json string with the following components:
* Path: IPS tree of names from root to the variable
* TS: Unix Timestamp message received in MQTTPUB module
* UTF8Value: stringyfied actual value of variable
* VariableChanged: VariableChange Field of variable object
* VariableIdent: Ident of variable
* VariableType: VariableType Field of variable object
* VariableUpdated: VariableUpdated Field of variable object
```
{'Path': 'APCUPSD Devices/Back-UPS RS 900G/Watt',
 'TS': 1477132802,
 'UTF8Value': '124',
 'VariableChanged': 1477132502,
 'VariableID': 42440,
 'VariableIdent': 'Watt',
 'VariableType': 2,
 'VariableUpdated': 1477132802}
 ```
##### Sample consumer script
you can retrieve the published data from MQTT with simple scripts. A sample python script 
[ips_mqtt2db.py](MQTTPUB/ips_mqtt2db.py) 
demonstrates how to write the payload into a mysql database

How to use:
 * create mysql account and database.
 * Grant "Create table, Insert,update,delete,index " or simple "All" on <database>
 * check if you can connect
 * create a configuration file in YAML format somewhere with the needed credentials and adjust the values.
 
   ```
    mysql:
        host: localhost
        user: ips
        passwd: secret
        db: ips
    mqtt:
        host: localhost
        port: 1883
        topic: IPS/status/#
   ```
   
 * install required additional pip libraries:
  ```
  paho_mqtt
  MySQL-python
  PyYAML
  ```

 * now call the script
   ```
    python ips_mqtt2db.py <configfilename>
   ```
   or if the configfile is named ips_mqtt2db.yml and in the same directory
   ```
   python ips_mqtt2db.py
   ```


#### Debug:
By activating the Instance Debug Tab a lot of noise will appear

#### additional documentation
You may generate additional documentation using <a href="http://www.stack.nl/~dimitri/doxygen/index.html"> Doxygen</a>
<pre>
doxygen libs/doc/Doxyfile
</pre>
see [generated output](http://www.tdressler.net/ipsymcon/docs/doc_module/html/)

#### see also
* [IPS_JSON Wrapper API](libs/Api)

### License:
CC By-NC 4.0 (http://creativecommons.org/licenses/by-nc/4.0/)
