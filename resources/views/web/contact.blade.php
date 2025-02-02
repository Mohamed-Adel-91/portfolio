<div id="contact" class="contact segments">
    <div class="container">
        <div class="box-content">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="content-left">
                        <div class="section-title section-title-left">
                            <h3>Contact Me</h3>
                        </div>
                        <h2>Realize your dream with us</h2>

                        <ul>
                            <li>
                                <a href="https://www.facebook.com/mohamed.adel.101291/"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://m.me/mohamed.adel.101291/"><i class="fab fa-messenger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
                                            <path
                                                d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.64.64 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.64.64 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76m5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z" />
                                        </svg>
                                    </i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MohamedTaha1012">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                            <path
                                                d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                        </svg>
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/mohamed-adel-661131245/"><i
                                        class="fab fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="https://github.com/Mohamed-Adel-91"><i class="fab fa-github"></i></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCkGudCvAEYSVVFW8uFEkeyQ"><i
                                        class="fab fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="https://wa.me/0201067000662">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="tel:0201067000662">
                                    <i class="fab fa-call">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-telephone-outbound-fill"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                    </i>
                                </a>
                            </li>
                        </ul>
                        <h5 style="margin-top: 70px;">Phone no.: 0201067000662</h5>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="content-right">
                        <form action="{{ route('front.contact-us.submit') }}" class="contact-form" id="contact-form"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div id="first-name-field">
                                        <input type="text" placeholder="First Name" class="form-control"
                                            name="first_name" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="last-name-field">
                                        <input type="text" placeholder="Last Name" class="form-control"
                                            name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="email-field">
                                        <input type="email" placeholder="Email Address" class="form-control"
                                            name="email" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="subject-field">
                                        <input type="text" placeholder="Subject" class="form-control" name="subject"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="message-field">
                                        <textarea cols="30" rows="5" class="form-control" name="message" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="button" type="submit" id="submit" name="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom-web-js-scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('front.contact-us.submit') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            text: response.message,
                            confirmButtonColor: '#ff8c05',
                            confirmButtonText: 'OK',
                            background: '#212121',
                            color: '#ffffff',
                            customClass: {
                                popup: 'custom-alert-popup',
                                confirmButton: 'custom-confirm-button',
                            }
                        }).then(() => {
                            $('#contact-form')[0].reset();
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = "An error occurred.";
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = xhr.responseJSON.errors.join("\n");
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                            confirmButtonColor: '#ff8c05',
                            background: '#212121',
                            color: '#ffffff'
                        });
                    }
                });
            });
        });
    </script>
@endpush
