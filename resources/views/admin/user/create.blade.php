@extends('layouts.admin_master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>Create User</h2>
                <a href="{{ route('user.index') }}" class="btn btn-success h-100">List user</a>
            </div>
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif

                <ul class="list-inline m-0">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger"><span>{{$error}}</span></li>
                        @endforeach
                    @endif
                </ul>
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select class="form-control" name="role_id" id="">
                            <option selected disabled>Chose a Role</option>
                            @foreach ( $roles as $role )
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password"
                          class="form-control" name="confirm_password" id="confirm_password" placeholder="">
                      </div>
                    <div class="mb-3">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
