@extends('layouts.admin_master')
@section('title', 'Trang quản lý hoạt động')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
@endsection

@section('content')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen flex mt-3 justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="border rounded-md mb-3 bg-white">
                    <div class="text-center">
                        <h2 class="text-lg font-semibold border-b-2">Thông tin hoạt động</h2>
                    </div>
                    <div class="m-3">
                        <h4 class="font-semibold">Tên hoạt động: <span class="text-gray-500">{{ $event->title }}</span></h4>
                        <h4 class="font-semibold">Thời gian bắt đầu: <span class="text-gray-500">{{ $event->start }}</span></h4>
                        <h4 class="font-semibold">Thời gian kết thúc: <span class="text-gray-500">{{ $event->end }}</span></h4>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded p-4">
                    <table class="min-w-max w-full table-auto" id="timekeeping">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Tên đoàn viên</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                          @forelse ( $users as $user )
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ check_active_event( $user->active ) }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2transform hover:text-purple-500 hover:scale-110">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          @empty

                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#timekeeping').DataTable();
} );
</script>
@endsection
