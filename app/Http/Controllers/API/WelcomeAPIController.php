<?php

namespace App\Http\Controllers\API;

use App\Repository\APIResponse;
use App\Repository\AppSession;
use App\Repository\FormDataRepository;
use App\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeAPIController extends Controller
{

    /**
     * Initializing Welcome view with initial data needed on the View
     *
     * @param Request $request
     * @return mixed
     */
    public function initializeWelcomeView(Request $request)
    {
        $user = null;

        $jsonArrayReply = [APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL,
            'session_id'=>$request->session()->get(AppSession::SESSION_ID),
            "countries"=>FormDataRepository::jsonCountryList()];

        if($request->session()->has(AppSession::USER_ID))
        {
            $user = UserModel::find($request->session()->get(AppSession::USER_ID))->toArray();
            $jsonArrayReply=array_merge($jsonArrayReply,$user);
        }

        return response()->json($jsonArrayReply);
    }


    /**
     * Providing All user data to the App
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userData(Request $request)
    {
        $user = UserModel::find($request->session()->get(AppSession::USER_ID))->toArray();

        $jsonResponse = [APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL];
        $jsonResponse = array_merge($jsonResponse,$user);

        return response()->json($jsonResponse);
    }

}
