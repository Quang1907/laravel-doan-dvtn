@extends('layouts.client_master')
@section('title', $post->title)

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns is-multiline is-desktop is-justify-content-center">
                <div class="column is-9-desktop mb-5">
                    <article>
                        <div class="post-slider mb-4">
                            <img src="{{ url_image( $post->image ) }}" class="card-img rounded" alt="post-thumb">
                        </div>

                        <h1 class="h2">{{ $post->title }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="card-meta-author">
                                    <img src="{{ url_image( $post->user->avata ) }}">
                                    <span>{{ $post->user->name }}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-timer"></i>{{ format_date( $post->created_at ) }}
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{  $post->created_at->format( "d-m-Y" ) }}
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    @foreach ( $post->categories as $category )
                                        <li class="list-inline-item"><a href="">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="content">
                            {!! $post->content !!}
                        </div>
                    </article>

                </div>

                <div class="column is-9-desktop mt-4">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-5 h3">Comments</h3>

                        <div class="block mb-4 pb-4">
                            <a class="is-block mb-5" href="#"><img src="images/post/user-01.jpg"
                                    class="mr-3 rounded-circle" alt=""></a>

                            <a href="#!" class="h4 d-inline-block mb-3">Alexender Grahambel</a>
                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                                Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc
                                ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                            <span class="text-black-800 mr-3 font-weight-600">April 18, 2020 at 6.25 pm</span>
                            <a class="text-primary font-weight-600" href="#!">Reply</a>
                        </div>

                    </div>

                    <div class="pt-5">
                        <h3 class="mb-5">Leave a Reply</h3>
                        <form method="POST">
                            <div class="columns is-multiline">
                                <div class="input-group py-0 column is-12">
                                    <textarea class="input" name="comment" columnss="7" required></textarea>
                                </div>
                                <div class="input-group py-0 column is-4-desktop">
                                    <input class="input" type="text" placeholder="Name" required>
                                </div>
                                <div class="input-group py-0 column is-4-desktop">
                                    <input class="input" type="email" placeholder="Email" required>
                                </div>
                                <div class="input-group py-0 column is-4-desktop">
                                    <input class="input" type="url" placeholder="Website">
                                </div>
                            </div>
                            <button class="btn btn-primary bg-primary" type="submit">Comment Now</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
