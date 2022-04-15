@extends('layouts.front-default')

@push('css')
<style>
.srchdItems li{
    color:red !important;

}
.queryresult{
    position:absolute;
    width:78%;
    top:176px;
    background-color:#fff;
    z-index:999;
    
}
.sItems{
    list-style: none;
    padding: 15px 40px;
    border-bottom: 1px solid gray;
}
.service .iconbox .icon{
    z-index:4 !important;
}

.favprod{
    cursor:pointer;
}
</style>
@endpush

@section('content')
<div id="owl-example" class="owl-carousel">
        @foreach($sliders as $slide)
            <div> 
                <div class="banner" style=" background-image: url({{asset('public/uploads/sliders/bg').'/'.$slide->bg_image}});">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 p-0 d-flex align-items-center justify-content-center">
                                <div class="slidertext w-100">
                                    <h1>{{$slide->name}}</h1>
                                    <p>{{$slide->slide_text}}</p>
                                    <a href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="slideimg">
                                    <img class="w-100" src="{{asset('public/uploads/sliders/front').'/'.$slide->front_image}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
</div>

            <div class="search w-100">
            <div class="container">
                <div class="formsearch w-100 d-flex justify-content-center  align-items-center">
                  <h2 class="text-center">Enter your postcode to start</h2>
                    <form>
                        <input type="text" placeholder="Enter Postcode" id="query" name="search">
                        @csrf
                        <button class="searchZipcode"><img src="{{asset('public/assets/images/search.svg')}}"></button>
                    </form>
                    <div class="queryresult">
                        
                    </div>
                </div>
                <div class="service">
                    <div class="row">
                      <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 col">
                        <div class="iconbox">
                            <div class="icon"><img src="{{asset('public/assets/images/first-aid-kit.svg')}}"></div>
                            <h2 class="text-center">Hygiene and safety is our priority</h2>

                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 col">
                        <div class="iconbox w-100">
                            <div class="icon"><img src="{{asset('public/assets/images/mask.svg')}}"></div>
                            <h2 class="text-center">Social distancing and mask-wearing in place</h2>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 col">
                        <div class="iconbox w-100">
                            <div class="icon"><img src="{{asset('public/assets/images/time.svg')}}"></div>
                            <h2 class="text-center">Fast delivery to your door</h2>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 col">
                          <div class="iconbox w-100">
                            <div class="icon"><img src="{{asset('public/assets/images/healing.svg')}}"></div>
                            <h2 class="text-center">Boxes are sealed with a tamper-evident sticker</h2>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12 col">
                          <div class="iconbox w-100">
                            <div class="icon"><img src="{{asset('public/assets/images/delivery-truck.svg')}}"></div>
                            <h2 class="text-center">Contactless delivery with online payment</h2>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="container">
                <h1 class="text-center">OUR PRODUCTS</h1>
                <div class="row">
                @foreach($products as $product)
                @if(!$product->product_url || $product->product_url=='')
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                        <div class="product-item">
                            <div class="product-img">
                                <img src="{{asset('public/uploads/product-images').'/'.$product->image}}">
                            </div>
                            <div class="product-content">
                                <h2>{{$product->name}}</h2>
                                <p>£ {{$product->price}}</p>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                        <div class="product-item">
                                <div class="product-img">
                                <a href="{{$product->product_url}}">
                                    <img src="{{asset('public/uploads/product-images').'/'.$product->image}}">
                                </a>
                                </div>
                                <div class="product-content">
                                    <h2>{{$product->name}}</h2>
                                    <p>£ {{$product->price}}</p>

                                </div>
                        </div>
                    </div>
                @endif
                @endforeach
                    
                </div>
            </div>
        </div>
        <div class="favourite">
            <div class="container">
                <h1 class="text-center">Favourite DEALS </h1>
                <div class="row">
                @for($i = 0; $i < 3; $i++)
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 d-flex justify-content-center  align-items-center">
                        <div class="deals">
                            <img class="w-100 favprod" src="{{asset('public/uploads/favourite-products').'/'.$favourites[$i]->product_image}}">
                        <!-- <a href="{{$favourites[$i]->product_url}}">
                            <img class="w-100" src="{{asset('public/uploads/favourite-products').'/'.$favourites[$i]->product_image}}">
                        </a> -->
                        </div>
                    </div>
                @endfor
                </div>
            </div>
        </div>
       </div>
        
@endsection

@push('js')
<script>
$(document).ready(()=>{
    $('.searchZipcode').on('click', (e)=>{
        e.preventDefault();
        $('#query').prop('disabled', true);

        doAjax();
    });

    /* $('#query').on('keyup', ()=>{
        var q = $('#query').val();
        $('.queryresult').html('');
        findAjax(q)
    }); */

    $('.favprod, .slidertext a').click(function() {
        $('html, body').animate({
            scrollTop: $(".formsearch").offset().top
        }, 1000);
        $('#query').focus();
    });
});

function doAjax(){
var q = $('#query').val();
    var _token = $("input[type=hidden]").val();

    $.ajax({
        url:        "{{route('ajax.search.req')}}",
        type:       "POST",
        data:       {_token:_token, 'query':q},
        success:    (data)=>{
            if(data!='false'){
                $('#query').prop('disabled', false);
                console.log(data);
                //window.open(data, '_blank') //to be used if need to open in blank;
                window.location = data;
                $('.queryresult').text('');
                $('.queryresult').css('padding', '0px'); 
            }else{
                $('#query').prop('disabled', false);
                $('.queryresult').text('We are not delivering in your area yet, you may be able to collect from your nearest store');
                $('.queryresult').css('padding', '10px');
            }
        }
    });
}
function findAjax(q){
    var _token = $("input[type=hidden]").val();

    $.ajax({
        url:        "{{route('ajax.search.req')}}",
        type:       "POST",
        data:       {_token:_token, 'queryAll':q},
        success:    (data)=>{
            if(data!='false'){
                //$('.queryresult p').text(data);
                var obj = JSON.parse(data);
                var feed = $('.queryresult').append('<ul class="srchdItems"></ul>');
                for(i=0; i<obj.length; i++){
                    $(feed).append('<a href="'+obj[i].url+'" target="_blank"> <li class="sItems">'+obj[i].url+'</li> </a>');
                }
                
            }else{
                
                $('.queryresult').text('No match found!');
            }
        }
    });

}
</script>
@endpush