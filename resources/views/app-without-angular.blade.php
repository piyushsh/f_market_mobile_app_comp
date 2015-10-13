<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Founders Market</title>
    <!-- Loading all the required StyleSheets -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/app-style.css')}}">

</head>
<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <a href="//" class="logo"><img src="{{asset('images/logo.png')}}"></a>
                </div>
            </div>
        </div>
    </header>

    @yield("content")


    <!--- Adding all the scripts for the site -->
    <script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>
</html>