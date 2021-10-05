<?php

namespace App\Services;

use DateTime;

class MarvelService
{
    /**
     * Call Marvel Endpoint
     *
     * @param $url
     * @return string
     */
    public function callEndpoint($url, $limit = null)
    {
        $date = new DateTime();
        $timestamp=$date->getTimestamp();

        $keys=env('MARVEL_PRIVATE_KEY').env('MARVEL_PUBLIC_KEY');

        $string=$timestamp.$keys;
        $md5=hash('md5', $string);

        // create a new cURL resource
        $ch = curl_init();

        $marvelUrl = $url . "?ts=" . $timestamp . "&apikey=" . env('MARVEL_PUBLIC_KEY') . "&hash=" . $md5;
        if ($limit)
        {
            $marvelUrl .= "&limit=" . $limit;
        }

        curl_setopt($ch, CURLOPT_URL, $marvelUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json')
        );

         //Execute curl
        $output= curl_exec($ch) or die(curl_error());

        //Format JSON output
        return $output;
    }
}
