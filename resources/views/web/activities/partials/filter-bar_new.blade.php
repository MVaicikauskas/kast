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
        <input type="text" id="subkategorija" hidden>
        <div class="filterLabel">
            <label>Kategorija</label>
            <span class="label-value">Visi</span>
        </div>
        <div class="filterDropdown">
            <a href="#" data-type='subkategorija' data-filter='all'>Visi</a>
            @foreach($subcategories as $cat)
                <a href="#" data-type='subkategorija' data-filter="{{ $cat->id }}">{{ $cat->name }}</a>
            @endforeach
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
    <input type="hidden" id="kategorija" value="{{ $activity_cat_id }}">
</div>