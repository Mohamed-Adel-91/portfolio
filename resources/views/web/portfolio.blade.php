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

            <div class="row no-gutters filtr-container portfolio-grid">
                @forelse ($portfolioItems as $item)
                    @if (!empty($item['image']))
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
                    @endif
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No portfolio items yet.</p>
                    </div>
                @endforelse
            </div>
            @if ($portfolioItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $portfolioItems->hasPages())
                <div class="portfolio-pagination">
                    {{ $portfolioItems->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
