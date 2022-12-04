@if ( session( "message" ) )
    <div class="alert alert-success" role="alert">
        <span class="text-white"> {{ session( "message" ) }} </span>
      </div>
@endif
