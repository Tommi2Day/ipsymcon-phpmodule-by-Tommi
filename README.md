# ipsymcon-phpmodule
PHPModules for Symcon V4+

This is a Library of PHP Modules for the home automation software "Symcon" 

### Requirements:
* Symcon (https://www.symcon.de/en/) Version 4.0+

### Modules provides in this library:

#### FHZDummy
Splitter Module for interfacing Busware CUN/CUL-Adapter to standard FHT/HMS and FS20 Devices
This module is deprecated from April 2016 in favor of CUL module

#### Weather Device
Generic Device module to present weather data

Prefix: WSD

#### Switch Device
Generic Device module to present weather data

Prefix: SWD

Public Functions:

forward data to splitter only, real actor control will need a Splitter with matching capabilities like AVMAHA or CUL

* SWD_SwitchMode($id,$state): set the switch to the desired state
* SWD_SetIntensity($id,$percent): Dim to the given level

#### WS300PC
Splittermodul for reading ELV WS300PC Datalogger. The Logger will be accessed via serial port.

The logger supports 8 external T/H WS300 Series Sensor (S300TH,PS50), one KS300 Kombisensor (T/H, Wind, Rain)
and the internal Indoor Sensor (T/H, Pressure, Forecast(Willi) Indicator).
The Sensors will be created and presented as Weather Device instances

Prefix: WS300PC

 Public Functions:
* WS300PC_ReadCurrentRecord($id): read current sensor status, returns csv fragment. Is empty, an error occured
* WS300PC_ReadNextRecord($id): Read next history record, returns csv fragment. If empty, is error or no more records are available
* WS300PC_WriteConfig($id): write internal configuration record. this will include the properties
        RainPerCount, Altitude and RecordInterval. After executing the Logger will go in Resync for 10min
* WS300PC_GetVersion($id): Query and returns Logger firmware version

#### WDE1
Splittermodul for reading ELV WDE1 Datalogger.  The Logger will be accessed via serial port.

The Logger supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).
The Sensors will be created and presented as Weather Device instances

Prefix: WDE1

#### FS20WUE
Splittermodul for reading ELV FS20WUE Datalogger.  The Logger will be accessed via serial port.

The Logger supports 8 external T/H WS300 Series Sensor (T/H WS300Sensor (S300TH,PS50)) and one KS300 Kombisensor (T/H, Wind, Rain).
It suppoerts also reading of ELV FS20 telegrams for Switch devices, but cannot control such device.
The Sensors will be created and presented as Weather Device instances

Prefix: WUE

### see also (in german)
* FHZDummy Module: http://tdressler.net/ipsymcon/fhzdummy.html (german)
* WS300PC, FS20WUE, WDE1, Weather Device: http://www.tdressler.net/ipsymcon/ws300series.html

#### Debug:
By activating the Debug property (if available) a lot of noise will appear as LogMessages

### License:
CC By-NC 4.0 (http://creativecommons.org/licenses/by-nc/4.0/)
