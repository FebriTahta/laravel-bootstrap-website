<div class="rbt-section-overlayping-top rbt-section-gapBottom" style="padding-top: 30px">
    <div class="container" style="min-height: 500px">
        <div class="row">
            <div class="col-lg-12">
                @if (count($post) < 1)
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="conteiner" style="background: white; text-align: center; border-radius: 15px">
                            @include('layouts.null-data',['class'=>'background-white'])
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
                @endif
                <div class="rbt-course-grid-column">
                    @foreach ($post as $item)
                    <div class="course-grid-3">
                        <div class="rbt-card variation-01 rbt-hover">
                            <div class="rbt-card-img">
                                <a href="#">
                                    <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->id}}">
                                </a>
                            </div>
                            <div class="rbt-card-body">
                                @foreach ($item->kategori as $kategori)
                                    <span class="badge badge-sm badge-info">{{$kategori->kategori_name}}</span>
                                @endforeach
                                
                                <h4 class="rbt-card-title">
                                    <a href="">
                                        {{substr($item->post_title, 0, 45)}}
                                        @if (strlen($item->post_title) > 45)
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
                                    <a class="rbt-btn-link" href="">
                                        Baca Selengkapnya
                                        <i class="feather-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if (count($post) > 0)
                    @include('frontend.component.pagination',['post'=>$post])
                @endif
               
            </div>
        </div>
    </div>
</div>