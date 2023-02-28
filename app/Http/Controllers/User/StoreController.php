<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\UserData\UserData;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (in_array($data['email'],UserData::USERS)) {
            return  response()->json(['isUserExist' => true], 422);
        };
        return response()->json(['success' => 'Registration is successful']);



    }
}
