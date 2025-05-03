<div class="home-intro segments">
    <div class="container">
        <div class="intro-content box-content">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="intro-caption">
                        <div>
                            <span>I am {{ $intro->name }}</span>
                            <h2>{{ $intro->title }}</h2>
                            <div>
                                <button class="button">
                                    <a href="#contact">Contact Me</a>
                                </button>
                                <button class="button ml-3">
                                    <a href="{{ asset($intro->cv_pdf_path) }}" target="_blank">
                                        Download CV
                                    </a>
                                </button>
                            </div>
                        </div>
                        <div class="intro-image" style="width: 30%">
                            <img src="{{ asset($intro->image_path) }}" alt="Profile Image"
                                style="
                                clip-path:none;
                                border-radius: 50%;
                                " />
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">

                </div>
            </div>
        </div>
    </div>
</div>
