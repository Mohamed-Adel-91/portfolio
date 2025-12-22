<div id="blog" class="blog segments">
    <div class="container">
        <div class="section-card">
            <div class="section-title">
                <h3>My Projects</h3>
            </div>
            <h2 class="section-heading">Recent Builds</h2>
            <div class="projects-masonry">
                @foreach(($projects ?? collect()) as $project)
                    <div class="projects-masonry-item">
                        <div class="content">
                            <div class="image" style="height: 250px; overflow: hidden;">
                                <img src="{{ asset($project->image_path) }}" alt="{{ $project->name }}">
                            </div>
                            <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                            <div class="blog-title">
                                <h4><a href="{{ $project->url ?: '#' }}" target="_blank">{{ $project->name }}</a></h4>
                                <p>{{ $project->description }}</p>
                                <div class="date">
                                    {{ optional($project->lunched_at)->format('F d, Y') }} <i class="fas fa-circle"></i> <a
                                        href="{{ $project->url ?: '#' }}" target="_blank"><span>Go To
                                            Website</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
    function toggleImageHeight(button) {
        // Get the parent div of the button and find the image div
        const imageDiv = button.previousElementSibling;

        // Get the image element
        const img = imageDiv.querySelector('img');

        // Toggle the height of the image between 100px and its full height
        if (imageDiv.style.height === '250px') {
            imageDiv.style.height = `fit-content`;
        } else {
            imageDiv.style.height = '250px';
        }
    }
</script>
