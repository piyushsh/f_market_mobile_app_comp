/**
 * Created by piyush sharma on 09-10-2015.
 */

"use strict";

var totalTeamMemberText = "*Number of people involved";
var ideaTitleText = "*Name of Idea";
var teamMemberEmailText = "*Email address of others Involved";

var fm_app_idea = angular.module("fm_app.idea",[]);

fm_app_idea.controller('TeamController',['$http','$scope',function($http,$scope){

    $scope.init = function(){
        $scope.idea_title = ideaTitleText;
        $scope.total_team_member = totalTeamMemberText;
        $scope.team_email_address = [{text:teamMemberEmailText}];
    };


    $scope.numberOfTeamMembers = function(){

        console.log("Log","N:" + $scope.total_team_member + "   V:" + $scope.team_email_address.length);
        for(var i=0;i<$scope.total_team_member;i++)
        {
            if(i > $scope.team_email_address.length-1)
            {
                $scope.team_email_address.push({text:teamMemberEmailText});
            }
        }

        if($scope.total_team_member < $scope.team_email_address.length && $scope.total_team_member != "")
        {
            console.log("Log N < T","Inside if N < T");
            $scope.team_email_address.splice($scope.total_team_member,$scope.team_email_address.length-1);
            if($scope.total_team_member == 0)
            {
                $scope.team_email_address.splice(0,1);
            }
        }
        if($scope.total_team_member == "")
        {
            console.log("Log N = Null","Inside if N is null");
            if($scope.team_email_address.length<=0)
            {
                $scope.team_email_address.push({text:teamMemberEmailText});
            }
            else if($scope.team_email_address.length >= 1)
            {
                $scope.team_email_address.splice(1,$scope.team_email_address.length-1);
            }
        }
    };


    $scope.fillTextBox = function(field){
        switch(field)
        {
            case "idea_title":
                if($scope.idea_title == ideaTitleText)
                {
                    $scope.idea_title = "";
                }
                else if($scope.idea_title == "")
                {
                    $scope.idea_title = ideaTitleText;
                }
                break;

            case "total_team_member":
                if($scope.total_team_member == totalTeamMemberText)
                {
                    $scope.total_team_member = "";
                }
                else if($scope.total_team_member == "")
                {
                    $scope.total_team_member = totalTeamMemberText;
                }
                break;
        }
    };

    $scope.init();

}]);


fm_app_idea.controller('IdeaDetailController',['$http','$scope',function($http,$scope){


}]);


fm_app_idea.controller('IdeaOtherDetailController',['$http','$scope',function($http,$scope){


}]);
