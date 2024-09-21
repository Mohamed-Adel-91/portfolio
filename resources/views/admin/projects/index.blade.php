@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">

        <!-- Side bar area -->
        @include('admin.layouts.sidebar')
        <!-- Side bar area end -->

        <!-- Page content area start -->
        <div class="page-content">

            <!-- Page Header Section start -->
            @include('admin.layouts.page-header')
            <!-- Page Header Section end -->

            <!-- Main container start -->
            <div class="main-container">
                @include('admin.layouts.alerts')

                <!-- Row start -->
                <div class="row gutters">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="table-container">
                            <div class="d-flex p-3 justify-content-center">
                                <a class="btn btn-primary btn-lg" href="{{ route('admin.sliders.create') }}" role="button">
                                    <i class="icon-plus-circle mr-1"></i>Add New
                                </a>
                            </div>

                            <div class="accordion accordion-flush" id="accordionFlushExampleOne">
                                @foreach ($groupedSliders as $pageName => $sections)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapsePage-{{ \Str::slug($pageName) }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapsePage-{{ \Str::slug($pageName) }}">
                                                Page Name: &nbsp;<span>{{ $pageName }}</span>
                                            </button>
                                        </h2>
                                        <div id="flush-collapsePage-{{ \Str::slug($pageName) }}"
                                            class="accordion-collapse collapse" data-bs-parent="#accordionFlushExampleOne">
                                            <div class="accordion-body">
                                                <div class="accordion accordion-flush" id="accordionFlushExampleTwo">
                                                    @foreach ($sections as $sectionName => $sliders)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseSection-{{ \Str::slug($pageName) }}-{{ \Str::slug($sectionName) }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseSection-{{ \Str::slug($pageName) }}-{{ \Str::slug($sectionName) }}">
                                                                    Section Name: &nbsp;<span>{{ $sectionName }}</span>
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseSection-{{ \Str::slug($pageName) }}-{{ \Str::slug($sectionName) }}"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExampleTwo">
                                                                <div class="accordion-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table custom-table m-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="5%">ID</th>
                                                                                    <th width="10%">Slider No.</th>
                                                                                    <th width="20%">Image</th>
                                                                                    <th width="30%">Title</th>
                                                                                    <th width="35%">Description</th>
                                                                                    <th width="15%">Show Status</th>
                                                                                    <th width="5%">Actions</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($sliders as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->id }}</td>
                                                                                        <td>{{ $item->slider_no }}</td>
                                                                                        <td>
                                                                                            <img src="/uploads/sliders/{{ $item->image }}"
                                                                                                alt="Image Preview"
                                                                                                class="img-thumbnail"
                                                                                                style="height: 50px; width: 50px;">
                                                                                        </td>
                                                                                        <td>{{ $item->title }}</td>
                                                                                        <td>{{ $item->description }}</td>
                                                                                        <td
                                                                                            style="color: {{ $item->show_status == 'Active' ? 'green' : ($item->show_status == 'Inactive' ? 'red' : 'black') }}">
                                                                                            {{ $item->show_status }}</td>
                                                                                        <td>
                                                                                            <div class="td-actions"
                                                                                                id="deleteButton_{{ $item->id }}">
                                                                                                <a href="{{ route('admin.sliders.edit', ['slider' => $item->id]) }}"
                                                                                                    class="icon green"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="top"
                                                                                                    title="Edit Row">
                                                                                                    <i
                                                                                                        class="icon-edit"></i>
                                                                                                </a>
                                                                                                <form method="POST"
                                                                                                    id="delete_form_{{ $item->id }}"
                                                                                                    action="{{ route('admin.sliders.destroy', ['slider' => $item->id]) }}"
                                                                                                    class="d-inline delete_form">
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                    <button type="submit"
                                                                                                        class="icon red"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        onclick="checker(event, {{ $item->id }})"
                                                                                                        title="Delete Row">
                                                                                                        <i
                                                                                                            class="icon-cancel"></i>
                                                                                                    </button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Row end -->
            </div>
            <!-- Main container end -->
        </div>
        <!-- Page content area end -->
    </div>
@endsection

@push('custom-js-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function checker(ev, item) {
            // Prevent the default form submission
            ev.preventDefault();
            // Use SweetAlert2 to display a confirmation modal
            Swal.fire({
                title: 'Are you sure to delete this post?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: '#d9534f',
                cancelButtonText: 'No, cancel!',
                cancelButtonColor: '#028a0f',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, submit the form with the given ID
                    var form = document.getElementById('delete_form_' + item);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Form not found: delete_form_' + item);
                    }
                } else {
                    // Optional: handle the case when the user cancels the deletion
                    Swal.fire('Cancelled', 'Your data is safe', 'error');
                }
            });
        }
    </script>
@endpush
