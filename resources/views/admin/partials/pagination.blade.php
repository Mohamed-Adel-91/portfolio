<!-- ################## Pagination Part Start ################## -->
<div>
    @php
        $queryParams = request()->except('page');
        $queryString = $queryParams ? '&' . http_build_query($queryParams) : '';
    @endphp
    <div class="d-flex p-4 justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Previous Page Link -->
                @if ($data->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->previousPageUrl() . $queryString }}" rel="prev">Previous</a>
                    </li>
                @endif

                <!-- Pagination Elements -->
                @foreach ($data->links()->elements as $element)
                    <!-- Make three dots -->
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $data->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url . $queryString }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($data->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->nextPageUrl() . $queryString }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="d-flex justify-content-center">
        <p>
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of
            {{ $data->total() }}
            results
        </p>
    </div>
</div>
<!-- ################## Pagination Part End ################## -->
