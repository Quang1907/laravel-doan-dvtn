@extends( "layouts.client_master" )
@section( "title", "Thay đổi thông tin" )

@section( "content" )
<div class=" dark:bg-gray-900 flex flex-wrap items-center justify-center">
    <div class="w-full bg-white dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out">
        <div class="h-2/4 sm:h-52 overflow-hidden">
            <img class="w-full" src="https://images.unsplash.com/photo-1638803040283-7a5ffd48dad5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" alt="Photo by aldi sigun on Unsplash" />
        </div>
        <x-account.profile-avata/>
        <div class="container m-auto max-w-3xl">
            <div class="container m-auto max-w-3xl">
                <x-errors.any />
                <div class="text-3xl font-semibold text-center pb-5">Thay đổi thông tin</div>
                <form action="{{ route( 'account.changeinfo' ) }}" method="post">
                    @csrf
                    <x-account.divInput type="text" name="name" label="Họ và tên" value="{{ \Auth::user()->name }}" />
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="" class="text-sm w-full @error("gender") text-red-400 @enderror">Giới tính @error("gender") {{ $message }}@enderror</label>
                        <div class="mt-2">
                            <input type="radio" name="gender" value="1" id="male"  @if ( old("gender", \Auth::user()->gender ) ) checked @endif>
                            <label for="male" class="w-full">Nam</label>
                            <input type="radio" name="gender" value="0" id="female"  @if ( old("gender", \Auth::user()->gender ) == 0 ) checked @endif>
                            <label for="female" class="w-full">Nữ</label>
                        </div>
                    </div>
                    <x-account.divInput type="email" name="email" label="Địa chỉ email" value="{{ \Auth::user()->email }}" />
                    <x-account.divInput type="date" name="birthday" label="Ngày sinh" value="{{ \Auth::user()->birthday }}" />
                    <x-account.divInput type="tel" name="phonenumber" label="Số điện thoại" value="{{ \Auth::user()->phonenumber }}" />
                    <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
