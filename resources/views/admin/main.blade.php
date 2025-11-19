<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medita México A.C | Administrador</title>
    <link rel="shortcut icon" href="{{asset('/assets/logo/ic_logo_white.svg')}}">
    @include('admin.template.global_css')
</head>
<body>
<div id="admin"></div>
@routes
<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
<input type="hidden" id="asset" value="{{asset('')}}">
@include('admin.template.global_js')
</body>
</html>
