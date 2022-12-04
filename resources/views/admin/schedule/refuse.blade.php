@extends('layouts.admin_master')
@section('title', 'Trang quản lý hoạt động')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen flex mt-3 justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="d-float text-right mb-3">
                        <a href="{{ route( 'timkeeping' ) }}" class="button btn btn-success">Back</a>
                    </div>
                    <table class="min-w-max w-full table-auto" id="timekeeping">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Tên hoạt động</th>
                                <th class="py-3 px-6 text-left">Nội dung</th>
                                <th class="py-3 px-6 text-center">Thành viên</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ( $refuses as $refuse )
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $refuse->event->title }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $refuse->content_refuse }}
                                    </td>
                                    <td class="py-3 px-6 text-center w-25">
                                        {{ $refuse->user->name }}
                                    </td>
                                    <td class="text-center">
                                        @if ( $refuse->allow_absence == 1 )
                                            <span class="badge badge-success">Cho phép</span>
                                        @else
                                            @if ( $refuse->allow_absence == 2 )
                                                <span class="badge badge-danger">Không được phép</span>
                                            @else
                                                <span class="badge badge-warning text-white">Đang chờ</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center d-flex justify-content-center">
                                        <button type="submit" data-bs-toggle="modal" data-bs-target="#modalId" onclick="modalForm({{ $refuse->user->id }}, {{ $refuse->event->id }})"  class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i></button>
                                        <form action="{{ route( "user_event.refuse" ) }}" method="get">
                                            <input type="hidden"  value="{{ $refuse->user->id }}" name="user_id">
                                            <input type="hidden"  value="{{ $refuse->event->id }}" name="event_id">
                                            <input type="hidden"  value="doNotAllow" name="action">
                                            <button type="submit"  class="btn btn-danger"><i class="fa-solid fa-rectangle-xmark"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                     <!-- Modal -->
                     <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <form action="{{ route( "user_event.refuse" ) }}" method="get">
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div>
                                                <label for="" class="form-label w-full">Người thay thế</label>
                                                <select class="form-control category w-full" name="user_replace" id="user_id" multiple="multiple">
                                                    @foreach ( $users as $user )
                                                        <option @if ( in_array( $user->id, old( "user_id" , [] ) ) ) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="userError" class="text-danger"></span>
                                            </div>
                                            <input type="hidden" value="" id="event_user_id" name="user_id">
                                            <input type="hidden" value="" id="event_id" name="event_id">
                                            <input type="hidden" value="allow" name="action">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        function modalForm( user_id, event_id ) {
            $("#event_user_id").val( user_id );
            $("#event_id").val( event_id );
        }
        $(document).ready(function() {

            $('.category').select2();
            $(".select2-container").css("width", "430px");
            $('#timekeeping').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ hoạt động",
                    "zeroRecords": "Hiện tại chưa có bạn nào xin vắng mặt",
                    "info": "Trang _PAGE_ của _PAGES_",
                    "infoEmpty": "Hiện tại chưa có hoạt động",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
