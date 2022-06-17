<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($message, $data = [], $code = \Illuminate\Http\Response::HTTP_OK) {
        $res = [
            'success'   => true,
            'message'   => $message,
        ];

        if(!empty($data)){
            $res['data'] = $data;
        }

        return response()->json($res, $code);
    }

    public function sendError($message, $code = \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY) {
        $res = [
            'success'   => false,
            'message'   => $message
        ];

        return response()->json($res, $code);
    }

    public function sendErrorException($message, $code = \Illuminate\Http\Response::HTTP_BAD_REQUEST) {
        $res = [
            'success'   => false,
            'message'   => config('app.env') == 'production' ? 'terjadi kesalahan server' : $message
        ];

        return response()->json($res, $code);
    }

}
