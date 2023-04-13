<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    @include("components.alerts")
    @yield("content")
</body>
</html>