<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medita México A.C | Administrador inicio</title>
    <link rel="shortcut icon" href="{{asset('/assets/logo/ic_logo_white.svg')}}">
    @include('admin.auth.template.global_css')
</head>
<body>
<div id="admin_login"></div>
@routes
@include('admin.auth.template.global_js')
</body>
</html>
