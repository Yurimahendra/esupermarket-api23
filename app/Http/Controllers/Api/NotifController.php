<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function NotifOrder(Request $requset) {

        $mData = [
            'title' => "Notifikasi",
            'body' => "Ada Orderan Masuk Nih"
        ];

        /*$mData = [
            'title' => $requset->title,
            'body' => $requset->body
        ];*/

        $fcm[] = "en6bytplTNWQWQHj3ULjkV:APA91bHR9DIW3YYkg7LwsoY2G5hJTRxfVTM-45alLB1lBz7ftYeMsZDDMY41VFWkfOV6y-Kq7vucmsdmK1JAB5IYjOLzCNAduNk7Ehnim6DUp1kBX_CkFUX7k8t835LdBRhKGkRUG4ym";

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAATtoCTQ8:APA91bHaiOeK4E90uceFLJ-A5rXUyLR64u2WbCDHkNI0D9gLjp5NF9X1BW56zY7mIL6f1M0xVLNZD9SSW95qG7zCJjRgkxVpq3DcytB96J9Y5NOugaar1ZA72S-oP_DtsAFH7NXJxoV-"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }
}
