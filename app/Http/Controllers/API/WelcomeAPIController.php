<?php

namespace App\Http\Controllers\API;

use App\Repository\APIResponse;
use App\Repository\AppSession;
use App\Repository\FormDataRepository;
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
        return response()->json([APIResponse::REQUEST_STATUS=>'200',
            'session_id'=>$request->session()->get(AppSession::SESSION_ID),
            "countries"=>FormDataRepository::jsonCountryList()]);
    }

}
