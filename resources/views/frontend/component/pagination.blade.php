{{-- <div class="row">
    <div class="col-lg-12 mt--60">
        <nav>
            <ul class="rbt-pagination">
                @if ($post->onFirstPage())
                    <li class="disabled"><span aria-hidden="true">&laquo;</span></li>
                @else
                    <li><a href="{{ $post->previousPageUrl() }}" aria-label="Previous"><i class="feather-chevron-left"></i></a></li>
                @endif

                @foreach ($post->getUrlRange(1, $post->lastPage()) as $page => $url)
                    <li class="{{ $page == $post->currentPage() ? 'active' : '' }}">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($post->hasMorePages())
                    <li><a href="{{ $post->nextPageUrl() }}" aria-label="Next"><i class="feather-chevron-right"></i></a></li>
                @else
                    <li class="disabled"><span aria-hidden="true">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-12 mt--60">
        <nav>
            <ul class="rbt-pagination">
                @if ($post->onFirstPage())
                    <li class="disabled"><span aria-hidden="true">&laquo;</span></li>
                @else
                    <li><a href="{{ $post->previousPageUrl() }}" aria-label="Previous"><i class="feather-chevron-left"></i></a></li>
                @endif

                @php
                    $start = max(1, $post->currentPage() - 3);
                    $end = min($start + 6, $post->lastPage());
                @endphp

                @if($start > 1)
                    <li><a href="{{ $post->url(1) }}">1</a></li>
                    @if($start > 2)
                        <li class="disabled"><span>...</span></li>
                    @endif
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    <li class="{{ $i == $post->currentPage() ? 'active' : '' }}">
                        <a href="{{ $post->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if($end < $post->lastPage())
                    @if($end < $post->lastPage() - 1)
                        <li class="disabled"><span>...</span></li>
                    @endif
                    <li><a href="{{ $post->url($post->lastPage()) }}">{{ $post->lastPage() }}</a></li>
                @endif

                @if ($post->hasMorePages())
                    <li><a href="{{ $post->nextPageUrl() }}" aria-label="Next"><i class="feather-chevron-right"></i></a></li>
                @else
                    <li class="disabled"><span aria-hidden="true">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
