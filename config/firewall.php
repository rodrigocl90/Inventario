<?php

return [

    /*
     * Enable / disable firewall
     *
     */


/*Para utilizarlo limipiar cache
config:clear;
cache:clear;
route: clear;

*/

    'enabled' => env('FIREWALL_ENABLED', true),

    /*
     * Whitelisted and blacklisted IP addresses, ranges, countries, files and/or files of files
     *
     *  Examples of IP address, hosts, country codes and CIDRs
     *      '127.0.0.1',
     *      '192.168.17.0/24'
     *      '127.0.0.1/255.255.255.255'
     *      '10.0.0.1-10.0.0.255'
     *      '172.17.*.*'
     *      'country:br'
     *      'host:google.com',
     *      storage_path().DIRECTORY_SEPARATOR.'blacklisted.txt', // a file with IPs, one per line
     */

    'blacklist' => [


    ],

    'whitelist' => [



//TELEFÓNICA CHILE S.A.

'179.8.0.0/15',
'181.160.0.0/15',
'181.162.0.0/16',
'181.163.0.0/16',
'181.225.112.0/22',
'186.78.0.0/16',
'186.79.0.0/16',
'186.104.0.0/15',
'186.106.0.0/15',
'190.20.0.0/16',
'190.21.0.0/16',
'190.22.0.0/16',
'191.112.0.0/14',
'200.28.0.0/19',
'200.28.48.0/20',
'200.28.64.0/18',
'200.28.160.0/19',
'200.50.32.0/19',
'200.89.32.0/19',
'200.90.208.0/20',
'200.90.224.0/20',
'200.90.240.0/20',
'200.112.0.0/17',
'201.222.128.0/17',
'201.223.0.0/16',
'201.246.0.0/16',

//VTR BANDA ANCHA S.A.

'186.156.0.0/16',
'190.44.0.0/16',
'190.45.0.0/16',
'190.46.0.0/15',
'190.100.0.0/16',
'190.101.0.0/16',
'190.160.0.0/15',
'190.162.0.0/15',
'190.164.0.0/16',
'200.30.192.0/18',
'200.73.224.0/19',
'200.74.0.0/17',
'200.83.0.0/16',
'200.86.0.0/16',
'200.104.0.0/16',
'200.120.0.0/16',
'201.214.0.0/16',
'201.215.0.0/16',
'201.239.0.0/16',
'201.241.0.0/16',

//ENTEL CHILE S.A.


'152.231.96.0/19',
'186.67.237.0/24',
'186.67.238.0/23',
'186.67.240.0/20',


//Telefónica del Sur S.A.


'179.56.0.0/15',
'181.226.0.0/16',
'190.95.0.0/17',
'201.186.0.0/16',


//Entel PCS Telecomunicaciones S.A.

'181.42.0.0/16',
'181.43.0.0/17',
'186.9.0.0/16',
'186.11.0.0/16',
'186.37.0.0/16',
'190.91.0.0/16',


//TELEFONICA MOVIL DE CHILE S.A.

'152.172.0.0/14',
'181.172.0.0/15',
'181.200.0.0/14',
'186.40.0.0/16',
'186.41.0.0/16',
'186.65.128.0/17',
'190.4.192.0/18',
'190.108.128.0/19',
'190.108.160.0/19',
'191.124.0.0/14',
'201.187.128.0/17',
'201.188.0.0/15',
'201.220.224.0/20',
'201.220.240.0/20',


//Telmex Chile S.A.


'190.54.64.0/19',
'190.82.0.0/18',
'190.82.128.0/17',
'190.209.0.0/16',
'200.236.112.0/20',
'200.236.160.0/19',


//BANDA ANCHA GTD MANQUEHUE

'200.74.184.0/21',

//Terra Networks
'200.28.32.0/21',


//Pacifico Cable S.A.


'138.99.224.0/22',
'179.60.64.0/19',
'190.5.32.0/19',
'190.102.224.0/20',
'190.102.240.0/20',
'190.110.160.0/20',
'190.114.32.0/19',
'200.73.120.0/21',
'207.248.192.0/19',


//Telmex Servicios Empresariales S.A.


'181.72.0.0/15',
'181.74.0.0/15',
'186.34.0.0/16',
'186.35.0.0/16',
'186.36.0.0/16',
'190.54.128.0/19',
'190.54.160.0/20',
'190.54.192.0/18',


 //Claro Chile S.A.

'179.2.0.0/15',
'179.4.0.0/16',
'186.20.0.0/16',
'186.21.0.0/16',
'186.172.0.0/14',
'190.110.128.0/19',
'191.116.0.0/14',
  
  //GlobalNet S.A.

'167.28.0.0/16',

//Sociedad de Telecomunicaciones Alerce Television por Cable Ltda.

'200.126.34.0/23',
'200.126.36.0/23',



//Servicios de Telecomunicaciones Cable Hogar BIO-BIO Ltda.


'201.221.113.0/24',
'201.221.114.0/23',
'201.221.116.0/22',


//CTC Transmisiones Regionales S.A.


'186.148.0.0/19',

//Netline


'201.219.134.0/23',
'201.219.136.0/21',
'201.219.144.0/21',
'201.219.152.0/22',



'127.0.0.1',



    ],

    /*
     * Response action for blocked responses
     *
     */

    'responses' => [
        'blacklist' => [
            'code' => 403, // 200 = log && notify, but keep pages rendering

            'message' => null,

            'view' => null,

            'redirect_to' => null,

            'abort' => false, // return abort() instead of Response::make() - disabled by default
        ],

        'whitelist' => [
            'code' => 403, // 200 = log && notify, but keep pages rendering

            'message' => null,

            'view' => null,

            'redirect_to' => null,

            'abort' => false, // return abort() instead of Response::make() - disabled by default
        ],
    ],

    /*
     * Do you wish to redirect non whitelisted accesses to an error page?
     *
     * You can use a route name (coming.soon) or url (/coming/soon);
     *
     */

    'redirect_non_whitelisted_to' => null,

    /*
     * How long should we keep IP addresses in cache?
     *
     * This is a general client IP addresses cache. When the user hits your ssytem his/her IP address
     * is searched and cached for the desired time. Finding an IP address contained in a CIDR
     * range (172.17.0.0/24, for instance) can be a "slow", caching it improves performance.
     *
     */

    'cache_expire_time' => 60, // minutes

    /*
     * How long should we keep lists of IP addresses in cache?
     *
     * This is the list cache. Database lists can take some time to load and process,
     * caching it, if you are not making frequent changes to your lists, may improve firewall speed a lot.
     */

    'ip_list_cache_expire_time' => 0, // minutes - disabled by default

    /*
     * Send suspicious events to log?
     *
     */

    'enable_log' => true,

    /*
     * Search by range allow you to store ranges of addresses in
     * your black and whitelist:
     *
     *   192.168.17.0/24 or
     *   127.0.0.1/255.255.255.255 or
     *   10.0.0.1-10.0.0.255 or
     *   172.17.*.*
     *
     * Note that range searches may be slow and waste memory, this is why
     * it is disabled by default.
     *
     */

    'enable_range_search' => true,

    /*
     * Search by country range allow you to store country ids in your
     * your black and whitelist:
     *
     *   php artisan firewall:whitelist country:us
     *   php artisan firewall:blacklist country:cn
     *
     */

    'enable_country_search' => false,

    /*
     * Should Firewall use the database?
     */

    'use_database' => false,

    /*
     * Models
     *
     * When using the "eloquent" driver, we need to know which Eloquent models
     * should be used.
     *
     */

    'firewall_model' => 'PragmaRX\Firewall\Vendor\Laravel\Models\Firewall',

    /*
     * Session object binding in the IoC Container
     *
     * When blacklisting IPs for the current session, Firewall
     * will need to instantiate the session object.
     *
     */

    'session_binding' => 'session',

    /*
     * GeoIp2 database path.
     *
     * To get a fresh version of this file, use the command
     *
     *      php artisan firewall:updategeoip
     *
     */

    'geoip_database_path' => __DIR__.'/geoip', //storage_path('geoip'),

    /*
     * Block suspicious attacks
     */

    'attack_blocker' => [

        'enabled' => [
            'ip' => true,

            'country' => false,
        ],

        'cache_key_prefix' => 'firewall-attack-blocker',

        'allowed_frequency' => [

            'ip' => [
                'requests' => 50,

                'seconds' => 1 * 60, // 1 minute
            ],

            'country' => [
                'requests' => 3000,

                'seconds' => 2 * 60, // 2 minutes
            ],

        ],

        'action' => [

            'ip' => [
                'blacklist_unknown' => true,

                'blacklist_whitelisted' => false,
            ],

            'country' => [
                'blacklist_unknown' => false,

                'blacklist_whitelisted' => false,
            ],

        ],

        'response' => [
            'code' => 403, // 200 = log && notify, but keep pages rendering

            'message' => null,

            'view' => null,

            'redirect_to' => null,

            'abort' => false, // return abort() instead of Response::make() - disabled by default
        ],

    ],

    'notifications' => [
        'enabled' => true,

        'message' => [
            'title' => 'User agent',

            'message' => "A possible attack on '%s' has been detected from %s",

            'request_count' => [
                'title' => 'Request count',

                'message' => 'Received %s requests in the last %s seconds. Timestamp of first request: %s',
            ],

            'uri' => [
                'title' => 'First URI offended',
            ],

            'blacklisted' => [
                'title' => 'Was it blacklisted?',
            ],

            'user_agent' => [
                'title' => 'User agent',
            ],

            'geolocation' => [
                'title' => 'Geolocation',

                'field_latitude' => 'Latitude',

                'field_longitude' => 'Longitude',

                'field_country_code' => 'Country code',

                'field_country_name' => 'Country name',

                'field_city' => 'City',
            ],
        ],

        'route' => '',

        'from' => [
            'name' => 'Laravel Firewall',

            'address' => 'firewall@mydomain.com',

            'icon_emoji' => ':fire:',
        ],

        'users' => [
            'model' => PragmaRX\Firewall\Vendor\Laravel\Models\User::class,

            'emails' => [
                'admin@mydomain.com',
            ],
        ],

        'channels' => [
            'slack' => [
                'enabled' => true,
                'sender'  => PragmaRX\Firewall\Notifications\Channels\Slack::class,
            ],

            'mail' => [
                'enabled' => true,
                'sender'  => PragmaRX\Firewall\Notifications\Channels\Mail::class,
            ],
        ],
    ],
];
