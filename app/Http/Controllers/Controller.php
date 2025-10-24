<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function respondWithSuccess($message, $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'source_api' => getInfo()->title,
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function respondWithError($message, $error, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'source_api' => getInfo()->title,
            'error' => $error,
        ], $statusCode);
    }

    public function validationMessages()
    {
        return [
            'required' => 'Field :attribute harus diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Field :attribute harus berupa file gambar.',
        ];
    }
}
