<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-2" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Trending</span>
                <ul class="halim-popular-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="6" data-type="day">Ngày</a>
                    </li>
                    <li role="presentation">
                        <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="6" data-type="week">Tuần</a>
                    </li>
                    <li role="presentation">
                        <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="6"
                            data-type="month">Tháng</a>
                    </li>
                    <li role="presentation">
                        <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="6" data-type="all">Tất
                            cả</a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    <span id="halim-ajax-popular-post-trending">
                    </span>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>

    <div id="halim_popular_tv_series-widget-3" class="widget halim_popular_tv_series-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>TOP phim lẻ</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="popular-post">
                    @foreach ($listSingleTopMovies as $singleTopMovie)
                        <div class="item post-11241">
                            <a href="{{ route('phim', [$singleTopMovie->slug]) }}" title="{{ $singleTopMovie->name }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $singleTopMovie->image) }}"
                                        class="lazyload blur-up post-thumb" alt="{{ $singleTopMovie->name }}"
                                        title="{{ $singleTopMovie->name }}" />
                                </div>
                                <h3 class="title">{{ $singleTopMovie->name }}</h3>
                                <p class="original_title">{{ $singleTopMovie->origin_name }}</p>
                            </a>
                            <div class="viewsCount">{{ thousandsCurrencyFormat($singleTopMovie->view) }} lượt xem</div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    <div id="adwidget_htmlwidget-46" class="widget AdWidget_HTMLWidget">
        <div style="text-align: center">
            <div id="zone29517314"></div>
            <script>
                PSTBanners.push('zone29517314');
            </script>
        </div>
    </div>
    <div id="halim_popular_movie-widget-4" class="widget halim_popular_movie-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>TOP phim bộ</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="popular-post">
                    @foreach ($listSeriesTopMovies as $seriesTopMovie)
                        <div class="item post-11241">
                            <a href="{{ route('phim', [$seriesTopMovie->slug]) }}" title="{{ $seriesTopMovie->name }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $seriesTopMovie->image) }}"
                                        class="lazyload blur-up post-thumb" alt="{{ $seriesTopMovie->name }}"
                                        title="{{ $seriesTopMovie->name }}" />
                                </div>
                                <h3 class="title">{{ $seriesTopMovie->name }}</h3>
                                <p class="original_title">{{ $seriesTopMovie->origin_name }}</p>
                            </a>
                            <div class="viewsCount">{{ thousandsCurrencyFormat($seriesTopMovie->view) }} lượt xem</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    <div id="custom_html-5" class="widget_text widget widget_custom_html">
        <div class="textwidget custom-html-widget">
            <a href="{{ route('moi-cap-nhat') }}">Xem Phim Mới</a>
        </div>
    </div>
</aside>
