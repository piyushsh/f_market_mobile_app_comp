/**
 * Created by piyush sharma on 08-10-2015.
 */

'use strict';

var fmAppContact = angular.module('fm_app.contact_info',['ngRoute']);

fmAppContact.controller('ContactPageController',['$http','$scope',function($http,$scope){

    var emailText = "*Email address";
    var confirmEmailText = "*Confirm Email address";
    var phoneNumberText = "*Phone number";

    $scope.init = function(){
        $scope.email = emailText;
        $scope.confirm_email = confirmEmailText;
        $scope.phone_number = phoneNumberText;
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

    $scope.init();

}]);