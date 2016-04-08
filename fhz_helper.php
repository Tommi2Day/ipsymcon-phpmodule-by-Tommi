<?php
/**
 * @file
 *
 * FHZ/FS20 functions Helper Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.2
 * @date 2016-04-08
 */

/** @class FHZ_helper
 *
 * FHZ/FS20 coding static Helper Class
 *
 *
 */
class FHZ_helper
{

    //------------------------------------------------------------------------------
    //static data
    //------------------------------------------------------------------------------
    /**
     * Protocol code definitions
     */
    public static $FHZProtocol = Array('pFS20' => 0, 'pFHT' => 1, 'pHMS' => 2, 'pKS300' => 3, 'pFHTResponse' => 4, 'pDateTime' => 5);
    /**
     * Device code definitions
     */
    public static $FHZDevice = Array('FS20' => 0, 'FHT' => 1,
        'HMSTempFeucht' => 2, 'HMSTemp' => 3, 'HMSWasser' => 4, 'HMS100RM' => 5, 'HMS100TFK' => 6, 'SwitchIN' => 7,
        'GasSensor1' => 8, 'GasSensor2' => 9, 'COSensor' => 10, 'KS300' => 11, 'FIT' => 12, 'ALW' => 13);
    /**
     * Queue status definitions
     */
    public static $FHZQueueStatus = Array(
        'Queued' => 0,  //Item is queued and Waiting
        'Waiting' => 1, //Items was send to FHZ, Awaiting response
        'Ok' => 2,      //Command was successfully send
        'Timeout' => 3  //Command response timed out
    );


    /**
     * fs20 codes definitions
     */
    public static $fs20_codes = array(
        //definitions taken from http://www.elv.de/downloads/faq/Zuordnung_interne_Programmbezeichnungen_zu_FS20_Befehlcodes.pdf
        "00" => "Off",
        "01" => "Dim to 06%",
        "02" => "Dim to 12%",
        "03" => "Dim to 18%",
        "04" => "Dim to 25%",
        "05" => "Dim to 31%",
        "06" => "Dim to 37%",
        "07" => "Dim to 43%",
        "08" => "Dim to 50%",
        "09" => "Dim to 56%",
        "0A" => "Dim to 62%",
        "0B" => "Dim to 68%",
        "0C" => "Dim to 75%",
        "0D" => "Dim to 81%",
        "0E" => "Dim to 87%",
        "0F" => "Dim to 93%",
        "10" => "Dim to 100%",
        "11" => "Dim to previous",        // Set to previous dim value (before switching it off)
        "12" => "Toggle",    // between off and previous dim val
        "13" => "Dim up",
        "14" => "Dim down",
        "15" => "Dim updown",
        "16" => "set timer",
        "17" => "nop",
        "18" => "off-for-timer",
        "19" => "on-for-timer than out",
        "1A" => "on-old-for-timer than out",
        "1B" => "reset",
        "1C" => "ramp-on-time",      //time to reach the desired dim value on dimmers
        "1D" => "ramp-off-time",     //time to reach the off state on dimmers
        "1E" => "on-old-for-timer-prev", // old val for timer, then go to prev. state
        "1F" => "on-100-for-timer-prev", // 100% for timer, then go to previous state
        "20" => "Timer to Off",
        "21" => "Timed Dim to 06%",
        "22" => "Timed Dim to 12%",
        "23" => "Timed Dim to 18%",
        "24" => "Timed Dim to 25%",
        "25" => "Timed Dim to 31%",
        "26" => "Timed Dim to 37%",
        "27" => "Timed Dim to 43%",
        "28" => "Timed Dim to 50%",
        "29" => "Timed Dim to 56%",
        "2A" => "Timed Dim to 62%",
        "2B" => "Timed Dim to 68%",
        "2C" => "Timed Dim to 75%",
        "2D" => "Timed Dim to 81%",
        "2E" => "Timed Dim to 87%",
        "2F" => "Timed Dim to 93%",
        "30" => "Timed Dim to 100%",
        "31" => "Timed Dim to previous",    // Set to previous dim value (before switching it off)
        "32" => "Toggle",    // between off and previous dim val
        "33" => "Dim Timer up one level",
        "34" => "Dim Timer down one level",
        "35" => "updown one level, out after Timer ",
        "36" => "set timer",
        "37" => "nop",
        "38" => "off-for-timer",
        "39" => "on-for-timer than out",
        "3A" => "on-to-old-for-timer than out",
        "3B" => "reset",
        "3C" => "ramp-on-time",      //time to reach the desired dim value on dimmers
        "3D" => "ramp-off-time",     //time to reach the off state on dimmers
        "3E" => "on-old-for-timer-prev", // old val for timer, then go to prev. state
        "3F" => "on-100-for-timer-prev", // 100% for timer, then go to previous state
    );

    /**
     * FHT TFK codes
     */
    public static $FHT_tfk_codes = array(
        "02" => "Window:Closed",
        "82" => "Window:Closed",
        "01" => "Window:Open",
        "81" => "Window:Open",
        "0C" => "Sync:Syncing",
        "91" => "Window:Open, Low Batt",
        "11" => "Window:Open, Low Batt",
        "92" => "Window:Closed, Low Batt",
        "12" => "Window:Closed, Low Batt",
        "0F" => "Test:Success");

