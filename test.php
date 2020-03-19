<?php

    /* Send an SMS using Ultimate SMS. You can run this file 3 different ways:
     *
     * 1. Save it as test.php and at the command line, run
     *         php test.php
     *
     * 2. Upload it to a web host and load mywebhost.com/test.php
     *    in a web browser.
     *
     * 3. Download a local server like WAMP, MAMP or XAMPP. Point the web root
     *    directory to the folder containing this file, and load
     *    localhost:8888/test.php in a web browser.
     */

// Step 1: Get the Ultimate SMS API library from https://github.com/akasham67/ultimate-sms-api,
// following the instructions to install it with Composer.



    require_once 'src/Helpers/HTTPUtils.php';
    use Helpers\HTTPUtils;

    //use \TXTConnectSMS\ProcessTXTConnectSMS;

// Step 2: set your API_KEY from https://mywebhost.com/sms-api/info

    $api_key = 'jlkdkngbsjfd';

// Step 3: Change the from number below. It can be a valid phone number or a String
    $from = 'Mikeberg';

// Step 4: the number we are sending to - Any phone number
    $destination = '+233246004004';

// Step 5: Replace your Install URL like https://mywebhost.com/sms/api with https://ultimatesms.coderpixel.com/demo/
// <sms/api> is mandatory.

    $send_url = 'https://www.txtconnect.co/v2/app/api/send/sms.json';

    $balance_url = 'https://www.txtconnect.co/v2/app/api/others/balance.json';

// the sms body
    $sms = 'Hello, Testing txt connect library';



// Create SMS Body for request
    $sms_body = array(
        'token' => $api_key,
        'recipients' => $destination,
        'sender' => $from,
        'message' => $sms,
    );

// Step 6: instantiate a new Ultimate SMS API request
    $client = new HTTPUtils();

    //echo  $client->gen_uuid_v4();

    $bal = $client->doCurlPost($send_url,$sms_body);

    echo json_encode($bal);
