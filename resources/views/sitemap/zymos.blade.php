<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($zymos as $zyma)
        <url>
            <loc>https://klaipedaassutavim.lt/zyma/{{ $zyma->slug }}</loc>
            <lastmod>{{ $zyma->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset> 