<div style="background-color: white;">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    @if (Session::has('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    @if (Session::has('info'))

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('info') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif

    @if (Session::has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('warning') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

</div>
