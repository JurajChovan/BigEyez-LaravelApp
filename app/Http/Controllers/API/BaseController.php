<?php
/* ------------------------------------------------------------------------------------------------------------ */
namespace App\Http\Controllers\API;
/* ------------------------------------------------------------------------------------------------------------ */
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
/* ------------------------------------------------------------------------------------------------------------ */
class BaseController extends Controller {
    /* ------------------------------------------------------------------------------------------------------------ */
    public function sendFullResponse($result, $message)    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    public function sendResponse($result)    {
        return response()->json($result, 200);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    public function sendError($error, $errorMessages = [], $code = 404)    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
}
