@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie-pro::em.myvideocontest')
@endsection

@section('content')

    <main>
        <div class="lgx-page-wrapper">
            <!--Blogs-->
            <section>
                <div class="container">
                    @if ($event != '')
                    <h5 class="visible-lg visible-md"><a href="/events/{{ $event['slug'] }}">@lang('eventmie-pro::em.contestinfo')</a> / <a href="">@lang('eventmie-pro::em.submission')</a></h5>
                    @endif
                    <div class="row">
                        @if (count($listContestVideoByContestId) !== 0)
                            @foreach ($listContestVideoByContestId as $item)
                                <?php
                                    // $video_id = explode("?v=", $item['link_video']);
                                    // $video_id = $video_id[1];
                                    // $thumbnail="http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
                                ?>
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="lgx-event"><a href="{{ route('eventmie.contestvideo.detail') }}?video={{ $item['id'] }}">
                                            <div class="lgx-event__tag"><span>Ended</span> <span>Event</span></div>
                                            <div class="lgx-event__image">
                                                @if ($item->poster != NULL)
                                                    <img src="{{asset('storage/'.$item->poster)}}"
                                                        alt="" style="width: 350px;height: 350px;"></div>
                                                @else
                                                    <img src=" /storage/events/September2019/1568624877YMeQtcWsib.jpg"
                                                        alt="" style="width: 350px;height: 350px;"></div>
                                                @endif
                                            <div class="lgx-event__info">
                                                <!---->
                                                <div class="lgx-event__featured-left"><span>Free</span></div>
                                                <div class="meta-wrapper"><span>{{ date('d M Y', strtotime($item['created_at'])) }}</span></div>
                                                <h3 class="title">{{ $item['title'] }}</h3>
                                                <h5 class="sub-title" style="height: 40px;">{{ strip_tags($item['description']) }}</h5>
                                            </div>

                                        </a></div>
                                </div>
                            @endforeach
                                <div class="col-md-12">
                                    {{ $listContestVideoByContestId -> links() }}
                                </div>
                        @else
                            <div class="col-md-12">
                                <h4 class="text-center">@lang('eventmie-pro::em.nothing')</h4>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">

                        </div>
                    </div>
                </div><!-- //.CONTAINER -->
            </section>
            <!--Blogs END-->
        </div>
    </main>
@endsection
