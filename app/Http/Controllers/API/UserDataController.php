<?php

namespace App\Http\Controllers\API;

use App\IdeaModel;
use App\Repository\APIResponse;
use App\Repository\AppSession;
use App\Repository\FormDataRepository;
use App\TeamModel;
use App\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{

    const STORAGE_FILE_DIRECTORY = "storage/app/idea-competition";


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


    /**
     * Saving personal details of the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePersonalDetails(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'contact_no' => 'required'
        ]);
        if($validator->fails())
        {
            return $validator->errors()->all();
        }

        $user = UserModel::find($request->session()->get(AppSession::USER_ID));
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;
        $user->save();

        return response()->json([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL]);
    }


    /**
     * Saving idea and team details
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveIdeaTeam(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'idea_title'=>'required',
            'total_team_member'=>'required|numeric'
        ]);

        if($validator->fails())
        {
            return $validator->errors()->all();
        }

        $user = UserModel::find($request->session()->get(AppSession::USER_ID));
        $user->idea()->delete();
        $idea = new IdeaModel(["idea_title"=>$request->idea_title,"total_team_members"=>$request->total_team_member]);
        $user->idea()->save($idea);

        foreach($request->team_member_emails as $key=>$value)
        {
            $team = new TeamModel(["idea_id"=>$idea->idea_id,"team_member_email"=>$value]);
            $idea->teamMembers()->save($team);
//            $team->save();
        }

        return response()->json([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL]);
    }


    /**
     * Saving Idea Details
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveIdeaDetails(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'startup_exp'=>'required|in:0,1',
            'idea'=>'required'
        ]);
        if($validator->fails())
        {
            return $validator->errors()->all();
        }

        $idea = IdeaModel::where('user_id','=',$request->session()->get(AppSession::USER_ID))->first();

        $idea->startup_experience = $request->startup_exp;
        $idea->about_startup_experience = $request->startup_about;
        $idea->about_app_idea = $request->idea;

        $idea->save();

        return response()->json([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL]);
    }


    /**
     * Saving additional Details of the idea
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveIdeaAdditionalDetails(Request $request)
    {
        $path_for_user = (self::STORAGE_FILE_DIRECTORY."/designs_".$request->session()->get(AppSession::USER_ID));
        $jsonReply = array_merge([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL],$request->all());
        $files = Input::file("file");
        if(count($files)>0)
        {
            foreach($files as $key=>$file)
            {
                $file->move(public_path()."/".$path_for_user,$file->getClientOriginalName());
            }
        }

        $idea = IdeaModel::where('user_id','=',$request->session()->get(AppSession::USER_ID))->first();

        $idea->additional_information = $request->additional_info;
        $idea->app_designs_link = asset($path_for_user);
        $idea->save();

        $user = UserModel::find($request->session()->get(AppSession::USER_ID));
        $teamMember = $idea->teamMembers;

        Mail::send('email.confirm', [], function ($m) use ($user,$teamMember) {
            $m->to($user->email)->subject('Founders Market :: Thanks for Registering form the Competition');
        });

        Mail::send('email.internal.new_registration', ['user'=>$user,'idea'=>$idea,'teamMember'=>$teamMember], function ($m) use ($user) {
            $m->to("philip@foundersmarketapp.com")->cc("izaac@foundersmarketapp.com")->subject('Founders Market :: New user registered for Idea Competition');
        });

    }



}
