<div id="about" class="about segments">
    <div class="container">
        <div class="box-content section-card">
            <div class="row">
                <div class="col-12">
                    <div class="about-layout">
                        <div class="content-right"
                            style="background-image: url('{{ $about ? asset($about->image_path) : asset('2.jpg') }}');">
                        </div>
                        <div class="content-left">
                            <div class="section-title section-title-left">
                                <h3>About Me</h3>
                            </div>
                            <div class="content">
                                <h2 class="section-heading">{{ $about ? $about->title : 'About Me' }}</h2>
                                <div class="about-description-wrapper">
                                    <div class="about-description line-clamp-12" id="aboutDescription">
                                        {!! $about ? $about->description : '######' !!}
                                    </div>
                                    <button class="read-more-btn" type="button" onclick="toggleAboutDescription(this)"
                                        aria-expanded="false">
                                        Read more
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-web-js-scripts')
    <script>
        function toggleAboutDescription(button) {
            var el = document.getElementById('aboutDescription');
            if (!el) {
                return;
            }
            var expanded = el.classList.toggle('is-expanded');
            button.textContent = expanded ? 'Read less' : 'Read more';
            button.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }
    </script>
@endpush
