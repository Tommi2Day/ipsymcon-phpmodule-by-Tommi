<?php
/**
 * @file
 *
 * Doxygen main page
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016-2024
 * @version 2.2
 * @date 2024-01-28
 */
/** @mainpage IPSymon JSON API wrapper
 *
 * Wrapper for IP-Symcon function calls to be executed via JSON API.
 *
 * This wrapper helps you to execute scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all of known functions and map this to a JSON call.
 * ips_wrapper.php will be generated using gen_ips_wrapper.php
 *
 * Usage:
 *@code {.php}
//include wrapper only if not in native IPS
if (!function_exists('IPS_GetKernelVersion')) {
//we are outside of IPS and need the JSON wrapper
include('ips_wrapper.php');
}
//now you can call ips functions as usual
$version=IPS_GetKernelVersion();
print $version;
@endcode
 *
 * @pre Prepare
 * - enable IPS remote access from IPS Tray
 * - create a new script object with the content of gen_ips_wrapper.php in IPSymcon console
 * - run this script as usual
 * - grab  the generated ips_wrapper.php file from IPSymcon scripts folder
 *
 * - All ips function headers are listed in ips_wrapper.php. You need to include the class file IPS_JSON.php as well.
 *
 * - you may create an additional file IPS_JSON_config.cfg which will summarize your JSON API settings as below.
 * This will have precendence over the generated values.
 * @code {.php}
$config='IPS_JSON_config.cfg';
// IPsymcon API Definitions
$host='localhost';
$port='3777';
$user='license user name/email';
$password='remote-access';
@endcode
 *

 * Examples:
 *
 * general examples
 *
 * - test_ips_wrapper.php: simple test function call
 * - IPS_JSON_config.cfg: configuration file example
 * - run_ips_script.pl: Perl example to start an IPS internalscript
 * - run_ips_script.php: PHP example to start an IPS internalscript

 * Icinga/Nagios examples:
 * - check_ips_json.php: simple php check script for Icinga/Nagios
 * - check_ips_json.pl: simple perl check script for Icinga/Nagios
 * - check_ips_temperature_json.pl: read an IPS temperature sensor for Icinga/Nagios
 * - check_ips_sample_json.txt: icinga/nagios check configuration steps
 *
 *
 * More readings (in german):
 * - [JSON Wrapper Homepage](http://www.tdressler.net/ipsymcon/jsonapi.html)
 * - [Symcon API](http://www.symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/)
 * - [IPS console](http://www.symcon.de/service/dokumentation/komponenten/verwaltungskonsole/)
 * - [IPS Tray](https://www.symcon.de/service/dokumentation/komponenten/tray/fernzugriff/)
 * - [Examples](examples.html)

 * @example gen_ips_wrapper.php Script to generate ips_wrapper.php
 * @example test_ips_wrapper.php simple function call
 * @example check_ips_json.php simple php check script for Icinga/Nagios
 * @example check_ips_json.pl simple perl check script for Icinga/Nagios
 * @example check_ips_temperature_json.pl read an IPS temperature sensor for Icinga/Nagios
 * @example check_ips_sample_json.txt icinga/nagios check configuration steps
 * @example IPS_JSON_config.cfg configuration file example
 * @example run_ips_script.pl Perl example to start an IPS internalscript
 * @example run_ips_script.php PHP example to start an IPS internalscript
 *

 */