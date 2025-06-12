<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <meta charset = "UTF-8">
    <meta id ="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body class ="modal-active">
<div id="app">
    <div class ="wrapper">
        <div id ="top">@yield('top')</div>
        <div class="middle-wrapper">
            <div id ="left">@yield('left')</div>
            <div id ="middle">@yield('middle')</div>
            <div id ="right">@yield('right')</div>
        </div>
        <div id="footer">@yield('footer')</div>
    </div>
</div>
</body>
</html>
