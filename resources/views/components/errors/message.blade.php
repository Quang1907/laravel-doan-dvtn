@if (\Session::has('message'))
    <div class="alert alert-primary d-flex align-items-center text-red-500" role="alert">
        <div>
            <i class="fa-solid fa-triangle-exclamation"></i>
            {!! \Session::get('message') !!}
        </div>
      </div>
@endif
