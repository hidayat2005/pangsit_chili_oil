<!DOCTYPE html>
<html lang="id">
<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.styles')
</head>
<body>
    @include('frontend.partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('frontend.partials.footer')
    @include('frontend.includes.scripts')
    @include('frontend.includes.cart-script')
    
    @stack('scripts')
</body>
</html>