<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        $data = [
            'status' => 'success',
            'message' => __($status)
        ];
        return response()->json(['data' => $data], 200);

        //return $status === Password::RESET_LINK_SENT
            //? response()->json([
                //'status' => 'success',
               // 'message' => __($status)
            //])
            //: response()->json([
             //   'status' => 'unsuccessful',
              //  'email' => __($status)
            //]);
    }
}
