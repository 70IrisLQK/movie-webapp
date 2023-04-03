    <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
        <div class="halim-search-filter">
            <div class="btn-group col-md-12">
                <form id="form-filter" class="form-inline" method="GET" action="{{ route('loc-phim') }}">
                    <div class="col-md-2 col-xs-12 col-sm-6">
                        <div class="filter-box">
                            <div class="filter-box-title">Sắp xếp</div>
                            <select class="form-control" id="sort" name="sort">
                                <option value="">Sắp xếp</option>
                                <option value="date">Ngày đăng</option>
                                <option value="year_release">Năm sản xuất</option>
                                <option value="name_a_z">Tên phim</option>
                                <option value="watch_views">Lượt xem</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12 col-sm-6">
                        <div class="filter-box">
                            <div class="filter-box-title">Định dạng</div>
                            <select class="form-control" id="type" name="formality">
                                <option value="">Định dạng</option>
                                @foreach ($listCategories as $categoryFilter)
                                    <option
                                        {{ isset($_GET['category']) && $_GET['category'] == $categoryFilter->id ? 'selected' : '' }}
                                        value={{ $categoryFilter->id }}>{{ $categoryFilter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-2 col-xs-12 col-sm-6">
                        <div class="filter-box">
                            <div class="filter-box-title">Quốc gia</div>
                            <select class="form-control" name="country">
                                <option value="">Quốc gia</option>
                                @foreach ($listCountries as $countryFilter)
                                    <option
                                        {{ isset($_GET['country']) && $_GET['country'] == $countryFilter->id ? 'selected' : '' }}
                                        value={{ $countryFilter->id }}>{{ $countryFilter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 col-xs-12 col-sm-6">
                        <div class="filter-box">
                            <div class="filter-box-title">Năm</div>
                            <select class="form-control" name="release">
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2022">2023</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <div class="filter-box">
                            <div class="filter-box-title">Thể loại</div>
                            <select class="form-control" id="category" name="category">
                                <option value="">Thể loại</option>
                                @foreach ($listGenres as $genreFilter)
                                    <option
                                        {{ isset($_GET['genre']) && $_GET['genre'] == $genreFilter->id ? 'selected' : '' }}
                                        value={{ $genreFilter->id }}>{{ $genreFilter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12 col-sm-6">
                        <button type="submit" id="btn-movie-filter" class="btn btn-danger">
                            Lọc phim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
