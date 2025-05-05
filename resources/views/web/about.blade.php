<div id="about" class="about segments">
    <div class="container">
        <div class="box-content">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="content-left">
                        <div class="section-title section-title-left">
                            <h3>About Me</h3>
                        </div>
                        <div class="content">
                            <h2>{{ $about ? $about->title : 'About Me' }}</h2>
                            <p>
                                {!! $about ? $about->description : '######'!!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="content-right"
                        style="background: url('{{ $about ? asset($about->image_path) : asset('2.jpg') }}');
                        background-size: cover;
                        background-position: 100% 100%;
                        height: 100%;
                        border-radius: 0 3px 3px 0;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
