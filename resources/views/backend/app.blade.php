<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hauser Meier Architektinnen - Administration</title>
<link href="{{ mix('assets/backend/css/app.css') }}" type="text/css" rel="stylesheet" />
<script src="{{ asset('assets/backend/js/tinymce/tinymce.min.js') }}"></script>
<meta name="csrf-token" value="{{ csrf_token() }}" />
</head>
<body>
<div id="app">
    <app-component></app-component>
</div>
<script src="{{ mix('assets/backend/js/app.js') }}" type="text/javascript"></script>
</body>
</html>