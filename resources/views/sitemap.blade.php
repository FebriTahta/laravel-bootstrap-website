@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($post as $key => $post)
    <url>
        <loc>{{url('/')}}/post/{{$post->konten_slug}}</loc>
        <lastmod>{{\Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
    </url>
    @endforeach
</urlset>