<div class="row">
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
</div>