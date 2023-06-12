@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie-pro::em.profile')
@endsection

@section('content')

    <main>
        <div class="lgx-post-wrapper">
            <section>
                <div class="container">
                    <div class="lgx-tab">
                        <!---->
                        <ul class="nav nav-pills lgx-nav">


                            <li data-toggle="pill" :class="{ 'active': currentRouteName == 'personal-details' }">
                                <router-link :to="{ name: 'personal-details' }">
                                    <h3>
                                        @lang('eventmie-pro::em.personal_details')
                                        <i class="fas fa-exclamation-circle text-danger"
                                            v-if="!store.state.personal_details"></i>
                                        <i class="fas fa-check-circle text-white" v-else></i>
                                    </h3>

                                </router-link>
                            </li>

                            <li data-toggle="pill" :class="{ 'active': currentRouteName == 'security' }">
                                <router-link :to="{ name: 'security' }">
                                    <h3>
                                        @lang('eventmie-pro::em.security')
                                        <i class="fas fa-check-circle text-white"></i>
                                    </h3>
                                </router-link>
                            </li>
                            @if (!Auth::user()->hasRole('customer'))
                                <li data-toggle="pill" :class="{ 'active': currentRouteName == 'bank-details' }">
                                    <router-link :to="{ name: 'bank-details' }">
                                        <h3>
                                            @lang('eventmie-pro::em.update_bank_details')
                                            <i class="fas fa-exclamation-circle text-danger"
                                                v-if="!store.state.update_bank_details"></i>
                                            <i class="fas fa-check-circle text-white" v-else></i>
                                        </h3>
                                    </router-link>
                                </li>
                            @endif

                            @if (!Auth::user()->hasRole('customer') || Auth::user()->hasRole('organiser'))
                                <li data-toggle="pill" :class="{ 'active': currentRouteName == 'organiser-info' }">
                                    <router-link :to="{ name: 'organiser-info' }">
                                        <h3>
                                            @lang('eventmie-pro::em.organiser_info')
                                            <i class="fas fa-exclamation-circle text-danger"
                                                v-if="!store.state.organiser_info"></i>
                                            <i class="fas fa-check-circle text-white" v-else></i>
                                        </h3>
                                    </router-link>
                                </li>
                            @endif

                            @if (Auth::user()->hasRole('customer'))
                                @if (setting('multi-vendor.multi_vendor'))
                                    @if ((setting('multi-vendor.manually_approve_organizer') && empty($user->organisation)) ||
                                        !setting('multi-vendor.manually_approve_organizer'))
                                        <li data-toggle="pill"
                                            :class="{ 'active': currentRouteName == 'become-organiser' }">
                                            <router-link :to="{ name: 'become-organiser' }">
                                                <h3>Become Organiser</h3>
                                            </router-link>
                                        </li>
                                    @endif
                                @endif
                            @endif


                        </ul>

                        <div class="tab-content lgx-tab-content lgx-tab-content-event">
                            <router-view>
                            </router-view>
                        </div>

                    </div>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">@lang('eventmie-pro::em.become_organiser')</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info">
                                        <h4>@lang('eventmie-pro::em.info')</h4>
                                        <ul>
                                            <li>@lang('eventmie-pro::em.organiser_note_1')</li>
                                            <li>@lang('eventmie-pro::em.organiser_note_2')</li>
                                            <li>@lang('eventmie-pro::em.organiser_note_3')</li>
                                            <li>@lang('eventmie-pro::em.organiser_note_4')</li>
                                        </ul>
                                    </div>
                                    <form class="form-horizontal" method="POST" action="{{route('eventmie.updateAuthUserRole') }}"
                                        method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="role_id" value="3">

                                        <div class="form-group row">
                                            <label class="col-md-3">@lang('eventmie-pro::em.organization')</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="organisation" type="text"
                                                    placeholder="@lang('eventmie-pro::em.brand_identity')" value="{{ $user->organisation }}">

                                                @if ($errors->has('organisation'))
                                                    <div class="error">
                                                        {{ $errors->first('organisation') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="lgx-btn"><i class="fas fa-sd-card"></i>
                                                    @lang('eventmie-pro::em.submit')</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ eventmie_asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ eventmie_asset('js/bootstrap.min.js') }}"></script>

    {{-- CUSTOM --}}
    <script type="text/javascript">
        var multi_vendor = {!! json_encode(setting('multi-vendor.manually_approve_organizer'), JSON_HEX_APOS) !!}
        var user = {!! json_encode($user, JSON_HEX_APOS) !!}
        var csrf_token = {!! json_encode(@csrf_token(), JSON_HEX_APOS) !!}
    </script>

    <script type="text/javascript" src="{{ eventmie_asset('js/profile_v1.8.js') }}"></script>

    {{-- CUSTOM --}}
@stop
