<!DOCTYPE html>
<html lang="en">
<head>
   
    @include('layouts/front.head')
</head>
@stack('css')
<body>
    <div class="wrapper">
        <header>
            @include('layouts/front.header')
        </header>
        
        <div class="main-content">
            @yield('content')
        </div>

        @include('layouts/front.footer')
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('public/assets/OwlWorkingSlider/owl.carousel.js')}}"></script>
    <script src="{{asset('public/assets/OwlWorkingSlider/owl.autoplay.js')}}"></script>
    <script>
        jQuery(document).ready(function(){
        
        var owl = $('#owl-example');
        owl.owlCarousel({
            items:1,
            loop:true,
            margin:10,
            autoplay:false,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            nav    : true,
           
        });
    
        });
    </script>
@stack('js')
</body>
</html>