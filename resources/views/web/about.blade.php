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
                                <div class="about-description">
                                    {!! $about ? $about->description : '######' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
