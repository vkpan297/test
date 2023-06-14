@extends('eventmie::layouts.app')

{{-- @section('title')
    @lang('eventmie-pro::em.myvideocontest')
@endsection --}}

@section('content')
    <main>
        <div class="lgx-page-wrapper">
            <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
            <!--Blogs-->
            <section>
                <div class="container">
                    <form method="POST" action="{{ route('eventmie.contestvideo.update') }}" class="lgx-contactform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="0">
                        <input type="hidden" name="id" value="{{ $contestvideo['id'] }}">
                        <input type="hidden" name="customer_id" aria-required="true" aria-invalid="false" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label>Contest <span style="color: red">(*)</span></label>
                            <select name="contest_id" disabled id="contest_id" class="form-control" required aria-required="true" aria-invalid="false">
                                <option value="">Select Contest</option>
                                <option selected value={{ $contest['id'] }}>{{ $contest['event_title'] }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title <span style="color: red">(*)</span></label>
                            <input type="text" name="title"
                                class="form-control" required aria-required="true" aria-invalid="false" value="{{ $contestvideo['title'] }}">
                            <span
                                class="help text-danger" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" rows="10" cols="80">{{ $contestvideo['description'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Poster</label>
                            <br>
                            <img src="{{asset('storage/'.$contestvideo['poster'])}}"
                                alt="" style="width: 100px;height: 100px;">
                            <br>
                            <input type="file" name="poster"
                                class="form-control-file" accept="image/*" aria-required="true" aria-invalid="false">
                        </div>
                        <div class="form-group" id="link-video">
                            <label>Video Url<span style="color: red">(*)</span></label>
                            <input type="text" disabled name="link_video"
                                class="form-control" required value="{{ $contestvideo['link_video'] }}"
                                aria-required="true" aria-invalid="false">
                        </div>
                        <button type="submit" class="btn lgx-btn btn-block"><i class="fas fa-sd-card"></i> Save</button>
                    </form>
                </div>
            </section>
            <script>
                CKEDITOR.replace('description');
            </script>
        </div>
    </main>
@endsection
