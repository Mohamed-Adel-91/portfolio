<div id="portfolio" class="portfolio segments">
    <div class="container">
        <div class="box-content section-card">
            <div class="section-title">
                <h3>My Portfolio</h3>
            </div>
            <h2 class="section-heading text-center">Selected Work</h2>

            <div class="portfolio-filter-menu">
                <ul>
                    @foreach ($portfolioFilters as $filter)
                        <li data-filter="{{ $filter['id'] }}" class="{{ $loop->first ? 'active' : '' }}">
                            <span>{{ $filter['label'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            @php
                $items = collect($portfolioItems ?? [])->filter(fn ($item) => !empty($item['image']))->values();
                $chunks = $items->chunk(9);
            @endphp

            <div class="swiper portfolio-swiper portfolio-grid {{ $items->isEmpty() ? 'd-none' : '' }}">
                <div class="swiper-wrapper">
                    @foreach ($chunks as $chunk)
                        <div class="swiper-slide">
                            <div class="row no-gutters">
                                @foreach ($chunk as $item)
                                    <div class="col-md-4 col-sm-6 col-xs-12 mb-4 filtr-item"
                                        data-category="{{ $item['category'] }}">
                                        <div
                                            class="content-image {{ $item['category'] === 2 ? 'event-portfolio-card' : 'portfolio-card' }} portfolio-card">
                                            <a href="{{ $item['link'] }}" class="portfolio-popup portfolio-card-inner">
                                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                                                <div class="image-overlay"></div>
                                                <div class="portfolio-caption">
                                                    <div class="title">
                                                        <h4>{{ $item['title'] }}</h4>
                                                    </div>
                                                    <div class="subtitle d-flex align-items-center">
                                                        <span>{{ $item['subtitle'] }}</span>
                                                        @if (!empty($item['badge']))
                                                            <span class="badge badge-warning ml-2">{{ $item['badge'] }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="portfolio-empty text-center text-muted {{ $items->isEmpty() ? '' : 'd-none' }}">
                No portfolio items yet.
            </div>
        </div>
    </div>
</div>

@push('custom-web-js-scripts')
    <script>
        window.PORTFOLIO_ITEMS = @json($items->values());
    </script>
    <script src="{{ asset('js/portfolio-swiper.js') }}"></script>
@endpush
