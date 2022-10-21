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
                <div class="bg-white shadow-md rounded p-4">
                    <table class="min-w-max w-full table-auto" id="timekeeping">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Tên hoạt động</th>
                                <th class="py-3 px-6 text-left">Thời gian</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                          @forelse ( $events as $event )
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $event->title }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $event->start . " đến " . $event->end }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {!! check_time( $event ) !!}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            @if ( check_time_end( $event->end ) )
                                               <a href="{{ route( 'timkeeping.detail', $event ) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @else
                                                <i class="fa-solid fa-eye-slash"></i>
                                            @endif
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
            }
        }
    );
} );
</script>
@endsection
