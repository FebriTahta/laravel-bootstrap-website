<style>
    .list-gambar {
        width: 100%; /* Lebar yang diinginkan */
        height: 220px; /* Tinggi yang diinginkan */
        object-fit: cover; /* Proporsi aspek tetap, menutupi seluruh area */
    }
</style>

<div class="rbt-section-overlayping-top rbt-section-gapBottom" style="padding-top: 30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="rbt-course-grid-column">
                    @foreach ($post as $item)
                    <div class="course-grid-3">
                        <div class="rbt-card variation-01 rbt-hover">
                            <div class="rbt-card-img">
                                <a href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}" >
                                    <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->id}}" class="list-gambar">
                                </a>
                            </div>
                            <div class="rbt-card-body">
                                @foreach ($item->kategori as $kategori)
                                    <span class="badge badge-sm badge-info">{{$kategori->kategori_name}}</span>
                                @endforeach
                                
                                <h4 class="rbt-card-title">
                                    <a href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}">
                                        {{substr($item->post_title, 0, 35)}}
                                        @if (strlen($item->post_title) > 35)
                                            ...
                                        @endif
                                    </a>
                                </h4>

                                <ul class="rbt-meta">
                                    <li><i class="feather-users"></i>{{$item->post_view}} Dibaca</li>
                                </ul>

                                <p class="rbt-card-text">
                                    {!! substr(strip_tags($item->post_desc), 0, 60) !!} 
                                    @if (strlen($item->post_desc) > 60)
                                    ...        
                                    @endif
                                </p>
                                
                                <div class="rbt-card-bottom">
                                    <a class="rbt-btn-link" href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}">
                                        Baca Selengkapnya
                                        <i class="feather-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @include('frontend.component.pagination',['post'=>$post])
            </div>
        </div>
    </div>
</div>