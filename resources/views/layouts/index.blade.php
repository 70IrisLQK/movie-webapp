<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556" />
    <meta http-equiv="Content-Language" content="vi" />
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <html lang="vi">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <meta name="revisit-after" content="1 days" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

    <link rel="next" href="" />

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <link rel="stylesheet" id="bootstrap-css" href="{{ asset('assets/css/bootstrap.min.css?ver=5.9.5') }}"
        media="all" />
    <link rel="stylesheet" id="halimmovies-style-css" href="{{ asset('assets/css/style.css?ver=5.5.4') }}"
        media="all" />
    <link rel="stylesheet" id="halimmovies-custom-css" href="{{ asset('assets/css/halim.custom.css') }}"
        media="all" />
    <link rel="stylesheet" id="global.styles.inline.css" href="{{ asset('assets/css/global.styles.inline.css') }}"
        media="all" />
    <link rel="stylesheet" id="halimmovie-child-style-css" href="{{ asset('assets/css/style.child.css') }}"
        media="all" />

    <script src="{{ asset('assets/js/jquery.min.js') }}" id="jquery-core-js"></script>
    <script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>
    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=5866204863493167&autoLogAppEvents=1"
        nonce="z9Xqf4OC"></script>
</head>
<html lang="vi">

<body class="home blog halimthemes halimmovies" data-masonry="">
    <!-- Header -->
    @include('layouts.inc.header')
    <!-- /header -->
    <div class="container">
        <div class="row fullwith-slider">
        </div>
    </div>
    <div class="container-fluid halim-full-player hidden halim-centered">
        <div id="halim-full-player" class="container col-md-offset-2s col-md-8"></div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <!--./End .container -->
    <div class="container">
        <div class="a--d-wrapper" style="text-align: center; margin: 10px 0 -10px"></div>
    </div>

    <div class="clearfix"></div>
    <!--. .Footer -->
    @include('layouts.inc.footer')
    <script>
        jQuery('body').append('<div id="fb-root"></div>');
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/lazysizes.min.js') }}" id="lazysizes-js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}" id="bootstrap-js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}" id="carousel-js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/core.min.js') }}" id="halim-init-js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/ajax-auth-script.min.js') }}" id="ajax-auth-script-js">
    </script>
    <script src="{{ asset('assets/js/player.min.js') }}" id=" halim-ajax-js"></script>
    <script src="{{ asset('assets/js/jwplayer-8.9.3.js') }}" id="halim-jwplayer-js"></script>
    <script src="{{ asset('assets/js/movie-report.js') }}" id="halim-report-js"></script>

    <script id="halim-report-js-extra">
        var halim_report = {
            "ajaxurl": "https:\/\/phimsml.com\/wp-admin\/admin-ajax.php",
            "report_lng": {
                "title": "Mi\u1ec1n \u0110\u1ea5t H\u1ee9a (Ph\u1ea7n 2)",
                "alert": "T\u00ean v\u00e0 n\u1ed9i dung l\u00e0 b\u1eaft bu\u1ed9c (*)",
                "msg": "Vấn đề lỗi là gì? Xin vui lòng giải thích...",
                "msg_success": "Cảm ơn bạn đã gửi thông báo lỗi. Chúng tôi sẽ khắc phục sự cố trong thời gian ngắn nhất có thể.",
                "loading_img": "{{ asset('assets/images/loading.gif') }}",
                "report_btn": "Gửi sự cố",
                "report_heading_title": "Chuyện gì đang xảy ra?",
                "name_or_email": "T\u00ean ho\u1eb7c email",
                "close": "\u0110\u00f3ng"
            }
        };
    </script>
    <style>
        #overlay_mb {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
        }

        #overlay_mb .overlay_mb_content {
            position: relative;
            height: 100%;
        }

        .overlay_mb_block {
            display: inline-block;
            position: relative;
        }

        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #overlay_mb .overlay_mb_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #overlay_mb img {
            position: relative;
            z-index: 999;
        }

        @media only screen and (max-width: 768px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }
    </style>

    <style>
        #overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
        }

        #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
        }

        .overlay_pc_block {
            display: inline-block;
            position: relative;
        }

        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #overlay_pc img {
            position: relative;
            z-index: 999;
        }

        @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }
    </style>

    <style>
        .float-ck {
            position: fixed;
            bottom: 0px;
            z-index: 9;
        }

        * html .float-ck

        /* IE6 position fixed Bottom */
            {
            position: absolute;
            bottom: auto;
            top: expression(eval (document.documentElement.scrollTop + document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop, 10) ||0)- (parseInt(this.currentStyle.marginBottom, 10) ||0)));
        }

        #hide_float_left a {
            background: #0098d2;
            padding: 5px 15px 5px 15px;
            color: #fff;
            font-weight: 700;
            float: left;
        }

        #hide_float_left_m a {
            background: #0098d2;
            padding: 5px 15px 5px 15px;
            color: #fff;
            font-weight: 700;
        }

        span.bannermobi2 img {
            height: 70px;
            width: 300px;
        }

        #hide_float_right a {
            background: #01aef0;
            padding: 5px 5px 1px 5px;
            color: #fff;
            float: left;
        }
    </style>
</body>

</html>
