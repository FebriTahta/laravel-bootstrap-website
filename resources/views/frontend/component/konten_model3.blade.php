<div class="rbt-team-area rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <div class="row g-5">
            @foreach ($post as $item)
                <!-- Start Single Team  -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="rbt-team-modal-thumb nav nav-tabs">
                        <a class="rbt-team-thumbnail" href="javascript:void(0)" 
                        data-post_title = "{{$item->post_title}}"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="thumb">
                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->post_thumb}}">
                            </div>
                        </a>
                    </div>
                </div>
                <!-- End Single Team  -->
            @endforeach
        </div>
        @include('frontend.component.pagination',['post'=>$post])

        
    </div>
</div>

<div class="rbt-team-modal modal fade rbt-modal-default" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="feather-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="inner">
                    <div class="row g-5 row--30 align-items-center">
                        <div class="col-lg-4">
                            <div class="rbt-team-thumbnail">
                                <div class="thumb">
                                    {{-- <img class="w-100" src="assets_fe/images/team/team-09.jpg" alt="Testimonial Images"> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="rbt-team-details">
                                <div class="author-info">
                                    <h4 class="title">Mames Mary</h4>
                                    <span class="designation theme-gradient">English Teacher</span>
                                    <span class="team-form">
                            <i class="feather-map-pin"></i>
                            <span class="location">CO Miego, AD,USA</span>
                                    </span>
                                </div>
                                <p class="mb--15">You can run Histudy easily. Any School, University, College can be use this histudy education template for their educational purpose. A university can be success you.</p>

                                <p>Run their online leaning management system by histudy education template any where and time.</p>
                                <ul class="social-icon social-default mt--20 justify-content-start">
                                    <li><a href="https://www.facebook.com/">
                                            <i class="feather-facebook"></i>
                                        </a>
                                    </li>
                                    <li><a href="https://www.twitter.com/">
                                            <i class="feather-twitter"></i>
                                        </a>
                                    </li>
                                    <li><a href="https://www.instagram.com/">
                                            <i class="feather-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkdin.com/">
                                            <i class="feather-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="rbt-information-list mt--25">
                                    <li>
                                        <a href="#"><i class="feather-phone"></i>+1-202-555-0174</a>
                                    </li>
                                    <li>
                                        <a href="mailto:hello@example.com"><i
                                    class="feather-mail"></i>example@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="top-circle-shape"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
         
         $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var post_title = button.data('post_title')
           
            var modal = $(this)
            // modal.find('.modal-body #id').val(id);
            // modal.find('.modal-body #mapel_name').val(mapel_name);
            // var preview = document.getElementById("inputGroupFile01-preview2");
            // if (image !== null && image !== "") {
            //     preview.src = 'mapl_image/' + image;
            //     preview.style.display = "block";
            //     $('#label_img2').html(image);
            // } else {}
            console.log(post_title);

        })
    </script>
@endsection