/**
 * Created by piyush sharma on 01-10-2015.
 */
"use strict";

var fmApp = angular.module('fm_app',['ngRoute']);

fmApp.config(['$routeProvider',function($routeProvider){
    $routeProvider
        .when('/',{})
        .when('/home',{
            redirecTo:'/'
        });
}]);
