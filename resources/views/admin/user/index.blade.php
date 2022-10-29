@extends('layouts.admin_master')
@section("title", "List user")
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>List User</h2>
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success h-100">Create new user</a>
                </div>
            </div>

           <div class="mt-4 mx-4">
            <x-errors.any></x-errors.any>
           </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <form action="" method="get">
                            <div class="dt-buttons btn-group flex-wrap">
                                <div class="my-3 px-1">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control rounded-0 px-2"
                                            value="{{ request('search') }}" placeholder="Search name or email"
                                            aria-controls="example1">
                                    </div>
                                </div>
                                <div class="form-group mt-3 px-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" value="{{ request('date') }}" name="date" class="form-control"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                            data-mask="" inputmode="numeric">
                                    </div>
                                </div>
                                <div class="form-group mt-3 px-1">
                                        <select class="form-control form-select-lg" name="is_active" id="">
                                            <option value="" selected>Tất cả</option>
                                            <option value="1" @if( request()->is_active == 1 ) selected @endif >Hoạt động</option>
                                            <option value="2" @if( request()->is_active == 2 ) selected @endif >Không hoạt động</option>
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary bg-primary mt-0">Search</button>
                                    <button type="button" class="btn btn-sm btn-success bg-success mt-0" id="btnActive">Active</button>
                                    <button type="button" class="btn btn-sm btn-danger bg-danger mt-0" id="btnInactive">Inactive</button>
                                    <a href="{{ url( 'admin/user?softdelete=on' ) }}" class="btn btn-sm btn-dark mt-0" id="btnInactive">
                                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                                    </a>
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-warning bg-warning text-white mt-0">Reset</a>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route( 'user.active' ) }}" id="form_active" method="post">
                            @csrf
                            <input type="text" class="d-none" name="active" id="valueCheckActive" >
                            <input type="checkbox" class="d-none" name="inactive" id="valueCheckInActive">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary text-black">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="checkAll"></th>
                                <th scope="col">Name</th>
                                <th scope="col">email</th>
                                <th scope="col">role</th>
                                <th scope="col">permission</th>
                                <th scope="col" class="text-center">active</th>
                                <th scope="col" class="w-25">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $users as $user )
                                <tr class="">
                                    <td scope="row"><input type="checkbox" value="{{ $user->id }}" class="checkbox"></td>
                                    <td scope="row">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                       <ul>
                                        @foreach ( $user->role->permissions as $permission )
                                            <li>
                                                {{ $permission->name }}
                                            </li>
                                        @endforeach
                                       </ul>
                                    </td>
                                    <td class="text-center my-auto">
                                        <i class="@if ( $user->is_active ) text-success @else text-danger @endif fa-regular fa-circle-dot"></i>
                                    </td>
                                    <td>
                                        @if ( request()->softdelete != "on" )
                                            <form action="{{ route('user.destroy', $user ) }}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                                <button type="submit" onclick="return confirm( 'Bạn có muốn tiếp tục?' ) " class="btn btn-sm btn-danger bg-danger">Delete</button>
                                            </form>
                                        @else
                                            <form action="{{ route( 'user.softDelete', $user ) }}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="{{ route( 'user.restoreDelete', $user ) }}"
                                                onclick="return confirm( 'Bạn có muốn tiếp tục kích hoạt người dùng?' );"
                                                class="btn btn-sm btn-success">Restore</a>
                                                <button type="submit" onclick="return confirm( 'Bạn có muốn tiếp tục?' ) " class="btn btn-sm btn-danger bg-danger">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Hiện tại không có người dùng nào tương ứng</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $users->appends( request()->all() )->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section( "script" )
<script>
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

            $( "#valueCheckActive" ).val( checkbox );
            $( "#valueCheckInActive" ).click();
            $( "#form_active" ).submit();
        } );
    </script>
@endsection
