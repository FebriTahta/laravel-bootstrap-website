<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <!-- Start Card Area -->
        <div class="row g-5">
            <!-- Start Single artikel  -->
            @foreach ($post as $item)
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                    <div class="rbt-card-img">
                        <a href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}">
                            <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="Card image">
                        </a>
                    </div>
                    <div class="rbt-card-body">
                        <ul class="rbt-meta">
                            <li><i class="feather-calendar"></i>{{Carbon\Carbon::parse($item->created_at)->format('l / d F Y')}}</li>
                        </ul>
                        <h4 class="rbt-card-title"><a href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}">{{$item->post_title}}</a></h4>
                        <div class="read-more-btn">
                            <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="{{ route('post.detaildata', ['konten_slug' => $konten->konten_slug, 'post_slug' => $item->post_slug]) }}">
                                <span class="icon-reverse-wrapper">
                        <span class="btn-text">Get Ticket</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End Single artikel  -->
        </div>
        <!-- End Card Area -->
        @include('frontend.component.pagination',['post'=>$post])
    </div>
</div>