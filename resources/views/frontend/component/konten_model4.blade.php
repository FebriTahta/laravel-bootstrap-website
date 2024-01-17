<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <!-- Start Card Area -->
        <div class="row row--15">
            <div class="col-lg-12">
                <div class="mesonry-list grid-metro2">
                    <div class="resizer"></div>
                    @foreach ($post as $item)
                    <div class="maso-item cat--2">
                        <div class="rbt-card variation-01 rbt-hover card-list-2">
                            <div class="rbt-card-img">
                                <a href="#">
                                    <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->post_title}}">
                                </a>
                            </div>
                            <div class="rbt-card-body">
                                <div class="rbt-card-top">
                                   
                                    <div class="rbt-bookmark-btn">
                                        <a class="rbt-round-btn" title="Bookmark" href="#"><i
                                                class="feather-bookmark"></i></a>
                                    </div>
                                </div>
                                <h4 class="rbt-card-title"><a href="#">{{$item->post_title}}</a>
                                </h4>
                                <ul class="rbt-meta">
                                    <li><i class="feather-users"></i>{{$item->post_view}} Diunduh</li>
                                </ul>

                                <p class="rbt-card-text">{!! substr(strip_tags($item->post_desc), 0, 100) !!}</p>
                                <div class="rbt-card-bottom">
                                    <a class="rbt-btn-link" href="#">
                                        Unduh <i class="feather-arrow-down"></i>
                                    </a>                            
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- End Card Area -->
            </div>
            @include('frontend.component.pagination',['post'=>$post])
        </div>
    </div>
</div>