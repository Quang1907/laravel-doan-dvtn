<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function sendResponse( $result, $message ) {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message,
        ];

        return response()->json( $response, 200 );
    }

    public function sendError( $error, $errorMessages = [], $code = 404 ) {
            $response = [
                "status" => false,
                "message" => $error,
            ];
            if ( !empty( $errorMessages ) ) {
                $response[ 'data' ] = $errorMessages;
            }
            return response()->json( $response, $code );
    }
}
