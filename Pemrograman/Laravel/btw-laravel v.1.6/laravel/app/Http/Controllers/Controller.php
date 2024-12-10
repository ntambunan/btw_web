<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    public static function response($code) : array {
        $dictionary = [
            200 => 'Operation: Success',
            404 => 'Operation: Not Found',
            500 => 'Operation: Failed',
        ];

        return [
            'response'=>$code,
            'response_msg'=>$dictionary[$code]
        ];
    }
}
