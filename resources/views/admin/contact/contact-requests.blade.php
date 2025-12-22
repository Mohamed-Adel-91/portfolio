@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">

        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-container">
                            <div class="d-flex p-2 justify-content-end"></div>
                            <div class="table-responsive">
                                <table class="table custom-table m-0 mb-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>E-mail</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Replies</th>
                                            <th>No.Replies</th>
                                            <th>Submitted At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->first_name }}</td>
                                                <td>{{ $item->last_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ Str::limit($item->message, 50) }}</td>
                                                <td>
                                                    @if ($item->reply_status == 1)
                                                        <span class="badge bg-success">Replied</span>
                                                    @else
                                                        <span class="badge bg-danger">No Reply</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->replays->count() == 0)
                                                        <span class="badge bg-danger">{{ $item->replays->count() }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $item->replays->count() }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    <div class="td-actions">
                                                        <a href="#" class="icon bg-primary show-btn text-decoration-none"
                                                            data-toggle="modal" data-target="#contactDetailsModal"
                                                            data-first-name="{{ $item->first_name }}"
                                                            data-last-name="{{ $item->last_name }}"
                                                            data-email="{{ $item->email }}"
                                                            data-subject="{{ $item->subject }}"
                                                            data-message="{{ $item->message }}"
                                                            data-reply-status="{{ $item->reply_status == 1 ? 'Replied' : 'No Reply' }}"
                                                            data-replies-count="{{ $item->replays->count() }}"
                                                            data-submitted-at="{{ date('d-m-Y h:i A', strtotime($item->created_at)) }}"
                                                            title="Show" aria-label="Show">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                        <a href="mailto:{{ $item->email }}"
                                                            class="icon bg-info text-decoration-none" data-toggle="tooltip"
                                                            title="Send Email">
                                                            <i class="icon-email"></i>
                                                        </a>
                                                        <a href="#"
                                                            class="icon bg-success reply-btn text-decoration-none"
                                                            data-toggle="modal" data-target="#replyModal"
                                                            data-id="{{ $item->id }}" data-email="{{ $item->email }}"
                                                            data-subject="{{ $item->subject }}">
                                                            <i class="icon-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @include('admin.partials.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Details Modal -->
    <div class="modal fade" id="contactDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="contactDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactDetailsModalLabel">Contact Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-plaintext" id="detail_name"></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-plaintext" id="detail_email"></p>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <p class="form-control-plaintext" id="detail_subject"></p>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <div class="border rounded p-2 bg-light" id="detail_message"></div>
                    </div>
                    <div class="form-group">
                        <label>Reply Status</label>
                        <p class="form-control-plaintext" id="detail_reply_status"></p>
                    </div>
                    <div class="form-group">
                        <label>Replies Count</label>
                        <p class="form-control-plaintext" id="detail_replies_count"></p>
                    </div>
                    <div class="form-group">
                        <label>Submitted At</label>
                        <p class="form-control-plaintext" id="detail_submitted_at"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Message Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reply to Contact Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="replyForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="contact_id" name="contact_request_id">
                        <input type="hidden" id="reply_status" name="reply_status" value="1">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="contact_email" readonly>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" id="contact_subject" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reply Message</label>
                            <textarea class="form-control" id="reply_message" name="reply_message" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle modal & AJAX request -->
    @push('custom-js-scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('.show-btn').click(function() {
                    const firstName = $(this).data('first-name') || '';
                    const lastName = $(this).data('last-name') || '';
                    const email = $(this).data('email') || '';
                    const subject = $(this).data('subject') || '';
                    const message = $(this).data('message') || '';
                    const replyStatus = $(this).data('reply-status') || '';
                    const repliesCount = $(this).data('replies-count') || 0;
                    const submittedAt = $(this).data('submitted-at') || '';

                    $('#detail_name').text(`${firstName} ${lastName}`.trim());
                    $('#detail_email').text(email);
                    $('#detail_subject').text(subject);
                    $('#detail_message').text(message);
                    $('#detail_reply_status').text(replyStatus);
                    $('#detail_replies_count').text(repliesCount);
                    $('#detail_submitted_at').text(submittedAt);
                });

                $('.reply-btn').click(function() {
                    let contactId = $(this).data('id');
                    let contactEmail = $(this).data('email');
                    let contactSubject = $(this).data('subject');

                    $('#contact_id').val(contactId);
                    $('#contact_email').val(contactEmail);
                    $('#contact_subject').val(contactSubject);
                });

                $('#replyForm').submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('admin.contact.reply') }}",
                        method: "POST",
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Reply Sent!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#ff8c05',
                                customClass: {
                                    confirmButton: 'custom-confirm-button'
                                }
                            }).then(() => {
                                $('#replyModal').modal('hide');
                                location.reload();
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
                                confirmButtonText: 'Try Again',
                                confirmButtonColor: '#ff8c05',
                                customClass: {
                                    confirmButton: 'custom-confirm-button'
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
