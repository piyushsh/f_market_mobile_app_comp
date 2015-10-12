/**
 * Created by piyush sharma on 09-10-2015.
 */

"use strict";

var totalTeamMemberText = "*Number of people involved";
var ideaTitleText = "*Name of Idea";
var teamMemberEmailText = "*Email address of others Involved";

var REQUEST_STATUS = {request_status:"request_status",successful:"200",internal_error:"500",not_found:"404",validation_error:"422"};

var fm_app_idea = angular.module("fm_app.idea",[])
    .constant("REQUEST_STATUS", REQUEST_STATUS);

fm_app_idea.controller('TeamController',['$http','$scope','$location','REQUEST_STATUS',function($http,$scope,$location,REQUEST_STATUS){

    var nextButClicked = false;

    $scope.ideaTitleError = false;
    $scope.totalTeamCountError = false;
    //$scope.teamEmailError = [false];

    $scope.init = function(){
        $scope.idea_title = "";
        $scope.total_team_member = "";
        $scope.team_email_address = [""];

        $http.get('user-data')
            .success(function(data){
               if(data[REQUEST_STATUS.request_status] == REQUEST_STATUS.successful)
               {
                   console.log(data);
                   if(data.user_id == undefined || data.user_id == null)
                   {
                       $location.path('/');
                   }
                   $scope.idea_title = data.idea_title;
                   $scope.total_team_member = data.total_team_members;
                   $scope.team_email_address = data.team_member_emails;
               }
            })
            .error(function(data){
                $location.path('/');
            });
    };


    $scope.numberOfTeamMembers = function(){
        $scope.totalTeamCountError = false;

        nextButClicked=false;
        //console.log("Log","N:" + $scope.total_team_member + "   V:" + $scope.team_email_address.length);
        for(var i=0;i<$scope.total_team_member;i++)
        {
            if(i > $scope.team_email_address.length-1)
            {
                $scope.team_email_address.push("");
                //$scope.teamEmailError.push(false);
            }
        }

        if($scope.total_team_member < $scope.team_email_address.length && $scope.total_team_member != "")
        {
            //console.log("Log N < T","Inside if N < T");
            $scope.team_email_address.splice($scope.total_team_member,$scope.team_email_address.length-1);
            if($scope.total_team_member == 0)
            {
                $scope.team_email_address.splice(0,1);
                //$scope.teamEmailError.splice(0,1);
            }
        }
        if($scope.total_team_member == "")
        {
            //console.log("Log N = Null","Inside if N is null");
            if($scope.team_email_address.length<=0)
            {
                $scope.team_email_address.push("");
                //$scope.teamEmailError.push(false);
            }
            else if($scope.team_email_address.length >= 1)
            {
                $scope.team_email_address.splice(1,$scope.team_email_address.length-1);
                //$scope.teamEmailError.splice(1,$scope.team_email_address.length-1);
            }
        }
    };


    $scope.nextStep = function(){
        var validationError = false;
        nextButClicked = true;
        if($scope.idea_team_form.idea_title.$error["required"])
        {
            $scope.ideaTitleError = true;
            validationError=true;
        }
        if($scope.idea_team_form.total_team_member.$error["required"] || $scope.idea_team_form.total_team_member.$error["max"])
        {
            $scope.totalTeamCountError = true;
            validationError=true;
        }

        if(validationError)
        {
            return false;
        }

        if($scope.idea_team_form.$valid)
        {
            $http.post('idea-team',{
                'idea_title':$scope.idea_title,
                'total_team_member':$scope.total_team_member,
                'team_member_emails':$scope.team_email_address
            })
                .success(function(data){
                    console.log(data);
                    $location.path('/idea-detail');
                })
                .error(function(data){
                    console.log(data);
                });
        }

    };

    $scope.showTeamEmailError = function(elementModelController,validation){

        if(nextButClicked)
            return elementModelController.$error[validation] || elementModelController.$error["required"];
        else
            return false;
    };

    $scope.init();

}]);


fm_app_idea.controller('IdeaDetailController',['$http','$scope','$location',function($http,$scope,$location){

    var nextButClicked=false;

    $scope.init = function(){
        $scope.startup_exp="";

        $http.get('user-data')
            .success(function(data){
                if(data[REQUEST_STATUS.request_status] == REQUEST_STATUS.successful)
                {
                    console.log(data.startup_experience);
                    if(data.user_id == undefined || data.user_id == null)
                    {
                        $location.path('/');
                    }
                    $scope.startup_exp = (data.startup_experience == "1" || data.startup_experience == "0")? (data.startup_experience).toString() : "";
                    $scope.startup_about = data.about_startup_experience != null ? data.about_startup_experience : "";
                    $scope.idea = data.about_app_idea != null ? data.about_app_idea : "";
                }
            })
            .error(function(data){
                $location.path('/');
            });
    };


    $scope.nextStep = function(){

        nextButClicked = true;

        if($scope.idea_detail_form.$valid)
        {
            $http.post('idea-details',{
                'startup_exp':$scope.startup_exp,
                'startup_about':$scope.startup_about,
                'idea':$scope.idea
            })
                .success(function(data){
                    console.log(data);
                    $location.path('/idea-other-detail');
                })
                .error(function(data){
                    console.log(data);
                });
            nextButClicked=false;
        }

    };

    $scope.showError = function(elementModelController,validation){

        if(nextButClicked)
            return elementModelController.$error[validation];
        else
            return false;
    };

    $scope.init();

}]);


fm_app_idea.controller('IdeaOtherDetailController',['$http','$scope','$location',function($http,$scope,$location){


    $scope.init = function(){

        $http.get('user-data')
            .success(function(data){
                if(data[REQUEST_STATUS.request_status] == REQUEST_STATUS.successful)
                {
                    console.log(data);
                    if(data.user_id == undefined || data.user_id == null)
                    {
                        $location.path('/');
                    }
                    $scope.additional_info = data.additional_information;
                }
            })
            .error(function(data){
                $location.path('/');
            });
    };


    $scope.nextStep = function(){

        if($scope.idea_detail_form.$valid)
        {
            $http.post('idea-additional-info',{
                'startup_exp':$scope.startup_exp,
                'startup_about':$scope.startup_about,
                'idea':$scope.idea
            })
                .success(function(data){
                    console.log(data);
                    $location.path('/idea-other-detail');
                })
                .error(function(data){
                    console.log(data);
                });
        }

    };

    $scope.init();

}]);