    /**
     * FHT data codes
     */
    public static $FHT_codes = array(
        "00" => "actuator",
        "01" => "actuator1",
        "02" => "actuator2",
        "03" => "actuator3",
        "04" => "actuator4",
        "05" => "actuator5",
        "06" => "actuator6",
        "07" => "actuator7",
        "08" => "actuator8",

        "14" => "mon-from1",
        "15" => "mon-to1",
        "16" => "mon-from2",
        "17" => "mon-to2",
        "18" => "tue-from1",
        "19" => "tue-to1",
        "1A" => "tue-from2",
        "1B" => "tue-to2",
        "1C" => "wed-from1",
        "1D" => "wed-to1",
        "1E" => "wed-from2",
        "1F" => "wed-to2",
        "20" => "thu-from1",
        "21" => "thu-to1",
        "22" => "thu-from2",
        "23" => "thu-to2",
        "24" => "fri-from1",
        "25" => "fri-to1",
        "26" => "fri-from2",
        "27" => "fri-to2",
        "28" => "sat-from1",
        "29" => "sat-to1",
        "2A" => "sat-from2",
        "2B" => "sat-to2",
        "2C" => "sun-from1",
        "2D" => "sun-to1",
        "2E" => "sun-from2",
        "2F" => "sun-to2",

        "3E" => "mode",
        "3F" => "holiday1",        # Not verified
        "40" => "holiday2",        # Not verified
        "41" => "desired-temp",
        "XX" => "measured-temp",        # sum of next. two, never really sent
        "42" => "measured-low",
        "43" => "measured-high",
        "44" => "warnings",
        "45" => "manu-temp",        # No clue what it does.

        "4B" => "ack",
        "53" => "can-xmit",
        "54" => "can-rcv",

        "60" => "year",
        "61" => "month",
        "62" => "day",
        "63" => "hour",
        "64" => "minute",
        "65" => "report1",
        "66" => "report2",
        "69" => "ack2",

        "7D" => "start-xmit",
        "7E" => "end-xmit",

        "82" => "day-temp",
        "84" => "night-temp",
        "85" => "lowtemp-offset",         # Alarm-Temp.-Differenz
        "8A" => "windowopen-temp"

    );


    /**
     * FHT warning codes
     */
    public static $FHT_warnings = array(
        "battery" => 1,
        "lowtemp" => 1,
        "window" => 1,
        "windowsensor" => 1,
    );

    /**
     * FHT priority codes
     */
    public static $FHT_priority = array(
        "desired-temp" => 1,
        "mode" => 2,
        "report1" => 3,
        "report2" => 3,
        "holiday1" => 4,
        "holiday2" => 5,
        "day-temp" => 6,
        "night-temp" => 7,
    );


    //------------------------------------------------------------------------------
    // static functions
    //------------------------------------------------------------------------------
    /**
     * returns fs20 duration code in sec
     * @param int $dur
     * @return float
     */
    public static function fs20_times($dur)
    {
        $i = ($dur & 0xf0) / 16;
        $j = ($dur & 0xf);
        $res = pow(2, $i) * $j * 0.25;
        return $res;
    }

    //------------------------------------------------------------------------------
    /**
     * returs fs20 dimmer intensity steps in percent
     * @param $steps
     * @return int
     */
    public static function fs20_intensity_percent($steps)
    {
        if ($steps > 15) {
            $percent = 100;
        } else {
            $percent = round($steps * 6.25);
        }
        return $percent;
    }

    //------------------------------------------------------------------------------
    /**
     * dimmer intensity percents in fs20 steps
     * @param int $percent
     * @return float
     */
    public static function fs20_intensity_steps($percent)
    {
        if ($percent > 100) $percent = 100;
        $res = round($percent / 6.25);
        return $res;
    }
    //------------------------------------------------------------------------------
    /**
     * converting CUL Hex IDs into ELV-4-Ids
     * translated from 10_fs20
     * @param string $v Hex-Value
     * @returns string ELV-ID
     */
    public static function hex2four($v)
    {
        $r = "";
        foreach (str_split($v) as $x) {
            $r .= sprintf("%d%d", (hexdec($x) / 4) + 1, (hexdec($x) % 4) + 1);
        }
        return $r;
    }

    //------------------------------------------------------------------------------
    /**
     * transform fs20 binary code string into readable string
     * @param $v
     * @return string
     */
    public static function bin2four($v)
    {
        $r = '';
        $l = strlen($v);
        for ($i = 0; $i < $l; $i++) {
            $a = ord($v[$i]);
            $b = $a & 0xf;
            $a = $a >> 4;
            $r .= sprintf(' %d%d', ($a / 4) + 1, ($a % 4) + 1);
            $r .= sprintf('%d%d', ($b / 4) + 1, ($b % 4) + 1);
        }

        return substr($r, 1);

    }//function

    //------------------------------------------------------------------------------
    /**
     * transform FS20 four code into CUL hex code
     * @param $v
     * @return string
     */
    public static function four2hex($v)
    {
        $r = "";
        foreach (str_split($v) as $x) {
            $r .= sprintf("%d%d", (hexdec($x) / 4) + 1, (hexdec($x) % 4) + 1);
        }
        return $r;
    }

    //------------------------------------------------------------------------------
    /**
     * convert readable four code into binary code
     * @param $v
     * @return string
     */
    public static function four2bin($v)
    {
        $res = '';
        $l = strlen($v);
        if (($l % 4) > 0) return '';
        $p = 1;
        while ($p < $l) {
            $r = 0;
            for ($i = 0; $i < 4; $i++) {
                $a = ord($v[$p]) - 0x30;
                $r = ($r * 4) + ($a - 1);
                $p++;
            }
            $res .= chr($r);
        }
        return $res;

    }//function

}//class