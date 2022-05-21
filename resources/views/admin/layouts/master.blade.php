<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head')
<body>

<div class="main-wrapper">

@include('admin.layouts.partials.header')


@include('admin.layouts.partials.sidebar')

@yield('content')

</div>

@include('admin.layouts.partials.script')
</body>
</html>