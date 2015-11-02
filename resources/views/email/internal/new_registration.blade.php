<style>
    .table
    {
        font-size:12px;
        font-family:Arial, sans-serif;
    }
    .table tr
    {
        border-bottom:1px solid #333333;
    }
    .table tr td
    {
        padding:2px;
    }
</style>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <p>Hi Team,</p>
            <p>New user has registered for the Idea Competition. Below are the person's details:</p>
            <table class="table">
                <tr>
                    <td>Email:</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Idea:</td>
                    <td>{{$idea->idea_title}}
                        <h5>Description about Idea:</h5>
                        <p>{{$idea->about_app_idea}}</p>
                    </td>
                </tr>
                <tr>
                    <td>Team size:</td>
                    <td>{{$idea->total_team_members}}</td>
                </tr>
                <tr>
                    <td>Team members:</td>
                    <td>
                        @foreach($teamMember as $key=>$value)
                            <span class="button"><a href="mailto:{{$value->team_member_email}}">{{$value->team_member_email}}</a></span> &nbsp;&nbsp;&nbsp;&nbsp;
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Designs:</td>
                    <td><a href="{{$idea->app_designs_link}}">{{$idea->app_designs_link}}</a></td>
                </tr>
            </table>

            <p>Thanks & Regards,<br>Founders Market</p>
        </div>
    </div>
</div>