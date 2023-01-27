<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($bureliai as $burelis)
        <url>
            <loc>https://klaipedaassutavim.lt/bureliai/{{$burelis->category->slug}}/{{$burelis->subcategory->slug}}/{{ $burelis->slug }}</loc>
            <lastmod>{{ $burelis->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset> 