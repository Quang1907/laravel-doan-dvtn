@extends('layouts.admin_master')
@section("title", "List user")
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>List User</h2>
                <a href="{{ route('user.create') }}" class="btn btn-success h-100">Create new user</a>
            </div>
            @if (\Session::has('message'))
                <div class="alert alert-success text-center">
                    <ul class="m-0">
                        <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                    </ul>
                </div>
            @endif
            @if ( $errors->any() )
                @foreach ( $errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">email</th>
                                <th scope="col">role</th>
                                <th scope="col">permission</th>
                                <th scope="col" class="w-25">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $users as $user )
                                <tr class="">
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
                                    <td>
                                        <form action="{{ route('user.destroy', $user ) }}" method="post">
                                            @csrf
                                            @method("delete")
                                            <a href="{{ route('user.edit', $user) }}" class="btn btn-warning">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
