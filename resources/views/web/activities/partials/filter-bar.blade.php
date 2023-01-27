<div class="filter-bar">
  <div class="filter filter__news">
    @foreach ($subcategories as $subcategory)
      <a
        class="category__news"
        href="{{ url('bureliai/' . $subcategory->slug) }}"
        data-category="{{ $subcategory->id }}"
      >
        {{ $subcategory->name }}
      </a>
    @endforeach
  </div>

  <div class="top-panel"></div>
</div>

