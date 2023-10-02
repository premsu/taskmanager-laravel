<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager | @yield('title')</title>
    @include('layout.css')
    @yield('style')
</head>
<body>
    @yield('content')
    @include('layout.js')
    @yield('customjs')
</body>
</html>
