/**
 * Created by piyush sharma on 01-10-2015.
 */
'use strict';

var fmApp = angular.module('fm_app',['ngRoute','fm_app.home','fm_app.contact_info','fm_app.idea']);

fmApp.config(['$routeProvider',function($routeProvider){
    $routeProvider
        .when('/',{
            redirectTo : '/home'
        })
        .when('/home',{
            templateUrl:'app/home/home.html',
            controller: 'HomeController'
        })
        .when('/personal-contact',{
            templateUrl:'app/personal_info/contact_info.html'
        })
        .when('/idea-team',{
            templateUrl : 'app/idea/idea-team.html'
        })
        .when('/idea-detail',{
            templateUrl : 'app/idea/idea-detail.html'
        })
        .when('/idea-other-detail',{
            templateUrl : 'app/idea/idea-other-detail.html'
        })
        .when('/thank-you',{
            templateUrl : 'app/thank-you.html'
        });
}]);

fmApp.controller('AppController',['$http','$scope',function($http,$scope){


}]);


