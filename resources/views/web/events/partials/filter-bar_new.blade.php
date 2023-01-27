<button class="catsCollapse">Filtrai</button>
<div class="newFilterBar">
    <div class="filter" id="regionFilter">
        <input type="text" id="regionas" hidden>
        <div class="filterLabel">
            <label>Regionas</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            <a href="#" data-type='regionas' data-filter='all'>Visi</a>
            @foreach($regions as $reg)
                <a href="#" data-type='regionas' data-filter="{{ $reg->id }}">{{ $reg->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="filter" id="categoryFilter">
        <input type="text" id="kategorija" hidden>
        <div class="filterLabel">
            <label>Kategorija</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            <a href="#" data-type='kategorija' data-filter='all'>Visi</a>
            @foreach($categories as $cat)
                <a href="#" data-type='kategorija' data-filter="{{ $cat->id }}">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="filter" id="priceFilter">
        <input type="text" id="kaina" hidden>
        <div class="filterLabel">
            <label>Kaina</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            <a href="#" data-type='kaina' data-filter='all'>Visi</a>
            <a href="#" data-type='kaina' data-filter='free' selected>Nemokami</a>
            <a href="#" data-type='kaina' data-filter='paid'>Mokami</a>
        </div>
    </div>
    <div class="filter" id="dateFilter">
        <input type="text" id="data" value="0" hidden>
        <div class="filterLabel">
            <label>Data</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown calendarFilterDropdown">
            <i class="fa fa-times removeDate" id="removeDate"></i>
            <div class="clndr-container">
                <div id="clndr">
                    <div id="full-clndr" class="clearfix">
                        <script type="text/template" id="full-clndr-template">
                            <div class="clndr-controls">
                                <div class="clndr-btn clndr-previous-button"></div>
                                <div class="clndr-month">
                                    <%= month %>
                                </div>
                                <div class="clndr-year">
                                    <%= year %>
                                </div>
                                <div class="clndr-btn clndr-next-button"></div>
                            </div>
                            <div class="clndr-grid">
                                <div class="days-of-the-week">
                                    <div class="header-days">
                                        <% _.each(daysOfTheWeek, function(day) { %>
                                        <div class="header-day"><%= day %></div>
                                        <% }); %>
                                    </div>
                                    <div class="days">
                                        <% _.each(days, function(day) { %>
                                        <div class="<%= day.classes %>"><%= day.day %></div>
                                        <% }); %>
                                    </div>
                                </div>
                            </div>
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter" id="searchFilter">
        <div class="filterLabel">
            <label for="raktazodis">Paieška</label>
            <div class="inputWrapper">
                <input type="text" id="raktazodis" placeholder="raktažodis">
                <a href="#"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </div>
</div>