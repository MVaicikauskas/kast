<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($naujienos as $naujiena)
        <url>
            <loc>https://klaipedaassutavim.lt/naujienos/{{$naujiena->category->slug}}/{{ $naujiena->slug }}</loc>
            <lastmod>{{ $naujiena->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset> 