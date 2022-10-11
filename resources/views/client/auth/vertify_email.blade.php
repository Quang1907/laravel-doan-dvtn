@extends('layouts.client_master')
@section( "title", "Xác minh email" )

@section('content')
<div class="sm:container my-5">
    <form class="space-y-6 w-1/2 m-auto" method="post" action="{{ route( 'account.vertify', $user ) }}">
        @csrf
        <div class="text-3xl font-semibold text-center">
            Xác minh địa chỉ email của bạn:
            <h2>{{ $user->email }}</h2>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="confirm_token" type="text" name="confirm_token" />
            <x-account.label name="confirm_token" label="Mã xác minh" />
        </div>
        <button type="submit" id="create" class="btn-submit">Xác minh</button>
    </form>
</div>
@endsection
