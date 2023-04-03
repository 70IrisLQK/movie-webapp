@extends('layouts.index')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8 hidden-xs">
                        <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                            <p><a href="{{ url('/') }}">Phim HD Thuyết Minh Vietsub</a><span class="separator">
                        </nav>
                    </div>
                    <div class="col-xs-4 text-right">
                        <a href="javascript:;" id="expand-ajax-filter">Lọc phim <i id="ajax-filter-icon"
                                class="hl-angle-down"></i></a>
                    </div>
                    <div id="alphabet-filter" style="float: right; display: inline-block; margin-right: 25px"></div>
                </div>
            </div>
            @include('layouts.inc.filter')
        </div>
        <!-- end panel-default -->
        <div class="clearfix"></div>
        @include('layouts.inc.letter-filter')

        <div class="clearfix"></div>

        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="halim-movies-widget-halim-movies-widget-8" class="halim-movies-widget-halim-movies-widget-8"
                style="position: relative">
                <div class="section-bar clearfix">
                    <div class="section-title">
                        <a href="#" title="Phim Mới">
                            <h3 class="section-title"><span>Phim Mới</span></h3>
                        </a>
                        <ul class="halim-popular-tab" role="tablist">
                            <li role="presentation" class="active">
                                <a onclick="HaLim.GetPostByWidgetType('movies', '4col', 12, 'lastupdate', 'halim-movies-widget-8');"
                                    role="tab" data-toggle="tab">Mới cập nhật</a>
                            </li>
                            <li role="presentation">
                                <a onclick="HaLim.GetPostByWidgetType('movies', '4col', 12, 'mostview', 'halim-movies-widget-8');"
                                    role="tab" data-toggle="tab">Xem nhiều</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div class="halim_box" id="ajax-movies-widget-halim-movies-widget-8-new-movie">

                </div>
            </section>
            <div class="clearfix"></div>
            <div id="halim-carousel-widget-3xx" class="wrap-slider">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>Phim Hoạt Hình</span></h3>
                </div>
                <div id="halim-carousel-widget-3" class="owl-carousel owl-theme">
                    @foreach ($listCartoonMovies as $cartoon)
                        <article class="thumb grid-item post-{{ $cartoon->id }}">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('phim', [$cartoon->slug]) }}"
                                    title="{{ $cartoon->name }}">
                                    <figure>
                                        <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                            data-src="{{ asset('uploads/movie/' . $cartoon->image) }}"
                                            alt="{{ $cartoon->name }}" title="{{ $cartoon->name }}" />
                                    </figure>
                                    <span class="status">
                                        {{ $cartoon->language }} - {{ $cartoon->quality }}
                                    </span><span class="episode">
                                        {{ $cartoon->episode_current }}
                                    </span>
                                    @php
                                        $description = Str::limit($cartoon->description, 75, '...');
                                    @endphp

                                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                        data-placement="top" data-trigger="hover"
                                        title="<span class=film-title>{{ $cartoon->name }}</span>"
                                        data-content="<div class=org-title>{{ $cartoon->origin_name }}</div>                            <div class=film-meta>
                      <div class=text-center>
                          <span class=released><i class=hl-calendar></i> {{ $cartoon->year }}</span>                                    <span class=runtime><i class=hl-clock></i> {{ $cartoon->time }}</span>                                </div>
                      <div class=film-content>
                          {!! $description !!}
                      </div>
                      <p class=category>Quốc gia: <span class=category-name>
                        @foreach ($cartoon->countries as $country)
{{ $country->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                    </span></p>                                <p class=category>Thể loại: <span class=category-name>
                        @foreach ($cartoon->genres as $genre)
{{ $genre->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                    </span></p>
                  </div>">
                                    </div>

                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title">
                                            <h2 class="entry-title">{{ $cartoon->name }}</h2>
                                            <p class="original_title">{{ $cartoon->origin_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <script>
                    jQuery(document).ready(function($) {
                        var owl = $('#halim-carousel-widget-3');
                        owl.owlCarousel({
                            rtl: false,
                            loop: true,
                            margin: 4,
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            nav: false,
                            navText: [
                                '<i class="hl-down-open rotate-left"></i>',
                                '<i class="hl-down-open rotate-right"></i>',
                            ],
                            responsiveClass: true,
                            responsive: {
                                0: {
                                    items: 2
                                },
                                480: {
                                    items: 3
                                },
                                600: {
                                    items: 4
                                },
                                1000: {
                                    items: 6
                                },
                            },
                        });
                    });
                </script>
            </div>

            <div id="halim-vertical-widget-halim-vertical-widget-box-2" class="halim-vertical-widget">
                <section class="col-md-6 col-sm-6 col-xs-12">
                    <div class="section-bar clearfix">
                        <div class="section-title">
                            <span>Phim lẻ</span>
                            <ul class="halim-popular-tab" role="tablist">
                                <li role="presentation" class="active">
                                    <a class="ajax-vertical-widget" role="tab" data-toggle="tab" data-showpost="3"
                                        data-sortby="latest" data-type="movie">Mới cập
                                        nhật</a>
                                </li>
                                <li role="presentation">
                                    <a class="ajax-vertical-widget" role="tab" data-toggle="tab" data-showpost="3"
                                        data-sortby="mostview" data-type="movie">Xem
                                        nhiều</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active halim-ajax-popular-post movie">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="ajax-vertical-widget-movie" class="popular-post">
                            <span id='ajax-vertical-widget-single'>

                            </span>
                        </div>
                    </div>
                </section>
                <section class="col-md-6 col-sm-6 col-xs-12">
                    <div class="section-bar clearfix">
                        <div class="section-title">
                            <span>Phim bộ</span>
                            <ul class="halim-popular-tab" role="tablist">
                                <li role="presentation">
                                    <a class="ajax-vertical-widget" role="tab" data-toggle="tab" data-showpost="3"
                                        data-sortby="latest" data-type="tv_series">Mới
                                        cập nhật</a>
                                </li>
                                <li role="presentation" class="active">
                                    <a class="ajax-vertical-widget" role="tab" data-toggle="tab" data-showpost="3"
                                        data-sortby="mostview" data-type="tv_series">Xem
                                        nhiều</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active halim-ajax-popular-post tv_series">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="ajax-vertical-widget-tv_series" class="popular-post">
                            <span id='ajax-vertical-widget-tv_series'>

                            </span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <section id="halim-category-widget-halim-category-widget-3"
                class="halim-category-widget-halim-category-widget-3" style="position: relative">
                <div class="section-bar clearfix">
                    <div class="section-title">
                        <a href="{{ route('the-loai', ['hanh-dong']) }}" title="Phim Hành Động Mới Nhất">
                            <h3 class="section-title">
                                <span>Phim Hành Động Mới Nhất</span>
                            </h3>
                        </a>
                        <ul class="halim-popular-tab" role="tablist">
                            <li role="presentation">
                                <a class="ajax-category-widget" role="tab" data-toggle="tab" data-showpost="8"
                                    data-layout="4col" data-type="movie" data-category="55"
                                    data-widget-id="halim-category-widget-3">Phim lẻ</a>
                            </li>

                            <li role="presentation" class="active">
                                <a class="ajax-category-widget" role="tab" data-toggle="tab" data-showpost="8"
                                    data-layout="4col" data-type="tv_series" data-category="55"
                                    data-widget-id="halim-category-widget-3">Phim bộ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div class="halim_box" id="ajax-category-widget-halim-category-widget-3">
                    <span id="ajax-category-widget-halim-category-widget-action">

                    </span>
                </div>
            </section>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <section id="halim-category-widget-halim-category-widget-4"
                class="halim-category-widget-halim-category-widget-4" style="position: relative">
                <div class="section-bar clearfix">
                    <div class="section-title">
                        <a href="{{ route('the-loai', ['kinh-di']) }}" title="Phim Kinh Dị Mới Nhất">
                            <h3 class="section-title">
                                <span>Phim Kinh Dị Mới Nhất</span>
                            </h3>
                        </a>
                        <ul class="halim-popular-tab" role="tablist">
                            <li role="presentation" class="active">
                                <a class="ajax-category-widget" role="tab" data-toggle="tab" data-showpost="8"
                                    data-layout="4col" data-type="movie" data-category="7"
                                    data-widget-id="halim-category-widget-4">Phim lẻ</a>
                            </li>

                            <li role="presentation">
                                <a class="ajax-category-widget" role="tab" data-toggle="tab" data-showpost="8"
                                    data-layout="4col" data-type="tv_series" data-category="7"
                                    data-widget-id="halim-category-widget-4">Phim bộ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div class="halim_box" id="ajax-category-widget-halim-category-widget-4">
                    <span id="ajax-category-widget-halim-category-widget-horrible"></span>
                </div>
            </section>
        </main>
        @include('layouts.inc.sidebar')
    </div>
@endsection
