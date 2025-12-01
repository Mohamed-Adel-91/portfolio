<div id="blog" class="blog segments">
    <div class="container">
        <div class="section-card">
            <div class="section-title">
                <h3>My Projects</h3>
            </div>
            <h2 class="section-heading">Recent Builds</h2>
            <div class="row">
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="content">
                        <div class="image" style="height: 250px; overflow: hidden;">
                            <img src="images/pages/Netflex-clone.png" alt="">
                        </div>
                        <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                        <div class="blog-title">
                            <h4><a href="#">Netflex Clone</a></h4>
                            <p>Single Landing Page HTML & CSS Native </p>
                            <div class="date">
                                August 23, 2019 <i class="fas fa-circle"></i> <a
                                    href="https://mohamed-adel-91.github.io/Netflex_clone/"><span>Go To
                                        Website</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="content no-mb">
                        <div class="image" style="height: 250px; overflow: hidden;">
                            <img src="images/pages/gamehub.png" alt="">
                        </div>
                        <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                        <div class="blog-title">
                            <h4><a href="https://game-hub-hazel-two.vercel.app/">Game Hub</a></h4>
                            <p>Game Hub is website created by React.js with typescript </p>
                            <div class="date">
                                December 18, 2023 <i class="fas fa-circle"></i> <a
                                    href="https://game-hub-hazel-two.vercel.app/"><span>Go To
                                        Website</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="content">
                        <div class="image" style="height: 250px; overflow: hidden;">
                            <img src="images/pages/cs-temblate-one.png" alt="">
                        </div>
                        <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                        <div class="blog-title">
                            <h4><a href="#">CompuService</a></h4>
                            <p>Single Landing Page HTML & CSS Native </p>
                            <div class="date">
                                August 23, 2019 <i class="fas fa-circle"></i> <a href="#"><span>Go To
                                        Website</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="content">
                        <div class="image" style="height: 250px; overflow: hidden;">
                            <img src="images/pages/gamerspress.png" alt="">
                        </div>
                        <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                        <div class="blog-title">
                            <h4><a href="#">Gamers Press</a></h4>
                            <p>Single Landing Page HTML & CSS Native </p>
                            <div class="date">
                                August 23, 2019 <i class="fas fa-circle"></i> <a
                                    href="https://mohamed-adel-91.github.io/GamersPress/"><span>Go To
                                        Website</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="content">
                        <div class="image" style="height: 250px; overflow: hidden;">
                            <img src="images/pages/Kudzoka.png" alt="">
                        </div>
                        <button class="btn-gradient" type="button" onclick="toggleImageHeight(this)">Show Full Image</button>
                        <div class="blog-title">
                            <h4><a href="#">Kudzoka</a></h4>
                            <p>Single Landing Page HTML & CSS Native </p>
                            <div class="date">
                                August 23, 2019 <i class="fas fa-circle"></i> <a
                                    href="https://mohamed-adel-91.github.io/Kudzoka/"><span>Go To
                                        Website</span></a>
                            </div>
                        </div>
                    </div>
                </div>

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
