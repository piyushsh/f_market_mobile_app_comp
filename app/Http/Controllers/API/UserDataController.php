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

        return response()->json([APIResponse::REQUEST_STATUS=>APIResponse::SUCCESSFUL]);
    }



}
