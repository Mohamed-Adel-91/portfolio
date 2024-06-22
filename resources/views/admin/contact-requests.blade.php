@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">

        <!-- Side bar area -->
        @include('admin.layouts.sidebar')
        <!-- Side bar area end -->

        <!-- ####################################################################### -->

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
                            <div class="d-flex p-2 justify-content-end">

                            </div>
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
                                            <th>Submitted At</th>
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
                                                <td>{{ $item->message }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($item->created_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="7">No Data Found</th>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $data->links() }}
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
