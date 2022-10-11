@extends( "layouts.client_master" )
@section( "title", "Xác minh thông tin" )

@section( "content" )
<div class=" dark:bg-gray-900 flex flex-wrap items-center justify-center">
    <div class="w-full bg-white dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out">
        <div class="h-2/4 sm:h-52 overflow-hidden">
            <img class="w-full" src="https://images.unsplash.com/photo-1638803040283-7a5ffd48dad5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" alt="Photo by aldi sigun on Unsplash" />
        </div>
        <x-account.profile-avata/>
        <div class="container m-auto max-w-3xl">
            <div class="container m-auto max-w-3xl">
                <div class="text-3xl font-semibold text-center pb-5">Hoàn tất thông tin</div>
                <form action="{{ route( 'account.confirm', auth()->user() ) }}" method="post">
                    @csrf
                    <div class="relative z-0 mb-6 w-full group">
                        <x-account.input value="phonenumber" type="tel" name="phonenumber"></x-account.input>
                        <x-account.label name="phonenumber" label="Số điện thoại" />
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <x-account.input value="birthday" type="date" name="birthday"></x-account.input>
                        <x-account.label name="birthday" label="Ngày sinh" />
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <x-account.input value="" type="password" name="password"></x-account.input>
                        <x-account.label name="password" label="Mật khẩu" />
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <x-account.input value="" type="password" name="confirm_password"></x-account.input>
                        <x-account.label name="confirm_password" label="Xác minh mật khẩu" />
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <x-account.input value="address" type="text" name="address"></x-account.input>
                        <x-account.label name="address" label="Địa chỉ" />
                    </div>
                    <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
