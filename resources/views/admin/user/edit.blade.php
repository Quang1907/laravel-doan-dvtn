@extends('layouts.admin_master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2 class="p-0 m-0">Create User</h2>
                    <a href="{{ route('user.index') }}" class="btn btn-success">List user</a>
                </div>
            </div>
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span>{{$error}}</span>
                    @endforeach
                @endif

                <form action="{{ route('user.update', $user) }}" method="post">
                    @csrf
                    @method("put")
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input disabled type="email" class="form-control" name="email" value="{{ $user->email }}"  id="email" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select class="form-control" name="role_id" id="">
                            <option selected disabled>Chose a Role</option>
                            @foreach ( $roles as $role )
                                <option {{ ( $role->id == $user->role_id ) ? "selected" : "" }} value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
