<button class="catsCollapse">Filtrai</button>
<div class="newFilterBar">
    <div class="filter" id="regionFilter">
        <input type="text" id="regionas" hidden>
        <div class="filterLabel">
            <label>Regionas</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            @if(count($regions) > 0)
                <a href="#" data-type='regionas' data-filter='all'>Visi</a>
                @foreach($regions as $reg)
                    <a href="#" data-type='regionas' data-filter="{{ $reg->id }}">{{ $reg->name }}</a>
                @endforeach
            @endif
        </div>
    </div>
    <div class="filter" id="categoryFilter">
        <input type="text" id="kategorija" hidden>
        <div class="filterLabel">
            <label>Kategorija</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            @if(count($categories) > 0)
                <a href="#" data-type='kategorija' data-filter='all'>Visi</a>
                @foreach($categories as $cat)
                    <a href="#" data-type='kategorija' data-filter="{{ $cat->id }}">{{ $cat->name }}</a>
                @endforeach
            @endif
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
            <a href="#" data-type='kaina' data-filter='free'>Nemokami</a>
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
                <a href="#"><i class="fas fa-search"></i></a>
            </div>
        </div>
    </div>
</div>
@section('styles')
    <style>
        .newFilterBar {
            padding: 0 15px 5px;
            font-size: 14px;
            max-height: 0;
            transition: max-height 0.2s ease-out;
            background-color: #45ada8;
            display: none;
        }
        .newFilterBar .filter {
            position: relative;
            cursor: pointer;
        }
        .filter .filterLabel {
            text-transform: uppercase;
            color: #fff;
            line-height: 30px;
        }
        .filter .filterLabel label {
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 13px;
            -webkit-transition: .25s ease-in-out;
            transition: .25s ease-in-out;
        }
        .filter .filterLabel .label-value {
            -webkit-transition: .25s ease-in-out;
            transition: .25s ease-in-out;
            color: #9de0ad;
            font-size: 12px;
        }
        .filter .filterLabel .inputWrapper {
            display: inline;
        }
        .filter .filterLabel input {
            border: 0;
            border-bottom: 1px solid #0b3134;
            background: transparent;
            color: #0b3134;
        }
        .newFilterBar .filterDropdown {
            display: none;
            min-width: 150px;
            min-height: 50px;
            width: 100%;
            padding: 0;
            position: absolute;
            background-color: white;
            max-height: 300px;
            overflow-y: auto;
            left: 0;
            right: 0;
            z-index: 500;
            -webkit-transition: 0.45s cubic-bezier(0.25, 0.6, 0.75, 0.55);
            transition: 0.45s cubic-bezier(0.25, 0.6, 0.75, 0.55);
            -webkit-box-shadow: 0 0 0 0 transparent;
            box-shadow: 0 0 0 0 transparent;
            -webkit-box-shadow: 2px 2px 15px 0 rgb(11 49 52 / 50%);
            box-shadow: 2px 2px 15px 0 rgb(11 49 52 / 50%);
        }
        .newFilterBar .filterDropdown a {
            padding: 10px 15px;
            display: block;
            font-size: 0.875rem;
            text-decoration: none;
            text-align: left;
            color: #0b3134;
        }
        .newFilterBar .filterDropdown.calendarFilterDropdown {
            min-width: 250px;
            min-height: 300px;
        }
        .newFilterBar .calendarFilterDropdown .clndr-grid {
            padding: 40px 15px 10px 15px!important;
            position: inherit;
        }
        .newFilterBar .calendarFilterDropdown .removeDate {
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 500;
        }
        @media (min-width: 768px) {
            .newFilterBar {
                max-height: initial;
                display: -webkit-box!important;
                display: -ms-flexbox!important;
                display: flex!important;
                -webkit-box-direction: normal;
                -webkit-box-orient: horizontal;
                -moz-box-direction: normal;
                -moz-box-orient: horizontal;
                flex-direction: row;
                -webkit-flex-wrap: wrap;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                -webkit-justify-content: center;
                justify-content: center;
            }
            .filter .filterLabel {
                padding: 10px 15px 5px;
                margin-right: 2em;
                line-height: 14px;
                min-height: 45px;
            }
            .filter .filterLabel:last-child {
                margin-right: 0;
            }
            .filter .filterLabel.active label {
                font-size: 10px;
            }
            .filter .filterLabel.active .label-value{
                font-size: 14px;
                font-weight: bold;
            }
            .filter .filterLabel .label-value,
            .filter .filterLabel .inputWrapper {
                display: block;
            }
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        var events = {!! $unlimited_events !!};
        var coll = document.getElementsByClassName("catsCollapse");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                    content.style.maxHeight = (content.scrollHeight + 10) + "px";
                }
            });
        }

        (function($){
            //close dropdown
            $(document).mouseup(function(e){
                var container = $(".filterDropdown");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.fadeOut(100);
                }
            });

            //open dropdown
            $('.filterLabel').click(function () {
                $(this).next('.filterDropdown').toggle();
            });

            //filter by select
            $('.filter a').click(function (e) {
                e.preventDefault()

                const filterText = $(this).text()
                const filterSlug = $(this).data('filter')
                const filterType = $(this).data('type')

                const filterElem = $(this).closest('.filter')
                const labelValue = filterElem.find('.label-value')

                filterElem.find('label').addClass('active')
                labelValue.text(filterText)

                // set selected type value
                $("#" + filterType + "").val(filterSlug)

                triggerAjaxRequest()
            });

            //filter by date
            $('#dateFilter').click(function (e) {
                e.preventDefault()
                const labelValue = $(this).find('.label-value');

                $('#clndr').clndr({
                    template: $('#full-clndr-template').html(),
                    weekOffset: 1,
                    daysOfTheWeek: ['S', 'P', 'A', 'T', 'K', 'P', 'Š'],
                    numberOfRows: 5,
                    events: events,
                    trackSelectedDate: true,
                    clickEvents: {
                        click: function (target) {
                            const date = target.date.format('YYYY-MM-DD')
                            $('#data').val(date)
                            labelValue.text(date)
                            triggerAjaxRequest();
                        }
                    }
                });
            })
            //remove date filter
            $('#removeDate').click(function (e) {
                e.preventDefault()

                if($('#data').val() == 0) {
                    $('.filterDropdown').hide();
                }else {
                    $('#data').val(0);
                    $('#dateFilter .label-value').text('Visi');

                    triggerAjaxRequest();
                }
            })

            function triggerAjaxRequest() {
                const search_url = '{{ route('filteredEvents') }}';
                $.ajax({
                    url: search_url,
                    type: 'GET',
                    data: {
                        filter: {
                            region: $('#regionas').val(),
                            category: $('#kategorija').val(),
                            price: $('#kaina').val(),
                            date: $('#data').val(),
                            name: $('#raktazodis').val()
                        }
                    },
                    success: function (data) {
                        $('.events-list').hide().html(data).fadeIn();
                    }
                }).done(function (){
                    $('.filterDropdown').hide();
                })
            }
        })(jQuery);
    </script>
@endsection