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

            <div class="row no-gutters filtr-container">
                @forelse ($portfolioItems as $item)
                    @if (!empty($item['image']))
                        <div class="col-md-4 col-sm-12 col-xs-12 filtr-item" data-category="{{ $item['category'] }}">
                            <div class="content-image">
                                <a href="{{ $item['link'] }}" class="portfolio-popup">
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
        </div>
    </div>
</div>
