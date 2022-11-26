@extends('layouts.admin_master')
@section("title", "Page Admin Setting")

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ route( 'setting.store' ) }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Website Name</label>
                                <input type="text" name="website_name" value="{{ $setting->website_name }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Website URL</label>
                                <input type="text" name="website_url"  value="{{ $setting->website_url }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Page Title</label>
                                <input type="text" name="page_title"  value="{{ $setting->page_title }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Meta keywords</label>
                                <input type="text" name="meta_keywords"  value="{{ $setting->meta_keywords }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Meta Description</label>
                                <input type="text" name="meta_description"  value="{{ $setting->meta_description }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website - Infomation</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Address</label>
                                <textarea name="address" id="" cols="30" rows="3"  class="form-control">{{ $setting->address }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone 1 *</label>
                                <input type="text" name="phone1"  value="{{ $setting->phone1 }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone No. 2</label>
                                <input type="text" name="phone2"  value="{{ $setting->phone2 }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email Id 1 *</label>
                                <input type="text" name="email1"  value="{{ $setting->email1 }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email Id 2</label>
                                <input type="text" name="email2"  value="{{ $setting->email2 }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website - Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Facebook</label>
                                <input type="text" name="facebook"  value="{{ $setting->facebook }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Twitter</label>
                                <input type="text" name="twitter"  value="{{ $setting->twitter }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Instagram</label>
                                <input type="text" name="instagram"  value="{{ $setting->instagram }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Youtube</label>
                                <input type="text" name="youtube"  value="{{ $setting->youtube }}" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Save Settings</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
