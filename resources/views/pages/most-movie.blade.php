@extends('layouts.index')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8 hidden-xs">
                        <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                            <p><a href="{{ url('/') }}">Trang chủ</a><span class="separator"> » </span><span
                                    class="last">Xem nhiều</span></p>
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
            <section>
                <div class="section-bar clearfix">
                    <h3 class="section-title">
                        <span>Danh sách phim nhiều lượt xem</span>
                    </h3>
                </div>
                <div class="halim_box">
                    @foreach ($listMostMovie as $movie)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-35597">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('phim', [$movie->slug]) }}"
                                    title="{{ $movie->title }}">
                                    <figure><img class="blur-up img-responsive lazyautosizes lazyloaded" data-sizes="auto"
                                            data-src="{{ asset('uploads/movie/' . $movie->image) }}"
                                            alt="{{ $movie->title }}" title="{{ $movie->title }}" sizes="149px"
                                            src="{{ asset('uploads/movie/' . $movie->image) }}">
                                    </figure>
                                    <span class="status">
                                        {{ $movie->language }} - {{ $movie->quality }}
                                    </span><span class="episode">
                                        {{ $movie->episode_current }}
                                    </span>
                                    @php
                                        $description = Str::limit($movie->description, 70, '...');
                                    @endphp
                                    <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                        data-placement="top" data-trigger="hover"
                                        title="<span class=film-title>{{ $movie->title }}</span>"
                                        data-content="<div class=org-title>{{ $movie->origin_name }}</div>                            <div class=film-meta>
                          <div class=text-center>
                              <span class=released><i class=hl-calendar></i> {{ $movie->year }}</span>                                    <span class=runtime><i class=hl-clock></i> {{ $movie->time }}</span>                                </div>
                          <div class=film-content>
{{ $description }}
                          </div>
                          <p class=category>Quốc gia: <span class=category-name>
                            @foreach ($movie->countries as $country)
{{ $country->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                        </span></p>                                <p class=category>Thể loại: <span class=category-name>
                            @foreach ($movie->genres as $genre)
{{ $genre->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                        </span></p>
                      </div>">
                                    </div>

                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <h2 class="entry-title">{{ $movie->title }}</h2>
                                            <p class="original_title">{{ $movie->origin_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    {{ $listMostMovie->links('vendor.pagination.custom') }}
                </div>
            </section>
        </main>
        @include('layouts.inc.sidebar')
    </div>
@endsection
