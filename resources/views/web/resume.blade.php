<div id="resume" class="resume segments">
    <div class="container">
        <div class="box-content section-card">
            <div class="section-title">
                <h3>My Resume</h3>
            </div>
            <h2 class="section-heading text-center">Experience, Education & Skills</h2>
            <div class="owl-carousel owl-theme resume-carousel" data-autoplay-timeout="10000">
                <div id="experience" class="content">
                    <!-- my experience -->
                    @include('web.resume.experience')
                    <!-- end my experience -->
                </div>
                <div id="education" class="content">
                    <!-- my education -->
                    @include('web.resume.education')
                    <!-- end my education -->
                </div>
                <div id="skill" class="content">
                    <!-- my skill -->
                    @include('web.resume.skill')
                    <!-- end my skill -->
                </div>
            </div>
        </div>
    </div>
</div>
