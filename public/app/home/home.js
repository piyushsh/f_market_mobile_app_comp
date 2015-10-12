/**
 * Created by piyush sharma on 04-10-2015.
 */
'use strict';

var REQUEST_STATUS = {request_status:"request_status",successful:"200",internal_error:"500",not_found:"404",validation_error:"422"};

var fmAppHome = angular.module('fm_app.home',['ngRoute'])
    .constant("REQUEST_STATUS", REQUEST_STATUS);

    fmAppHome.controller('HomeController',['$http','$scope','$location','REQUEST_STATUS',function($http,$scope,$location,REQUEST_STATUS){
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
                //console.log(data);
            })
                .error(function(data){

                });

            $scope.countryError = false;
            $scope.serverError = false;
        };

        $scope.optionChange = function(){

            $scope.countryError = false;
        };

        $scope.nextStep = function(){

            if($scope.area_residence == "" || $scope.area_residence == undefined)
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

                            if(data[REQUEST_STATUS.request_status] == REQUEST_STATUS.successful)
                            {
                                $location.path('/personal-contact');
                            }
                            else if(data[REQUEST_STATUS.request_status] == REQUEST_STATUS.validation_error)
                            {
                                $scope.countryError = true;
                            }
                        })
                        .error(function(data){
                            $scope.serverError = true;
                        });
                }
            }
        };

        $scope.init();

    }]);