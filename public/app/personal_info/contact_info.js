/**
 * Created by piyush sharma on 08-10-2015.
 */

'use strict';

var REQUEST_STATUS = {request_status:"request_status",successful:"200",internal_error:"500",not_found:"404",validation_error:"422"};

var fmAppContact = angular.module('fm_app.contact_info',['ngRoute','fm_app.services'])
    .constant("REQUEST_STATUS", REQUEST_STATUS);

fmAppContact.controller('ContactPageController',['$http','$scope','$location','REQUEST_STATUS','popUpService',function($http,$scope,$location,REQUEST_STATUS,popUpService){

    var emailText = "*Email address";
    var confirmEmailText = "*Confirm Email address";
    var phoneNumberText = "*Phone number";

    $scope.emailError = false;
    $scope.confirmEmailError = false;
    $scope.phoneNumberError = false;

    $scope.init = function(){

        $http.get('user-data')
            .success(function(data){
                console.log(data);
                $scope.email = data.email != "" ? data.email : emailText;
                $scope.confirm_email = data.email != "" ? data.email : confirmEmailText;
                $scope.phone_number = data.contact_no != "" ? data.contact_no : phoneNumberText;
            })
            .error(function(data){

            });


    };

    $scope.fillTextBox = function(field){
        switch(field)
        {
            case "email":
                if($scope.email == emailText)
                {
                    $scope.email = "";
                }
                else if($scope.email == "")
                {
                    $scope.email = emailText;
                }
                break;
            case "confirm_email":
                if($scope.confirm_email == confirmEmailText)
                {
                    $scope.confirm_email = "";
                }
                else if($scope.confirm_email == "")
                {
                    $scope.confirm_email = confirmEmailText;
                }
                break;
            case "phone_number":
                if($scope.phone_number == phoneNumberText)
                {
                    $scope.phone_number = "";
                }
                else if($scope.phone_number == "")
                {
                    $scope.phone_number = phoneNumberText;
                }
                break;
        }
    };

    $scope.nextStep = function(){
        $scope.emailError = false;
        $scope.confirmEmailError = false;
        $scope.phoneNumberError = false;

        console.log("Test",$scope.personal_details.confirm_email);

        if($scope.email == emailText || $scope.personal_details.email.$error['email'] || $scope.personal_details.email.$error['required'])
        {
            $scope.emailError = true;
        }
        if($scope.confirm_email == confirmEmailText || ($scope.confirm_email).toLowerCase() != ($scope.email).toLowerCase() || $scope.personal_details.confirm_email.$error['email'] || $scope.personal_details.confirm_email.$error['requied'])
        {
            $scope.confirmEmailError = true;
        }
        if($scope.phone_number == phoneNumberText || $scope.personal_details.phone_number.$error['required'])
        {
            $scope.phoneNumberError = true;
        }

        if($scope.emailError || $scope.confirmEmailError || $scope.phoneNumberError)
        {
            return false;
        }

        popUpService.showLoadingPopUp();

        $http.post('personal-details',{
            'email': $scope.email,
            'contact_no' : $scope.phone_number
        })
            .success(function(data){
                console.log("data",data);
                $location.path('/idea-team');
            })
            .error(function(data){
                console.log("data",data);
            })
            .finally(function(){
                popUpService.hideLoadingPopUp();
            });
    };


    $scope.init();

}]);