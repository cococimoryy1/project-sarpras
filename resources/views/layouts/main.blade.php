<!DOCTYPE html>
<html lang="en">

<head>
@include('layouts.header')
</head>

<body>
@include('layouts.banner')
@include('layouts.navbar')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
@include('layouts.sidebar')

@yield('content')

{{--  @include('layouts.footer')  --}}
</div>
</body>
@include('layouts.globaljs')
