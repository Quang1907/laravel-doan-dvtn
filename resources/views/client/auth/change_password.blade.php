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
                <div class="text-3xl font-semibold text-center pb-5">Thay đổi mật khẩu</div>
                <form action="{{ route( 'account.changePassword' ) }}" method="post">
                    @csrf
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                    </div>
                    <div class="mb-6">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhập lại mật khẩu</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                    </div>
                    <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
