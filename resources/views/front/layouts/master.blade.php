<!DOCTYPE html>
<html class="no-js" lang="en-US">

@include('front.layouts.partials.head')

<body>

<!-- app -->
<div id="app">
    @include('front.layouts.partials.header')
    @yield('content')

    @include('front.layouts.partials.footer')
    @include('front.layouts.partials.module')
</div>
<!-- app /- -->
<!--[if lte IE 9]>
<div class="app-issue">
    <div class="vertical-center">
        <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span>This web app is not compatible with following browser. Please upgrade your browser to improve your security and experience.</span>
        </div>
    </div>
</div>
<style> #app {
    display: none;
} </style>
<![endif]-->
<!-- NoScript -->
@include('front.layouts.partials.script')
</body>
</html>
