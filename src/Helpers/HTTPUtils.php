<?php

    namespace Helpers;

    use http\Client;

    class HTTPUtils
    {
        public  function guzzPost($url, $payload, $headers)
        {
            $client = new Client(['verify' => false]);
            return $client->post($url, $payload);

        }

        public static function guzAuthPost($url, $payload, $sub_key)
        {
            $client = new Client();
            $credentials = base64_encode($payload);
            $response = $client->post($url,
                [
                    'headers' => [
                        'Authorization' => 'Basic '.$credentials,
                        'Ocp-Apim-Subscription-Key' => $sub_key,
                    ],
                ]);
            return $response->getBody();
        }

        public  function doCurlPost($url, $payload, $headers=array())
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $split = json_decode($response);

            if ($err) {
                array('error' => $err);
            } else {
                return $split;
            }

        }

        public  function doCurlGet($url, $headers){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',

            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $split = json_decode($response, true);

            if ($err) {
                array('error' => $err);
            } else {
                return $split;
            }

        }

        public  function gen_uuid_v4()
        {
            $uuid = '';
            try {
                $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    random_int(0, 0xffff), random_int(0, 0xffff),
                    random_int(0, 0xffff),
                    random_int(0, 0x0fff) | 0x4000,
                    random_int(0, 0x3fff) | 0x8000,
                    random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff)
                );
            } catch (\Exception $e) {
            }

            return $uuid;
        }

        public  function get_all_headers()
        {
            return getallheaders();
        }



    }
