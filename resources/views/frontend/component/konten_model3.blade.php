<div class="rbt-team-area rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <div class="row g-5">
            @foreach ($post as $item)
                <!-- Start Single Team  -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="rbt-team-modal-thumb nav nav-tabs">
                        <a class="rbt-team-thumbnail" href="javascript:void(0)" 
                        data-post_title = "{{$item->post_title}}"
                        data-post_desc="{{ $item->post_desc }}"
                        data-post_img="{{asset('images_thumbnail/'.$item->post_thumb)}}"
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
                                    <img class="w-100" src="" id="img" alt="Images">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="rbt-team-details">
                                <div class="author-info">
                                    <h4 class="title" id="nama_guru">_nama_guru_</h4>
                                    <p id="informasi_guru">

                                    </p>
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
            var post_desc = button.data('post_desc')
            var post_img = button.data('post_img')
           
            var modal = $(this)
            modal.find('.modal-body #nama_guru').html(post_title);
            modal.find('.modal-body #informasi_guru').html(post_desc);
            modal.find('.modal-body #img').attr('src',post_img);
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