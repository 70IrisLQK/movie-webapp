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
        @include('layouts.inc.letter-filter')

        <div class="clearfix"></div>

        <main id="main-contents"
            class="col-xs-12 col-sm-12 col-md-8 post-template-default single single-post postid-{{ $listMovieBySlug->id }} single-format-aside wp-embed-responsive  halim-corner-rounded">
            <section id="content">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper tpl-2">
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-4">
                                <img class="movie-thumb" src="{{ asset('uploads/movie/' . $listMovieBySlug->image) }}"
                                    alt="{{ $listMovieBySlug->title }}">

                                <div id="bookmark" data-toggle="tooltip" data-placement="right"
                                    data-original-title="Thêm vào yêu thích"
                                    class="halim_bookmark bookmark-img-animation primary_ribbon"
                                    data-post_id="{{ $listMovieBySlug->id }}"
                                    data-thumbnail="{{ asset('uploads/movie/' . $listMovieBySlug->image) }}"
                                    data-href="{{ route('phim', [$listMovieBySlug->slug]) }}"
                                    data-title="{{ $listMovieBySlug->title }}" data-date="{{ date('Y-m-d') }}">
                                    <div class="xhalim-pulse-ring"></div>
                                </div>

                                <div class="halim-watch-box">
                                    <a href="{{ url('xem-phim/' . $listMovieBySlug->slug . '/tap-' . $firstEpisode->slug . '/server-' . 1) }}"
                                        class="btn btn-sm btn-danger watch-movie visible-xs-blockx"><i class="hl-play"></i>
                                        Xem
                                        phim</a>
                                    <span class="btn btn-sm btn-success quick-eps" data-toggle="collapse"
                                        href="#collapseEps" aria-expanded="false" aria-controls="collapseEps"><i
                                            class="hl-sort-down"></i> Tập
                                        phim</span>
                                </div>

                            </div>
                            <div class="film-poster col-md-8">
                                <div class="movie-detail">
                                    <h1 class="entry-title">{{ $listMovieBySlug->title }}</h1>
                                    <p class="org_title">{{ $listMovieBySlug->origin_name }}</p>
                                    <p class="released">
                                        <span class="released"><i class="hl-calendar"></i> <a
                                                href="{{ route('nam', [$listMovieBySlug->year]) }}"
                                                rel="tag">{{ $listMovieBySlug->year }}</a></span> <i
                                            class="hl-clock"></i>
                                        @if (!empty($listMovieBySlug->time))
                                            {{ $listMovieBySlug->time }}
                                        @else
                                            NA
                                        @endif
                                    </p>

                                    @if ($listMovieBySlug->category_id != config('constants.category_ids.single'))
                                        <p class="episode">
                                            <span>Đang phát: </span>
                                            <span>{{ $listMovieBySlug->episode_current }}</span>
                                        </p>
                                    @endif
                                    <p class="lastEp">
                                        <span>Tập mới nhất:
                                        </span>

                                        @foreach ($listEpisode as $episode)
                                            @if ($episode->server_id == 1)
                                                <a href="{{ url('xem-phim/' . $episode->movie->slug . '/tap-' . $episode->slug . '/server-' . $episode->server_id) }}"
                                                    rel="tag">
                                                    <span class="last-eps box-shadow">{{ $episode->name }}
                                                    </span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </p>

                                    <p class="category">Quốc gia:
                                        @foreach ($listMovieBySlug->countries as $country)
                                            <a href="{{ route('quoc-gia', [$country->slug]) }}"
                                                title="{{ $country->name }}">{{ $country->name }}{{ $loop->last ? '' : ', ' }}
                                            </a>
                                        @endforeach
                                    </p>
                                    <p class="category">Đạo diễn:
                                        @if ($listMovieBySlug->directors->count() > 0)
                                            @foreach ($listMovieBySlug->directors as $director)
                                                <a href="{{ route('dao-dien', [$director->slug]) }}"
                                                    title="{{ $director->name }}">
                                                    {{ $director->name }}{{ $loop->last ? '' : ', ' }}
                                                </a>
                                            @endforeach
                                        @else
                                            Đang cập nhật
                                        @endif
                                    <p class="category">Diễn viên:
                                        @if ($listMovieBySlug->actors->count() > 0)
                                            @foreach ($listMovieBySlug->actors as $actor)
                                                <a href="{{ route('dien-vien', [$actor->slug]) }}"
                                                    title="{{ $actor->name }}" rel="category tag">
                                                    {{ $actor->name }}{{ $loop->last ? '' : ', ' }}
                                                </a>
                                            @endforeach
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </p>

                                    <p class="category">Thể loại:
                                        @foreach ($listMovieBySlug->genres as $item)
                                            <a href="{{ route('the-loai', [$item->slug]) }}" rel="category tag"
                                                title="{{ $item->name }}">
                                                {{ $item->name }}{{ $loop->last ? '' : ', ' }}
                                            </a>
                                        @endforeach
                                    </p>

                                    @php
                                        if (!empty($rating) && !empty($countTotal)) {
                                            $totla_users_score = $rating;
                                            $total = $rating;
                                        } else {
                                            $totla_users_score = $total = $count = 0;
                                        }
                                    @endphp

                                    <div class="ratings_wrapper single-info">
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
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>

                    <div class="collapse in" id="collapseEps">
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
                                                @foreach ($listEpisodeMovie as $item)
                                                    <script>
                                                        var halim_cfg = {
                                                            "act": "watch",
                                                            "post_url": "{{ route('phim', [$listMovieBySlug->slug]) }}",
                                                            "loading_img": "{{ asset('assets/images/ajax-loader.gif') }}",
                                                            "episode": "{{ $item->id }}",
                                                            "server_slug": "{{ $item->server_name }}",
                                                            "type_slug": "tap-{{ $item->slug }}",
                                                            "post_title": "{{ $listMovieBySlug->title }}",
                                                            "post_id": "{{ $listMovieBySlug->id }}",
                                                            "episode_slug": "{{ $item->slug }}",
                                                            "server": "{{ $item->server_name }}",
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

                                                    @if ($item->server_id == $server->id)
                                                        <li
                                                            class="{{ $item->slug == $episode ? 'active' : '' }} halim-episode halim-episode-{{ $item->server_id }}-{{ $item->slug }}">
                                                            <a href="{{ url('xem-phim/' . $listMovieBySlug->slug . '/tap-' . $item->slug . '/server-' . $item->server_id) }}"
                                                                title="{{ $item->name }}">
                                                                <span
                                                                    class="halim-info-{{ $item->server_id }}-{{ $item->slug }} box-shadow halim-btn"
                                                                    data-post-id="{{ $listMovieBySlug->id }}"
                                                                    data-server="{{ $item->server_id }}"
                                                                    data-episode-slug="{{ $item->slug }}"
                                                                    data-embed="{{ $item->server_id }}">
                                                                    {{ $item->name }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="pagination-1"></div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                    <div class="clearfix"></div>


                    <div class="entry-content htmlwrap clearfix">
                        <div class="section-title"><span>Nội dung phim</span></div>
                        <div class="video-item halim-entry-box">
                            <article id="post-{{ $listMovieBySlug->id }}" class="item-content toggled">
                                <p>{!! $listMovieBySlug->description !!}</p>
                            </article>
                            <div class="item-content-toggle">
                                <div class="item-content-gradient"></div>
                                <span class="show-more" data-single="true" data-showmore="Mở rộng..."
                                    data-showless="Thu gọn...">Thu gọn...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="related-movies">

                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>Cùng Thể Loại</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="halim_box related-film">
                        @foreach ($listMovieRelate as $movieRelate)
                            @php
                                $description = Str::limit($movieRelate->description, 80, '...');
                                $time = $movieRelate->time ?? 'NA';
                            @endphp
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-{{ $movieRelate->id }}">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('phim', [$movieRelate->slug]) }}"
                                        title="{{ $movieRelate->title }}">
                                        <figure>
                                            <img class="lazyload blur-up img-responsive" data-sizes="auto"
                                                data-src="{{ asset('uploads/movie/' . $movieRelate->image) }}"
                                                alt="{{ $movieRelate->title }}" title="{{ $movieRelate->title }}" />
                                        </figure>
                                        <span class="status">
                                            {{ $movieRelate->language }}
                                            - {{ $movieRelate->quality }}
                                        </span>
                                        <span class="episode">
                                            {{ $movieRelate->episode_current }}
                                        </span>

                                        <div class="icon_overlay" data-html="true" data-toggle="halim-popover"
                                            data-placement="top" data-trigger="hover"
                                            title="<span class=film-title>{{ $movieRelate->title }}</span>"
                                            data-content="<div class=org-title>{{ $movieRelate->origin_name }}</div>                            <div class=film-meta>
                          <div class=text-center>
                              <span class=released><i class=hl-calendar></i> {{ $movieRelate->year }}</span>                                    <span class=runtime><i class=hl-clock></i> {{ $time }}</span>                                </div>
                          <div class=film-content>
{{ $description }}
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
                                                <h2 class="entry-title">{{ $movieRelate->title }}</h2>
                                                <p class="original_title">{{ $movieRelate->origin_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                </div>
                <div class="clearfix"></div>
            </section>

            <div class="the_tag_list">
                @if (isset($listMovieBySlug->tags))
                    @php
                        $tags = [];
                        $tags = explode(',', $listMovieBySlug->tags);
                    @endphp

                    @foreach ($tags as $tag)
                        <a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a>
                    @endforeach
                @else
                    <a href="{{ url('tag/' . $listMovieBySlug->title) }}" rel="tag"
                        title="{{ $listMovieBySlug->title }}">
                        {{ $listMovieBySlug->title }}
                    </a>
                @endif
            </div>
        </main>
        @include('layouts.inc.sidebar')
    </div>
    <script type="text/javascript">
        var halim_cfg = {
            "act": "",
            "post_url": "{{ route('phim', [$listMovieBySlug->slug]) }}",
            "loading_img": "{{ asset('assets/images/ajax-loader.gif') }}",
            "eps_slug": "{{ $firstEpisode->slug }}",
            "server_slug": "{{ $firstEpisode->server_name }}",
            "type_slug": "tap-{{ $firstEpisode->slug }}",
            "post_title": "{{ $listMovieBySlug->title }}",
            "post_id": "{{ $listMovieBySlug->id }}",
            "episode_slug": "{{ $firstEpisode->slug }}",
            "server": "{{ $firstEpisode->server_name }}",
            "light_on": "Bật đèn",
            "light_off": "Tắt đèn",
            "expand": "Mở rộng",
            "collapse": "Collapse",
        }
    </script>
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
@endsection
