@extends('layouts.client_master')
@section( "title", "Quên mật khẩu" )

@section('content')
<div class="sm:container my-5">
    <div class="w-1/3 m-auto">
        <x-errors.message />
    </div>
    <form class="space-y-6 w-1/2 m-auto" method="post" action="{{ route( "forget.password" ) }}">
        @csrf
        <div class="text-3xl font-semibold text-center">
            Nhập địa chỉ email của bạn
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="email" type="email" name="email" />
            <x-account.label name="email" label="Email" />
        </div>
        <button type="submit" class="btn-submit">Gửi mã</button>
    </form>
</div>
@endsection
