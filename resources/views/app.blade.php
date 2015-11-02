<!DOCTYPE html>
<html ng-app="fm_app">
<head lang="en">
    <meta charset="UTF-8">
    <title>Founders Market</title>
    <!-- Loading all the required StyleSheets -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/app-style.css')}}">

    <link rel="icon" href="http://foundersmarketapp.com/img/nn_icon.png" />

</head>
<body ng-controller="AppController">

    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <a href="//" class="logo"><img src="{{asset('images/logo.png')}}"></a>
                </div>
            </div>
        </div>
    </header>

    <div ng-view></div>

    @yield("content")

    <div class="overlay">
        <div class="pop_up_container">
            <div class="pop_up_box">
                <div class="box loading_box">
                    <img src="{{asset('images/loading.gif')}}">
                    <p class="">Loading ...</p>
                </div>
            </div>
        </div>

    </div>


    <!--- Adding all the scripts for the site -->
    <script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
    <script src="{{asset('js/angular-route.min.js')}}"></script>
    <script src="{{asset('js/angular-animate.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Angular Script Files -->
    <script src="{{asset('app/app.js')}}"></script>
    <script src="{{asset('app/home/home.js')}}"></script>
    <script src="{{asset('app/personal_info/contact_info.js')}}"></script>
    <script src="{{asset('app/idea/idea.js')}}"></script>
</body>
</html>