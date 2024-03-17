@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($post as $key => $post)
    <url>
        <loc>{{url('/')}}/post/{{$post->konten_slug}}</loc>
        <lastmod>{{$post->created_at}}</lastmod>
        <changefreq>{{$post->updated_at}}</changefreq>
        <priority>{{$key+1}}</priority>
    </url>
    @endforeach
</urlset>