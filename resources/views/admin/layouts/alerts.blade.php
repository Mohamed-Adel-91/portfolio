@if (Session::has('error'))
    <div class="mb-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="color: white;">
            {{ Session::get('error') }}
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="mb-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: white;">
            {{ Session::get('success') }}
        </div>
    </div>
@endif


@if ($errors->any())
    <div class="mb-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="color: white;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
@endif
