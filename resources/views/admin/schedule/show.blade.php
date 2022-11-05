@extends('layouts.admin_master')
@section('title', 'Trang quản lý hoạt động')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
@endsection

@section('content')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen flex mt-3 justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="border rounded-md mb-3 bg-white">
                    <div class="text-center flex justify-center">
                        <h2 class="text-lg w-full font-semibold py-2">Thông tin hoạt động</h2>
                        <div class="m-3">
                            <a href="{{ route( 'timkeeping' ) }}" class=" text-white bg-green-500 p-2 text-center align-items-center rounded-lg"><i class="fa-solid fa-backward-step"></i></a>
                        </div>
                    </div>
                    <div class="m-3">
                        <h5 class="font-semibold">Tên hoạt động: <span class="text-gray-500">{{ $event->title }}</span></h5>
                        <h5 class="font-semibold">Thời gian bắt đầu: <span class="text-gray-500">{{ $event->start }}</span></h5>
                        <h5 class="font-semibold">Thời gian kết thúc: <span class="text-gray-500">{{ $event->end }}</span></h5>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded p-4">
                    <div class="pb-3">
                        <form action="{{ route( 'user_event.active' ) }}" id="form_active" method="post">
                            @csrf
                            <input type="text" class="d-none" name="active" id="valueCheckActive" >
                            <input type="checkbox" class="d-none" name="inactive" id="valueCheckInActive">
                            <input type="text" class="d-none" value="{{ $event->id }}" name="event" id="event">
                        </form>
                        <button type="button" class="btn btn-sm btn-success bg-success mt-0" id="btnActive">Có tham gia</button>
                        <button type="button" class="btn btn-sm btn-danger bg-danger mt-0" id="btnInactive">Không tham gia</button>
                    </div>
                    <table class="min-w-max w-full table-auto" id="timekeeping">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th scope="col"><input type="checkbox" id="checkAll"></th>
                                <th class="py-3 px-6 text-left">Tên đoàn viên</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ( $users as $user )
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td scope="row"><input type="checkbox" value="{{ $user->id }}" class="checkbox"></td>
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
    $('#timekeeping').DataTable(
        {
            "language": {
                "lengthMenu": "Hiển thị _MENU_ hoạt động",
                "zeroRecords": "Không tìm thấy hoạt động tương ứng",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Hiện tại chưa có hoạt động",
                "infoFiltered": "(filtered from _MAX_ total records)"
            },
        }
    );

    $("#checkAll").click( function(){
        $('.checkbox:checkbox').not(this).prop('checked', this.checked);
    });

    $("#btnActive").click( function () {
        var checkbox = $('.checkbox[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        $( "#valueCheckActive" ).val( checkbox );
        $( "#form_active" ).submit();
    } );

    $("#btnInactive").click( function () {
        var checkbox = $('.checkbox[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();
        console.log(checkbox);
        $( "#valueCheckActive" ).val( checkbox );
        $( "#valueCheckInActive" ).click();
        $( "#form_active" ).submit();
    } );
} );
</script>
@endsection
