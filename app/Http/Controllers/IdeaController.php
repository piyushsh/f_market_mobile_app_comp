<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class IdeaController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveIdeaOtherDetails(Request $request)
    {
        $files = Input::file('designs');
        // Making counting of uploaded images
        $file_count = count($files);
        dd($request->all());
        return redirect('/thank-you');
    }

}
