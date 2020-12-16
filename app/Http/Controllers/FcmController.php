<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function index()
    {
        $curl = curl_init();
        $authKey = "key=AAAASvf3JK0:APA91bGqBj6e_RRUia-EFViZgUf1Jch8un4yQxMrVqNRB3SD-xbXdT6cM0Cd7B2MX8SI2C_NPjxJIapAgUHoiqyRzhRDgVAcdRdX4tWnCMgsRrevyN8gms4FbzT2inCnu0jwoOeOGv0F";
        $registration_ids = '["1"]';
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                        "registration_ids": ' . $registration_ids . ',
                        "notification": {
                            "title": "Judul Notifikasi",
                            "body": "Isi Notifikasi"
                        }
                    }',
        CURLOPT_HTTPHEADER => array(
            "Authorization: " . $authKey,
            "Content-Type: application/json",
            "cache-control: no-cache"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }
}
