@include('layouts.backend.header')
@include('layouts.backend.sidebar')
@include('layouts.backend.top-menu')
<main class="nxl-container">
    <div class="nxl-content">

        @yield('content')
        
</main>

@include('layouts.backend.footer')