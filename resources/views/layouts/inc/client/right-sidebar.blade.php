<aside class="column is-4-desktop sidebar-inner">
    <!-- Search -->
    <div class="widget">
        <h4 class="widget-title"><span>Tìm kiếm</span></h4>
        <form action="{{ url( 'hoat-dong' ) }}" class="widget-search">
            <input class="mb-3" id="search-query" name="search" type="search" value="{{ request()->search }}" placeholder="Danh mục &amp; tên bài viết...">
            <i class="ti-search"></i>
            <button type="submit" class="btn btn-outline-primary btn-block">Search</button>
        </form>
    </div>

    <!-- categories -->
    <div class="widget widget-categories">
        <h4 class="widget-title"><span>Categories post</span></h4>
        <ul class="list-unstyled widget-list">
            @foreach ( $categoryPosts  as $category )
                <li><a href="{{ route( 'category.post.slug', $category->slug ) }}" class="d-flex">{{ $category->name }} <small class="ml-auto">{{ "(" . $category->posts->count() . ")" }}</small></a></li>
            @endforeach
        </ul>
    </div><!-- tags -->
    <div class="widget">
        <h4 class="widget-title"><span>Tags</span></h4>
        <ul class="widget-list-inline widget-card">
            @foreach ( $categoryPosts as $tagPost )
                <li class="list-inline-item"><a href="{{ route( 'category.post.slug', $tagPost->slug ) }}">{{ $tagPost->name }}</a></li>
            @endforeach
            @foreach ( $categoryProducts as $tagProduct )
                <li class="list-inline-item"><a href="{{ route( 'category.product.slug', $tagProduct->slug ) }}">{{ $tagProduct->name }}</a></li>
            @endforeach
        </ul>
    </div><!-- recent post -->
    <div class="widget">
        <h4 class="widget-title">Bài viết gần đây</h4>
        @foreach ( $recent_posts as $recent_post )
            <article class="widget-card">
                <div class="is-flex">
                    <img class="card-img-sm" src="{{ url_image( $recent_post->image ) }}">
                    <div class="ml-3">
                        <h5><a class="post-title" href="{{ route( 'category.post.slug',  $recent_post->slug ) }}">{{ $recent_post->title }}</a>
                        </h5>
                        <ul class="card-meta mt-3">
                            <li class="list-inline-item mb-0">
                                <i class="ti-calendar"></i>{{ format_date( $recent_post->created_at ) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Social -->
    <div class="widget">
        <h4 class="widget-title"><span>Social Links</span></h4>
        <ul class="widget-social flex justify-center">
            @if ( $websiteSetting->facebook )
                <a href="{{ $websiteSetting->facebook }}" target="_blank"
                    class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            @endif

            @if ( $websiteSetting->twitter )
                <a href="{{ $websiteSetting->twitter }}" target="_blank"
                    class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            @endif

            @if ( $websiteSetting->instagram )
                <a href="{{ $websiteSetting->instagram }}" target="_blank"
                    class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                    <i class="fa-brands fa-square-instagram"></i>
                </a>
            @endif

            @if ( $websiteSetting->youtube )
                <a href="{{ $websiteSetting->youtube }}" target="_blank"
                    class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            @endif
        </ul>
    </div>
</aside>
