@extends('layouts.client_master')
@section('title', $post->title)

@section('content')
    @livewire('client.post.post-show', ['post' => $post])
@endsection
