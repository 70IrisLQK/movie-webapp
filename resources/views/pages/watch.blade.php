@extends('layouts.index')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8 hidden-xs">
                        <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                            <p><a href="{{ url('/') }}">Trang chủ</a><span class="separator"> »
                                    <a
                                        href="{{ route('loai-phim', [$listMovieBySlug->category->slug]) }}">{{ $listMovieBySlug->category->name }}</a><span
                                        class="separator"> »
                                        <a
                                            href="{{ route('quoc-gia', [$listMovieBySlug->countries[0]->slug]) }}">{{ $listMovieBySlug->countries[0]->name }}</a><span
                                            class="separator"> »
                                            <a
                                                href="{{ route('the-loai', [$listMovieBySlug->genres[0]->slug]) }}">{{ $listMovieBySlug->genres[0]->name }}</a><span
                                                class="separator"> »
                                            </span><span class="last">{{ $listMovieBySlug->name }}</span>
                            </p>
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
        <!-- end panel-default -->
        @include('layouts.inc.letter-filter')
        <div class="clearfix"></div>
        <div id="halim-player-wrapper" class="ajax-player-loading" data-adult-content="">
            <div id="ajax-player" class="player">
                @if ($firstEpisode->server_id == 2)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $firstEpisode->link }}" allowfullscreen=""
                            title="{{ $firstEpisode->filename }}">
                        </iframe>
                    </div>
                @else
                    <div class="embed-responsive embed-responsive-16by9">
                        <video id="video-id">
                            <source src="{{ $firstEpisode->link }}" type="application/x-mpegURL" />
                        </video>
                    </div>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        @php
            $url = Request::url();
        @endphp
        @php
            if (!empty($rating) && !empty($countTotal)) {
                $totla_users_score = $rating;
                $total = $rating;
            } else {
                $totla_users_score = $total = $count = 0;
            }
        @endphp
        <div class="button-watch fullwidth" style="position: relative; z-index: 8;">
            <ul class="halim-social-plugin col-xs-4 hidden-xs">
                @php
                    $url = Request::url();
                @endphp
                <div class="fb-like" data-href="{{ $url }}" data-width="" data-layout="" data-action=""
                    data-size="" data-share="true"></div>
            </ul>

            <div class="col-xs-12 col-md-8">
                <div class="luotxem halim-prev-episode"><i class="hl-next prev"></i> Tập trước</div>
                <div class="luotxem halim-next-episode">Tập tiếp theo <i class="hl-next"></i></div>
                <div id="autonext" class="btn-cs autonext" style="display: none;">
                    <i class="icon-autonext-sm"></i>
                    <span><i class="hl-next"></i> Tự động chuyển tập: <span id="autonext-status">On</span></span>
                </div>
                <div id="toggle-light"><i class="hl-adjust"></i>
                    Tắt đèn </div>
                <div id="report" class="halim-switch"><i class="hl-attention"></i> Báo lỗi</div>
                <div class="luotxem"><i class="hl-eye"></i>
                    <span>{{ thousandsCurrencyFormat($listMovieBySlug->view) }}</span> lượt xem
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <main id="main-contents"
            class="col-xs-12 col-sm-12 col-md-8 post-template-default single single-post postid-{{ $listMovieBySlug->id }} single-format-aside wp-embed-responsive  halim-corner-rounded">

            <section id="content">
                <div class="clearfix wrap-content">

                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <div style="text-align: center;"><strong>TIP Tìm Phim Nhanh Trên Google, gõ: tên phim +
                                phimchilla</strong>
                            <br><br>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="title-block watch-page">
                        <a href="javascript:;" data-toggle="tooltip" title=""
                            data-original-title="Thêm vào yêu thích">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon"
                                data-post_id="{{ $listMovieBySlug->id }}"
                                data-thumbnail="{{ asset('uploads/movie/' . $listMovieBySlug->image) }}"
                                data-href="{{ route('phim', [$listMovieBySlug->slug]) }}" data-title="Con Mồi"
                                data-date="{{ date('Y-m-d') }}">
                            </div>
                        </a>
                        <div class="title-wrapper full">
                            <h1 class="entry-title"><a href="{{ route('phim', [$listMovieBySlug->slug]) }}"
                                    title="{{ $listMovieBySlug->name }}" class="tl">{{ $listMovieBySlug->name }}</a>
                            </h1>
                            <span class="plot-collapse" data-toggle="collapse" data-target="#expand-post-content"
                                aria-expanded="false" aria-controls="expand-post-content" data-text="Nội dung phim"><i
                                    class="hl-angle-down"></i></span>
                        </div>


                        <div class="ratings_wrapper">
                            <div class="halim_imdbrating taq-score">
                                <span class="score">{{ $totla_users_score }}</span><i>/</i>
                                <span class="max-ratings">5</span>
                                <span class="total_votes">{{ $countTotal }}</span><span class="vote-txt">
                                    lượt</span>
                            </div>
                            <div class="rate-this">
                                <div data-rate="{{ $total }}" data-id="{{ $listMovieBySlug->id }}"
                                    class="user-rate user-rate-active">
                                    <span class="user-rate-image post-large-rate stars-large">
                                        <span style="width: {{ ($total / 5) * 100 }}%"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="entry-content htmlwrap clearfix collapse " id="expand-post-content">
                        <article id="post-{{ $listMovieBySlug->id }}"
                            class="item-content post-{{ $listMovieBySlug->id }}">
                            <p> {!! $listMovieBySlug->description !!}
                            </p>
                        </article>
                    </div>
                    <div class="clearfix"></div>
                    <div class="text-center halim-ajax-list-server">
                        <div id="halim-ajax-list-server">
                            <script>
                                var svlists = [];
                            </script>
                        </div>
                    </div>
                    @foreach ($listServer as $server)
                        @foreach ($listEpisodeServer as $episodeServer)
                            @if ($episodeServer->server_id == $server->id)
                                <div id="halim-list-server" class="list-eps-ajax">
                                    <div class="halim-server show_all_eps" data-episode-nav=""><span
                                            class="halim-server-name"><span class="hl-server"></span>
                                            {{ $server->name }}</span>
                                        <ul id="listsv-{{ $server->id }}" class="halim-list-eps">
                                            <script>
                                                var halim_cfg = {
                                                    "act": "watch",
                                                    "post_url": "{{ route('phim', [$listMovieBySlug->slug]) }}",
                                                    "loading_img": "{{ asset('assets/images/ajax-loader.gif') }}",
                                                    "episode": "{{ $episodeServer->id }}",
                                                    "server_slug": "{{ $episodeServer->server_id }}",
                                                    "type_slug": "tap-{{ $episodeServer->slug }}",
                                                    "post_title": "{{ $listMovieBySlug->name }}",
                                                    "post_id": "{{ $listMovieBySlug->id }}",
                                                    "episode_slug": "{{ $episodeServer->slug }}",
                                                    "server": "{{ $episodeServer->server_id }}",
                                                    "custom_var": "",
                                                    "player_error_detect": "autoload_server",
                                                    "paging_episode": "false",
                                                    "episode_display": "show_list_eps",
                                                    "episode_nav_num": 100,
                                                    "auto_reset_cache": null,
                                                    "resume_playback": true,
                                                    "resume_text": "Tự động play video từ thời điểm bạn xem lần cuối tại",
                                                    "resume_text_2": "Phát lại từ đầu?",
                                                    "playback": "Phát lại",
                                                    "continue_watching": "Tiếp tục xem",
                                                    "player_reload": "Làm mới trình phát",
                                                    "jw_error_msg_0": "Chúng tôi không thể tìm thấy video bạn đang tìm kiếm. Có thể có một số lý do cho việc này, ví dụ như nó đã bị xóa bởi chủ sở hữu!",
                                                    "jw_error_msg_1": "Không thể phát video này",
                                                    "jw_error_msg_2": "Để xem tiếp, vui lòng click vào nút \"Tải lại trình phát\"",
                                                    "jw_error_msg_3": "hoặc click vào các nút được liệt kê bên dưới",
                                                    "light_on": "Bật đèn",
                                                    "light_off": "Tắt đèn",
                                                    "expand": "Mở rộng",
                                                    "collapse": "Collapse",
                                                    "player_loading": "Đang tải player, vui lòng chờ...",
                                                    "player_autonext": "Đang tự động chuyển tập, vui lòng chờ...",
                                                    "is_adult": false,
                                                }
                                            </script>
                                            @foreach ($listEpisodeMovie as $item)
                                                @if ($item->server_id == $server->id)
                                                    @php
                                                        if ($item->slug == $firstEpisode->slug) {
                                                            $position = 'first';
                                                        } elseif ($item->slug == $lastEpisode->slug) {
                                                            $position = 'last';
                                                        } else {
                                                            $position = '';
                                                        }
                                                    @endphp
                                                    <li
                                                        class="{{ $item->slug == $episode && $serverActive == $server->id ? 'active' : '' }} halim-episode halim-episode-{{ $item->server_id }}-{{ $item->slug }}">
                                                        <a href="{{ url('xem-phim/' . $listMovieBySlug->slug . '/tap-' . $item->slug . '/server-' . $item->server_id) }}"
                                                            title="{{ $item->slug }}">
                                                            <span
                                                                class="{{ $item->slug == $episode && $serverActive == $server->id ? 'active' : '' }} halim-info-{{ $item->server_id }}-{{ $item->slug }} box-shadow halim-btn"
                                                                data-post-id="{{ $listMovieBySlug->id }}"
                                                                data-server="{{ $item->server_id }}"
                                                                data-episode-slug="{{ $item->slug }}"
                                                                data-position="{{ $position }}"
                                                                data-embed="{{ $item->server_id }}"
                                                                data-href="{{ url('xem-phim/' . $listMovieBySlug->slug . '/tap-' . $item->slug . '/server-' . $item->server_id) }}">
                                                                {{ $item->name }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <script>
                        var halimrp_cfg = ["Vấn đề nội dung (Sai ​​tiêu đề hoặc tóm tắt, hoặc tập không theo thứ tự)",
                            "Sự cố video (Mờ, bị cắt hoặc trông lạ theo một cách nào đó)",
                            "Vấn đề về âm thanh (Khó nghe, không khớp với video hoặc bị thiếu một số phần)",
                            "Vấn đề về phụ đề hoặc chú thích (Thiếu, khó đọc, không khớp với âm thanh, lỗi chính tả hoặc bản dịch kém)",
                            "Phim hoặc sự cố kết nối (Thường xuyên tải lại phim, phát lại không bắt đầu hoặc sự cố khác)"
                        ]
                    </script>
                    <div id="lightout"></div>
                </div>
            </section>

            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>Cùng Thể Loại</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="halim_box related-film">
                        @foreach ($listMovieRelate as $movieRelate)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-{{ $movieRelate->id }}">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('phim', [$movieRelate->slug]) }}"
                                        title="{{ $movieRelate->name }}">
                                        <figure>
                                            <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                                data-src="{{ asset('uploads/movie/' . $movieRelate->image) }}"
                                                alt="{{ $movieRelate->name }}" title="{{ $movieRelate->name }}" />
                                        </figure>
                                        <span class="status">
                                            {{ $movieRelate->language }}
                                            - {{ $movieRelate->quality }}

                                        </span><span class="episode">
                                            {{ $movieRelate->episode_current }}
                                        </span>
                                        @php
                                            $description = substr($movieRelate->description, 0, 80);
                                            $description = $description . '...';
                                        @endphp

                                        <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                            data-placement="top" data-trigger="hover"
                                            title="<span class=film-title>{{ $movieRelate->name }}</span>"
                                            data-content="<div class=org-title>{{ $movieRelate->origin_name }}</div>                            <div class=film-meta>
                      <div class=text-center>
                          <span class=released><i class=hl-calendar></i> {{ $movieRelate->year }}</span>                                    <span class=runtime><i class=hl-clock></i> {{ $movieRelate->time }}</span>                                </div>
                      <div class=film-content>
                        @if (strlen($movieRelate->description) > 80)
{{ $description }}
@else
{{ $movieRelate->description }}
@endif
                      </div>
                      <p class=category>Quốc gia: <span class=category-name>
                        @foreach ($movieRelate->countries as $country)
{{ $country->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                    </span></p>                                <p class=category>Thể loại: <span class=category-name>
                        @foreach ($movieRelate->genres as $genre)
{{ $genre->name }}{{ $loop->last ? '' : ', ' }}
@endforeach
                    </span></p>
                  </div>">
                                        </div>

                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title">
                                                <h2 class="entry-title">{{ $movieRelate->name }}</h2>
                                                <p class="original_title">{{ $movieRelate->origin_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
            </section>
            <div class="clearfix"></div>
        </main>
        @include('layouts.inc.sidebar')
    </div>

    <script id="halim-init-js-extra">
        var halim = {
            "light_mode": "0",
            "light_mode_btn": "1",
            "ajax_live_search": "1",
            "sync": null,
            "db_redirect_url": "google.vn"
        };
        var ajax_var = {
            "nonce": "61f41ff8ab"
        };
        var halim_rate = {
            "ajaxurl": "http://localhost:8000/rating",
            "movie_id": "{{ $listMovieBySlug->id }}",
            "nonce": "252dd8f7ca",
            "your_rating": "C\u1ea3m \u01a1n b\u1ea1n \u0111\u00e3 \u0111\u00e1nh gi\u00e1!"
        };
    </script>
    <script>
        var myFP = fluidPlayer(
            'video-id', {
                "layoutControls": {
                    "controlBar": {
                        "autoHideTimeout": 3,
                        "animated": true,
                        "autoHide": true,
                        "playbackRates": [
                            "x2",
                            "x1.5",
                            "x1",
                            "x0.5"
                        ]
                    },
                    "htmlOnPauseBlock": {
                        "html": null,
                        "height": null,
                        "width": null
                    },
                    "autoPlay": true,
                    "mute": false,
                    "allowTheatre": true,
                    "playPauseAnimation": true,
                    "playbackRateEnabled": true,
                    "allowDownload": false,
                    "playButtonShowing": true,
                    "fillToContainer": false,
                    "posterImage": "{{ asset('assets/images/' . $listMovieBySlug->image) }}"
                },
                "vastOptions": {
                    "adList": [],
                    "adCTAText": false,
                    "adCTATextPosition": ""
                }
            });
    </script>
@endsection
