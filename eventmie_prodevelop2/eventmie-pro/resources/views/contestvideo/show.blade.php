@extends('eventmie::layouts.app')

{{-- @section('title')
    @lang('eventmie-pro::em.blogs')
@endsection --}}

@section('content')

    <main>
        <div class="lgx-page-wrapper">
            <!--Blogs-->
            <section>
                <div class="container">
                    <div class="row">
                        @if (!empty($listContestVideoByContestId))
                            @foreach ($listContestVideoByContestId as $item)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="lgx-event"><a href="http://127.0.0.1:8000/events/digital-marketing-seminar">
                                            <div class="lgx-event__tag"><span>Ended</span> <span>Event</span></div>
                                            <div class="lgx-event__image"><img
                                                    src="/storage/events/September2019/1568624877YMeQtcWsib.jpg"
                                                    alt=""></div>
                                            <div class="lgx-event__info">
                                                <!---->
                                                <div class="lgx-event__featured-left"><span>Free</span></div>
                                                <div class="meta-wrapper"><span> 25 Nov 2022</span> <span>25 Nov 2023
                                                    </span> <span>Nagano</span></div>
                                                <h3 class="title">Digital Marketing Seminar</h3>
                                                <h5 class="sub-title" style="height: 40px;">Resolution diminution conviction
                                                    so mr at unpleasing simplicity</h5>
                                                <h5 class="sub-title text-primary" style="height: 40px;">@History Museum
                                                </h5>
                                            </div>
                                            <div class="lgx-event__footer">
                                                <div>
                                                    Free : Free
                                                </div>
                                                <div>
                                                    Early Bird : 10.00 USD
                                                </div>
                                                <!---->
                                                <!---->
                                                <!---->
                                                <!---->
                                                <!---->
                                                <!---->
                                            </div>
                                            <div class="lgx-event__category"><span>Business &amp; Seminars</span></div>
                                        </a></div>
                                </div>
                            @endforeach
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
