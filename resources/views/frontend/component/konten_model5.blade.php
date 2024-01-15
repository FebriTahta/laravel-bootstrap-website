<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <!-- Start Card Area -->
        <div class="row g-5">
            @foreach ($post as $item)
                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="rbt-card variation-03 rbt-hover">
                        <div class="rbt-card-img">
                            <a class="#" href="#">
                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->post_title}}">
                                <span class="rbt-btn btn-white icon-hover">
                                    <span class="btn-text">Read More</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </a>
                        </div>
                        <div class="rbt-card-body">
                            <h5 class="rbt-card-title"><a href="#">{{substr($item->post_title,0,40)}}
                                @if (strlen($item->post_title) > 40)
                                    ...
                                @endif</a>
                            </h5>
                            <div class="rbt-card-bottom">
                                <a class="transparent-button" href="#"><i><svg width="17" height="12" xmlns="http://www.w3.org/2000/svg"><g stroke="#27374D" fill="none" fill-rule="evenodd"><path d="M10.614 0l5.629 5.629-5.63 5.629"/><path stroke-linecap="square" d="M.663 5.572h14.594"/></g></svg></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->
            @endforeach
            
        </div>
        <!-- End Card Area -->
        @include('frontend.component.pagination',['post'=>$post])
    </div>
</div>