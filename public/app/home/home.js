/**
 * Created by piyush sharma on 04-10-2015.
 */
'use strict';

var fmAppHome = angular.module('fm_app.home',['ngRoute']);

    fmAppHome.controller('HomeController',['$http','$scope','$location',function($http,$scope,$location){
        $scope.sessionId;

        $scope.countryList;
        $scope.countryError;
        $scope.serverError;
        $scope.area_residence;

        $scope.init = function()
        {
            $http.get('initialize').success(function(data){
                $scope.sessionId = data.session_id;
                $scope.countryList = data.countries;
                $scope.area_residence = data.country;
                console.log(data);
            })
                .error(function(data){

                });

            $scope.countryError = false;
            $scope.serverError = false;
        };

        $scope.optionChange = function(){
            console.log("Area",$scope.area_residence);
            $scope.countryError = false;
        };

        $scope.nextStep = function(){
            console.log("Area",$scope.area_residence);
            if($scope.area_residence == "")
            {
                $scope.countryError = true;
            }
            else
            {
                for(var i=0;i<$scope.countryList.length;i++)
                {
                    if($scope.area_residence == $scope.countryList[i].key)
                    {
                        $scope.countryError = false;
                        break;
                    }
                }
                if($scope.countryError == false)
                {
                    $scope.serverError = false;

                    $http.post('save-country',{
                        'country' : $scope.area_residence,
                        'user_session' : $scope.sessionId
                    })
                        .success(function(data){
                            console.log("Reply",data);
                            $location.path('/personal-contact');
                        })
                        .error(function(data){
                            console.log("Error Reply",data);
                            $scope.serverError = true;
                        });
                }
            }
        };

        $scope.init();

    }]);