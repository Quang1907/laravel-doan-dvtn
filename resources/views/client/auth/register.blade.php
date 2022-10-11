@extends('layouts.client_master')
@section( "title", "Thay đổi mật khẩu" )

@section('content')
<div class="sm:container my-5">
    <form class="space-y-6 w-1/2 m-auto" method="post" action="{{ route( 'account.register' ) }}">
        @csrf
        <div class="text-3xl font-semibold text-center">Đăng ký tài khoản</div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="name" type="text" name="name" />
            <x-account.label name="name" label="Họ và tên" />
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="email" type="email" name="email"/>
            <x-account.label name="email" label="Địa chỉ email" />
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="birthday" type="date" name="birthday"/>
            <x-account.label name="birthday" label="Ngày sinh" />
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="" type="password" name="password"/>
            <x-account.label name="password" label="Mật khẩu" />
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="" type="password" name="confirm_password"/>
            <x-account.label name="confirm_password" label="Nhập lại mật khẩu" />
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <x-account.input value="phonenumber" type="tel" name="phonenumber"/>
            <x-account.label name="phonenumber" label="Số điện thoại (0708050907)" />
        </div>
        <div class="grid md:grid-cols-3 md:gap-6">
            <div class="relative z-0 mb-6 w-full group">
                <x-account.select name="province" />
                <x-account.label name="province" label="Thành phố" />
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <x-account.select name="district" />
                <x-account.label name="district" label="Quận/Huyện" />
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <x-account.select name="ward" />
                <x-account.label name="ward" label="Xã/Phường" />
            </div>
        </div>
        <div class="relative z-0 w-full group">
            <x-account.select name="manager" />
            <x-account.label name="manager" label="Người quản lý" />
        </div>
        <div class="relative z-0 w-full group">
            <x-account.input value="" type="text" name="street"/>
            <x-account.label label="Tổ dân phố" name="street" />
        </div>
        <input type="hidden" name="address" id="address">

        <button type="submit" id="create" class="btn-submit">Đăng ký</button>
    </form>
</div>
@endsection

@section( "script" )
<script>
        $.ajax({
            type: 'get',
            url: '{{ route("api.province") }}',
            success:function( data ){
                $.each( data, function ( key, province ) {
                    $($.parseHTML("<option>" + province.name + "</option>")).attr("value", province.id ).appendTo("#province");
                });
            }
        });

        $("#province").change( function () {
            $("#district").html("<option disabled selected>Choose a district</option>");
            var data = { "province" : $(this).val() };
            $.ajax({
                type: 'get',
                url: '{{ route("api.district" ) }}',
                data: data ,
                success:function( response ){
                    $.each( response, function ( key, district ) {
                        $($.parseHTML("<option>" + district.name + "</option>")).attr("value", district.id ).appendTo("#district");
                    });
                }
            });
        });

        $("#district").change( function () {
            $("#ward").html("<option disabled selected>Choose a ward</option>");
            var data = { "district" : $(this).val() };

            $.ajax({
                type: 'get',
                url: '{{ route("api.ward" ) }}',
                data: data ,
                success:function( response ){

                    $.each( response, function ( key, ward ) {
                        $($.parseHTML("<option>" + ward.name + "</option>")).attr("value", ward.id ).appendTo("#ward");
                    });
                }
            });
        } );

        $("#ward").change( function () {

            $("#manager").html("<option disabled selected>Choose a manager</option>");
            var ward = $(this).find(":selected").text();
            var district = $("#district").find(":selected").text();
            var province = $("#province").find(":selected").text();
            var data = { "address" :  ward + ", " + district + ", "+ province};

            $.ajax({
                type: 'get',
                url: '{{ route("api.userManager" ) }}',
                data: data,
                success:function( response ){
                    $.each( response, function ( key, manager ) {
                       $($.parseHTML("<option>" + manager.name + "</option>")).attr("value", manager.id ).appendTo("#manager");
                    });
                }
            });
        })

        $("#street").on( "keyup", function () {
            var ward = $("#ward").find(":selected").text();
            var district = $("#district").find(":selected").text();
            var province = $("#province").find(":selected").text();
            var address = $("#street").val() + ", "+ ward + ", " + district + ", "+ province;

            $("#address").val( address );
        });

</script>
@endsection
