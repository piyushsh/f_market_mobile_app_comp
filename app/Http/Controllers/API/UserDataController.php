<?php

namespace App\Http\Controllers\API;

use App\Repository\APIResponse;
use App\Repository\AppSession;
use App\Repository\FormDataRepository;
use App\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    /**
     * Saving Country of the User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveCountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required|in:'.implode(",",array_keys(FormDataRepository::countryList()))
        ]);
        if($validator->fails())
        {
            return $validator->errors()->all();
        }

        if(!$request->session()->has(AppSession::USER_ID))
        {
            $user = UserModel::create(['country'=>$request->country]);
            $user->save();
        }
        else
        {
            $user = UserModel::findOrNew($request->session()->get(AppSession::USER_ID));
            $user->country = $request->country;
            $user->save();
        }
        AppSession::updateUserDataSession($request->session(),$user);
        return response()->json([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL]);
    }
}
