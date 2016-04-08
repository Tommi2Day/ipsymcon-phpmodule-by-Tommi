<?php
/**
 * @file
 *
 * Doxygen main page
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.0
 * @date 2016-04-07
 */
/**
@mainpage Content

This is a Library of PHP Modules for the home automation software <a href="https://www.symcon.de">"Symcon"</a>

@section Devices

@subsection WSDEV

 WSDEV :Generic Weather Sensor Device Modul
 
 Displays depending of the capability of the connected sensor out of the following measures:
@snippet WSDEV/module.php capvars

- Prefix: WSD_

@subsection EnergyDev

 EnergyDev :Generic Energy Sensor Device Modul
 
Displays depending of the capability of the connected sensor out of the following measures:
@snippet Energy/module.php capvars

- Prefix: END_

@subsection SwitchDev

SwitchDev :Generic Device module to present weather data

Displays depending of the capability of the connected sensor out of the following measures:
@snippet Switch/module.php capvars

- Prefix: SWD_

- Public Functions:
forward data to splitter only, real actor control will need a Splitter with matching capabilities like AVMAHA or CUL
 - SWD_SwitchMode($id,$state): set the switch to the desired state
 - SWD_SetIntensity($id,$percent): Dim to the given level

@section Splitter

 @subsection WS300PC

 WS300PC Splittermodul for reading ELV %WS300PC Datalogger. The Logger will be accessed via serial port.

- Supported Devices:
The logger supports 8 external T/H WS300 Series Sensor (S300TH,PS50), one KS300 Kombisensor (T/H, Wind, Rain)
and the internal Indoor Sensor (T/H, Pressure, Forecast(Willi) Indicator).

- Data Handling:
 The Data will be presented as Weather Device instances

- Prefix: WS300PC_

- Public Functions:
 - WS300PC_ReadCurrentRecord($id): read current sensor status, returns csv fragment. Is empty, an error occured
 - WS300PC_ReadNextRecord($id): Read next history record, returns csv fragment. If empty, is error or no more records are available
Reading of all historic data at once in a loop will consume a lot of time and will usually exceed PHP max_execution_time.
 - WS300PC_WriteConfig($id): write internal configuration record. this will include the properties
RainPerCount, Altitude and RecordInterval. After executing the Logger will go in Resync for 10min
 - WS300PC_GetVersion($id): Query and returns Logger firmware version



@subsection WDE1

WDE1 Splittermodul for reading ELV %WDE1 Datalogger.  The Logger will be accessed via serial port.

- Supported Devices:
The Logger supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).

- Data Handling: The Data will be presented as Weather Device instances

- Prefix: WDE1_

@subsection FS20WUE

 FS20WUE Splittermodul for reading ELV %FS20WUE Receiver. The Receiver will be accessed via serial port provides WS300 Series Weather and FS20 Data records.

- Supported Devices:
 - Weather: The Receiver supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).
 - FS20: reading of ELV FS20 telegrams for Switch devices, but cannot control such device.

- Data Handling:
 - Weather: The Data will be presented as Weather Device instances
 - FS20: The Data will be presented as Switch instances. FS20 codes will be transformed

- Prefix: WUE_


@subsection AVMAHA

 AVMAHA :Splitter for AVM Smarthome Devices. Reads AVM AHA Smarthome Services from Fritz!OS (Ftritz!Box etc.) via http

- supported Devices:
 - Fritz Powerline 546E
 - Fritz Dect200(need FritzOS6.20+ for Temperature),
 - Repeater 100 (need FritzOS6.50+)

- Data Handling:
 - Power measures will be displayed in an Energey Device instance
 - Temperature mesures will be displayed in a Weather Sensor Device instance
 - Switch status will be displayed in a Switch Device instance. Changes on the status will be transmitted to the connected actor

- Prefix: AHA_


@subsection TE923

TE923 :Splitter for %TE923 based weather stations (TFA Nexus,Ventus 831, Mebus 923 etc) using TE923con output

- This requires a running webservice providing output from <a href="http://te923.fukz.org/">te923con</a> binary.
The following simple get_data.cgi script is sufficient

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

- Supported Devices: 5 external Temp/Hum Sensors(1-5), Rain, Wind, UV(not seen yet) and the internal indoor Sensor
- Data Handling : The Data will be presented as Weather Device instances
- Prefix: TE923_

@section adddoc additional documentation in german

- %WS300PC, %FS20WUE, %WDE1, Weather Device: http://www.tdressler.net/ipsymcon/ws300series.html
- %AVMAHA Module: http://www.tdressler.net/ipsymcon/fritz_aha.html
- %TE923 weather Station: http://www.tdressler.net/ipsymcon/te923.html

@section gendoc general documentation

 - https://www.symcon.de

 - https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/

 - http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/

 - https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi

 */