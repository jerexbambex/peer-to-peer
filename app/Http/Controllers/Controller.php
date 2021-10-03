<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function myJson($status, $message, $statusCode): JsonResponse
    {
        $data = [
            'status' => "{$status}",
            'message' => "{$message}"
        ];

        return response()->json(['data' => $data], $statusCode);
    }
}
