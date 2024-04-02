<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class BaseController extends Controller
{
    /**
     * @param $data
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data = null, $message = null, $status = 200)
    {
        return response()->json(['data' => $data, 'message' => $message], $status);
    }

    /**
     * @param $data
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($data = null, $message = null, $status = 422)
    {
        return response()->json(['data' => $data, 'message' => $message], $status);
    }
}
