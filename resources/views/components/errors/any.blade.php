@if ( $errors->any() )
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Error. Please check again.</h4>
        <hr>
        @foreach ( $errors->all() as $error)
            <li class="">{{ $error }}</li>
        @endforeach
    </div>
@endif
