<?php

//Proxies are necessary to bypass Follets and Barnes and Nobles rate limiting.
//Services I recommend for proxies.  Low-traffic: proxymesh, AWS cloud, or rackspace cloud.  High-traffic: trustedproxies, hide my ass

//NOTE: Make sure to specify the Port in addition to host
//We're using a free trial to use these proxies note: go back in a month to make a new account and just change the proxies.
// Specically probably sometime in the middle of November
define('PROXY_1', '104.238.189.97');
define('PROXY_1_AUTH', '31280');

define('PROXY_2', '45.32.11.96');
define('PROXY_2_AUTH', '31280');

?>