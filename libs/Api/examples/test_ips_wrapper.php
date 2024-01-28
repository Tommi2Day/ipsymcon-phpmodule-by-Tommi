<?php
/**
 * @file
 * @brief
 * Demo script for checking a running JSON API
 * requires IPSymcon V6.0+
 *
 * @copyright Thomas Dreßler 2013-2024
 * @version 1.2
 * @date 27.01.2024
 *
 * @see https://www.symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see https://www.tdressler.net/ipsymcon/ipsymcon_api.html
 * @include examples/test_ips_wrapper.php
 */
if (!function_exists('IPS_GetKernelVersion')) {
   //we are outside of IPS and need the JSON wrapper
   include('../ips_wrapper.php');
}
//now you can call ips functions as usual
$version=IPS_GetKernelVersion();
print $version;