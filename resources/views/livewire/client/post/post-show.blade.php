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
                            <i class="ti-timer"></i>{{ format_date($post->created_at) }}
                        </li>
                        <li class="list-inline-item">
                            <i class="ti-calendar"></i>{{ $post->created_at->format('d-m-Y') }}
                        </li>
                        <li class="list-inline-item">
                            <ul class="card-meta-tag list-inline">
                                @foreach ($post->categories as $category)
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

            {{-- comment --}}
            <section class="column is-9-desktop mt-4 bg-white dark:bg-gray-900 py-8 lg:py-16">
                <div class="mx-auto px-4">
                    <div class="items-center mb-6" id="comment">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Thảo luận ( {{ $all_comments_count }} )
                        @if ( !empty(  $name_user ) )
                            <span class="px-2 bg-blue-500 w-48 text-white rounded">Reply: {{ $name_user }}</span>
                        @endif
                        </h2>
                    </div>
                    <form wire:submit.prevent="comment">
                        <div class="columns is-multiline">
                            <div class="input-group py-0 column is-12">
                                <textarea class="input" name="comment" columnss="7" wire:model="comment"></textarea>
                                @error( "comment" ) <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary bg-primary" type="submit">Comment Now</button>
                    </form>
                    @forelse ( $comments as $commentItem )
                        @if ( !$commentItem->parent_id )
                            <article class="mt-3 text-base bg-white rounded-lg dark:bg-gray-900">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                            <img
                                                class="mr-2 w-6 h-6 rounded-full"
                                                src="{{ url_image( $commentItem->user->avata ) }}"
                                                alt="{{ $commentItem->user->name }}">
                                            {{ $commentItem->user->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                                title="February 8th, 2022">{{ format_date( $commentItem->created_at->format( "d-m-Y h:i A" ) ) }}</time></p>
                                    </div>
                                    @if ( $commentItem->user->id == auth()->user()->id )
                                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                            <span class="sr-only">Comment settings</span>
                                        </button>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownComment1"
                                            class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                                <li>
                                                    <a href="#"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400">{{ $commentItem->content }}</p>
                                <div class="flex items-center mt-4 space-x-4">
                                    <a  href="#comment" wire:click="reply({{ $commentItem->id }})"
                                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                                        <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        Reply
                                    </a>
                                </div>
                            </article>

                            @foreach ( $comments as $commentRepli )
                                @if ( $commentRepli->parent_id == $commentItem->id )
                                    <article class="pl-6 mt-2 text-base bg-white rounded-lg dark:bg-gray-900">
                                        <footer class="flex justify-between items-center mb-2">
                                            <div class="flex items-center">
                                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                                    <img
                                                        class="mr-2 w-6 h-6 rounded-full"
                                                        src="{{ url_image( $commentItem->user->avata ) }}"
                                                        alt="{{ $commentItem->user->name }}">
                                                    {{ $commentItem->user->name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                                        title="February 8th, 2022">{{ format_date( $commentItem->created_at->format( "d-m-Y h:i A" ) ) }}</time></p>
                                            </div>
                                            @if ( $commentItem->user->id == auth()->user()->id )
                                                <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                        </path>
                                                    </svg>
                                                    <span class="sr-only">Comment settings</span>
                                                </button>
                                                <!-- Dropdown menu -->
                                                <div id="dropdownComment1"
                                                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownMenuIconHorizontalButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </footer>
                                        <p class="text-gray-500 dark:text-gray-400">{{ $commentRepli->content }}</p>
                                        <div class="flex items-center mt-4 space-x-4">
                                            <a href="#comment" wire:click="reply({{ $commentItem->id }})"
                                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                                                <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                    </path>
                                                </svg>
                                                Reply
                                            </a>
                                        </div>
                                    </article>
                                @endif
                            @endforeach
                        @endif
                    @empty
                        Hiện tại chưa có comment cho bài viết
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</section>
