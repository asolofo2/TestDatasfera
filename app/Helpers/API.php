<?php

namespace App\Helpers;

class API
{
    public static function apiLink(string $link, string $version): string
    {
        return 'https://' . env('SUB_DOMAIN') . '.amocrm.ru/api/' . $version . '/' . $link;
    }

    public static function getAPI(string $link, bool $active = false): array
    {
        /** Формируем заголовки */
        $headers = [
            'Authorization: Bearer ' . env('ACCESS_TOKEN')
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPGET => 1, // CURLOPT_HTTPGET вместо CURLOPT_POST
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $link,
            CURLOPT_HTTPHEADER => $headers // передаём заголовки
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($result, 1);

        return ($active ? $results['_embedded'] : $results['_embedded']['items']) ?? [];
    }
}
