<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $dataArray = $result ;

        $response = [
            'success' => true,
            'data' => $dataArray,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error , $errorMessage=[], $code=404)
    {
     $response = [
         'success' => false,
         'data' => $error,
     ];
       return response()->json($response ,$code);
    }
}
