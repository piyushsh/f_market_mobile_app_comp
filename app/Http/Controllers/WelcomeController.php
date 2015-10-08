<?php

namespace App\Http\Controllers;

use App\Repository\AppSession;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public $appSession;

    public function __construct()
    {
        $this->appSession = new AppSession();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->appSession->initalizeNewUser($request->session());
        return view('app');
    }
}
