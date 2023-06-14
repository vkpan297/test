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
                                    <input type="hidden" name="home_url" id="home_url" value="{{ eventmie_url() }}">
                                    <figure>
                                        @if ($videotItem['video_type'] == 'ptube')
                                            <iframe width="100%" height="500" src="{{ $videotItem['link_video'] }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        @elseif($videotItem['video_type'] == 'youtube')
                                            <iframe width="100%" height="500"
                                                src="https://www.youtube.com/embed/{{ $videotItem['link_video'] }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        @endif
                                    </figure>
                                    <div class="pc-image-info-box-button">
                                        <div class="pc-image-info-box-button" style="position: relative;">
                                            <div class="pc-image-info-box-button-btn pc-show"
                                                style="background-color: #09F">
                                                <div class="pc-image-info-box-button-btn-text pc-cursor video_vote"
                                                    data-item="170" data-nonce="3d9e342f5a" data-share="2"
                                                    data-option="basic"><i class="fa fa-heart" aria-hidden="true"></i> Vote
                                                    Now!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-area">
                                        <div class="hits-area">
                                            <div class="date">
                                                <p><i class="fas fa-history"></i>{{ date('d M Y h:i', strtotime($videotItem['created_at'])) }}
                                                </p>
                                            </div>
                                        </div>
                                        <h3 class="title" style="margin: 0"><strong>TITLE:</strong> {{ $videotItem['title'] }}</h3>
                                        <h3 class="author" style="margin: 0"><strong>AUTHOR:</strong> {{ $user['name'] ? $user['name'] : '' }}</h3>
                                        <h3 class="vote" style="margin: 0"><strong>VOTES:</strong> {{ $videotItem['vote_count'] }}</h3>
                                    </div>
                                </header>
                                <section>
                                    <p><strong>Description: </strong>{{ strip_tags($videotItem['description']) }}
                                    </p>
                                </section>
                            </article>
                        </div>
                    </div>
                </div>
                <script>
                    $( ".pc-image-info-box-button-btn" ).on( "click", function() {
                        alert( "Handler for `click` called." );
                    } );
                </script>
            </section>
        </div>
    </main>
@endsection
