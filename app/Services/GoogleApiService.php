<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use GuzzleHttp\Psr7\Request;
use stdClass;

class GoogleApiService
{
    public function __invoke(): array
    {
        // configure the Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');

        $path = config_path().'/google_auth.json';
        $client->setAuthConfig($path);
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);
        $service = new \Google_Service_Sheets($client);
        $spreadsheetId = '1jqunNYUGpGOZ2B4ylSARhoUDgUJSHgHtFUCCEgFwbpA';
        $response = $service->spreadsheets_values->get($spreadsheetId, 'Hoja 1');
        return $response->getValues();
    }
}
