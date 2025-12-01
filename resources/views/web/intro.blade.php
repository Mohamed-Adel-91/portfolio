<div class="home-intro segments">
    <div class="container">
        <div class="intro-content box-content section-card">
            <div class="hero">
                <div class="hero-left">
                    <span class="hero-kicker">I am {{ $intro ? strtoupper($intro->name) : 'My Portfolio' }}</span>
                    <h1 class="hero-title">{{ $intro ? strtoupper($intro->title) : 'My Title' }}</h1>
                    <div class="hero-actions">
                        <a class="btn-gradient" href="#contact">Contact Me</a>
                        <a class="btn-gradient" href="{{ $intro ? asset($intro->cv_pdf_path) : '#' }}" target="_blank" rel="noopener noreferrer">
                            Download CV
                        </a>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="profile-wrapper">
                        <img src="{{ $intro ? asset($intro->image_path) : asset('1.jpg') }}" alt="Profile Image" class="profile-image" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
