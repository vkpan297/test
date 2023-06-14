@extends('eventmie::layouts.app')

{{-- @section('title')
    @lang('eventmie-pro::em.myvideocontest')
@endsection --}}

@section('content')
<main>
    <div class="lgx-page-wrapper">
        <!--Blogs-->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <article>
                            <header>
                                <figure>
                                    <iframe width="100%" height="500" src="{{ $videotItem['link_video'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </figure>
                                <div class="text-area">
                                    <div class="hits-area">
                                        <div class="date">
                                            <p><i class="fas fa-history"></i>{{ date('d M Y h:i', strtotime($videotItem['created_at'])) }}</p>
                                        </div>
                                    </div>
                                    <h1 class="title">{{ $videotItem['title'] }}</h1>
                                </div>
                            </header>
                            <section>
                                <p><strong>{{ strip_tags($videotItem['description']) }}</strong>
                            </p></section>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection
