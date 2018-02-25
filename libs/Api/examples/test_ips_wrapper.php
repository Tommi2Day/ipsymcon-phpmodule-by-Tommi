<?php
/**
 * @file
 * @brief
 * Demo script for checking a running JSON API
 * requires IPSymcon V3.0+
 *
 * @copyright Thomas Dressler 2013-2018
 * @version 1.1
 * @date 25.02.2018
 *
 * @see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see http://www.tdressler.net/ipsymcon/ipsymcon_api.html
 * @include examples/test_ips_wrapper.php
 */
if (!function_exists('IPS_GetKernelVersion')) {
   //we are outside of IPS and need the JSON wrapper
   include('../ips_wrapper.php');
}
//now you can call ips functions as usual
$version=IPS_GetKernelVersion();
print $version;
?>