<header id="header">
    <div class="container">
        <div class="row" id="headwrap">
            <div class="col-md-3 col-sm-6 slogan">
                <h1 class="site-title">
                    <a class="logo" href="{{ url('/') }}" rel="home">Phim HD Thuyết Minh Vietsub</a>
                </h1>
            </div>

            <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                <div class="header-nav">
                    <div class="col-xs-12">
                        <form id="search-form-pc" name="halimForm" role="search" action="{{ route('tim-kiem') }}"
                            method="GET">
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input id="search" type="text" name="s" value=""
                                        class="form-control" data-toggle="tooltip" data-placement="bottom"
                                        data-original-title="Nhấn Enter để tìm kiếm"
                                        placeholder="Tìm tên phim, diễn viên..." autocomplete="off" required />
                                    <i class="animate-spin hl-spin4 hidden"></i>
                                </div>
                            </div>
                        </form>
                        <ul class="ui-autocomplete ajax-results hidden">
                            <span class="ajax-results"></span>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs">
                <div id="get-bookmark" class="box-shadow">
                    <i class="hl-bookmark"></i><span> Phim yêu thích</span><span class="count">0</span>
                </div>
                <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                    <ul style="margin: 0"></ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="navbar-container">
    <div class="container">
        <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                    data-target="#halim" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse"
                    data-target="#user-info" aria-expanded="false">
                    <span class="hl-dot-3 rotate" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right expand-search-form"
                    data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                    <span class="hl-search" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                    <i class="hl-bookmark" aria-hidden="true"></i>
                    <span class="count">0</span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="halim">
                <div class="menu-the-loai-container">
                    <ul id="menu-the-loai" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active">
                            <a title="Trang Chủ" href="/">Trang Chủ</a>
                        </li>
                        <li class="mega current-menu-item dropdown active">
                            <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                @foreach ($listCountries as $country)
                                    <li>
                                        <a title="{{ $country->name }}"
                                            href="{{ route('quoc-gia', [$country->slug]) }}">{{ $country->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="mega current-menu-item dropdown active">
                            <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                @foreach ($listGenres as $genre)
                                    <li>
                                        <a title="{{ $genre->name }}"
                                            href="{{ route('the-loai', [$genre->slug]) }}">{{ $genre->name }}</a>
                                    </li>
                                @endforeach


                            </ul>
                        </li>
                        @foreach ($listCategories as $category)
                            <li>
                                <a title="{{ $category->name }}"
                                    href="{{ route('loai-phim', [$category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li class="mega current-menu-item dropdown active">
                            <a title="Năm phát hành" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Năm phát hành<span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                @for ($i = 2000; $i <= 2023; $i++)
                                    <li>
                                        <a title="{{ $i }}"
                                            href="{{ route('nam', [$i]) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                        </li>
                        <li>
                            <a title="Mới Cập Nhật" href="{{ route('moi-cap-nhat') }}">Mới Cập Nhật</a>
                        </li>
                        <li>
                            <a title="Xem Nhiều" href="{{ route('xem-nhieu') }}">Xem Nhiều</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div class="collapse navbar-collapse" id="search-form">
            <div id="mobile-search-form" class="halim-search-form"></div>
        </div>
        <div class="collapse navbar-collapse" id="user-info">
            <div id="mobile-user-login"></div>
        </div>
    </div>
</div>
