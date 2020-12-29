<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// class FcmController extends Controller
// {
//     public function index()
//     {
//         $curl = curl_init();
//         $authKey = "key=AAAASvf3JK0:APA91bGqBj6e_RRUia-EFViZgUf1Jch8un4yQxMrVqNRB3SD-xbXdT6cM0Cd7B2MX8SI2C_NPjxJIapAgUHoiqyRzhRDgVAcdRdX4tWnCMgsRrevyN8gms4FbzT2inCnu0jwoOeOGv0F";
//         $registration_ids = '["eaE4f3-OSZ-klmZ1V_FG7h:APA91bHu58yNlUrWRswQP_oYWTYdyprlIz3rPYHHXU2QZ9zeNBHzuzAqee3SDXZIumCe8FNPz9oSAuUjgVO5-xI_hP9mgtHhnS4VmDtY-x317MK4s9xZP3a4hNm91CW-PTrSunmAJckD"]';
//         curl_setopt_array($curl, array(
//         CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "POST",
//         CURLOPT_POSTFIELDS => '{
//                         "registration_ids": ' . $registration_ids . ',
//                         "notification": {
//                             "title": "Hi, Daniel",
//                             "body": "Isi Notifikasimu"
//                         },
//                         "data": {
//                             "click_action": "FLUTTER_NOTIFICATION_CLICK",
//                             "key1": "Andreas",
//                             "key2": "13240005",
//                             "key3": "Wonogiri",
//                             "key4": "Jogja",
//                         }
//                     }',
//         CURLOPT_HTTPHEADER => array(
//             "Authorization: " . $authKey,
//             "Content-Type: application/json",
//             "cache-control: no-cache"
//         ),
//         ));

//         $response = curl_exec($curl);
//         $err = curl_error($curl);

//         curl_close($curl);

//         if ($err) {
//         echo "cURL Error #:" . $err;
//         } else {
//         echo $response;
//         }
//     }
// }
