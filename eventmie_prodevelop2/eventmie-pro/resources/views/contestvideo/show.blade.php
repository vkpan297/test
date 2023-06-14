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
                    <select name="voterank" id="voterank" class="form-control" style="width:30%;float:right;">
                        <option value="">RANK</option>
                        @if (count($voterank) !== 0)
                            @foreach ($voterank as $item)
                                <option value="">{{ $item['title'] }} - {{ $item['name'] }} - {{ $item['vote_count'] }} vote</option>
                            @endforeach
                        @endif
                    </select>
                    <!-- nav tab -->
                    <section class="section-wrapper">
                        <div class="tab-wrapper">
                            <!-- use data-target value as ID to show tab content -->
                            <div class="tab-btns">
                                <button class="btn tab-btn active" data-target="tab-content-1">All submissions</button>
                                @if($customer == 1)
                                <button class="btn tab-btn" data-target="tab-content-2">My submissions</button>
                                @endif
                            </div>
                            <div class="tab-contents">
                                <!-- single item -->
                                <div class="content active" id="tab-content-1">
                                    @if(Auth::user())
                                        @if(count($counteachcontestsubmission) < 1)
                                            <a class="lgx-scroll lgx-btn lgx-btn-sm" href="{{ route('eventmie.contest.add') }}"><i class="fas fa-money-check-alt"></i> @lang('eventmie-pro::em.addvideocontest')</a>
                                        @endif
                                    @endif
                                    <div class="row">
                                        @if (count($listContestVideoByContestId) !== 0)
                                            @foreach ($listContestVideoByContestId as $item)
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="lgx-event"><a href="{{ route('eventmie.contestvideo.detail') }}?video={{ $item['id'] }}">

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
                                                                <h3 class="title">{{ $item['name'] }}</h3>
                                                                <h5 class="sub-title" style="height: 40px;">{{ strip_tags($item['description']) }}</h5>
                                                            </div>

                                                        </a></div>
                                                </div>
                                            @endforeach
                                                <div class="col-md-12">
                                                    {{ $listContestVideoByContestId->appends(request()->query())->links() }}
                                                </div>
                                        @else
                                            <div class="col-md-12">
                                                <h4 class="text-center">@lang('eventmie-pro::em.nothing')</h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- end of single item -->
                                <!-- single item -->
                                @if($customer == 1)
                                <div class="content" id="tab-content-2">
                                    <div class="row">
                                        @if (count($mysubmission) !== 0)
                                            @foreach ($mysubmission as $item)
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="lgx-event"><a href="{{ route('eventmie.contestvideo.detail') }}?video={{ $item['id'] }}">

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
                                                                <h3 class="title">{{ $item['name'] }}</h3>
                                                                <h5 class="sub-title" style="height: 40px;">{{ strip_tags($item['description']) }}</h5>
                                                                <a href="http://127.0.0.1:8000/contest/video/edit?video={{ $item['id'] }}" class="lgx-btn mt-2" style="width: 100%;">Edit Submissions</a>
                                                            </div>

                                                        </a></div>
                                                </div>
                                            @endforeach
                                                <div class="col-md-12">
                                                    {{ $mysubmission->appends(request()->query())->links() }}
                                                </div>
                                        @else
                                            <div class="col-md-12">
                                                <h4 class="text-center">@lang('eventmie-pro::em.nothing')</h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <!-- end of single item -->
                            </div>
                        </div>
                    </section>

                    <script>
                        const tabWrapper = document.querySelector(".tab-wrapper");
                        const tabBtns = document.querySelectorAll(".tab-btn");
                        const tabContents = document.querySelectorAll(".tab-contents .content");

                        tabWrapper.addEventListener("click", (e) => {
                            const id = e.target.dataset.target;
                            if (id) {
                                // remove active from other buttons
                                tabBtns.forEach((btn) => {
                                    btn.classList.remove("active");
                                    e.target.classList.add("active");
                                });
                                // hide other tabContents
                                tabContents.forEach((content) => {
                                    content.classList.remove("active");
                                });
                                const currentContent = document.getElementById(id);
                                currentContent.classList.add("active");
                            }
                        });

                    </script>
                    <!-- nav tab -->

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
