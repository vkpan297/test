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
                    <form method="POST" action="{{ route('eventmie.contestvideo.store') }}" class="lgx-contactform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="0">
                        <input type="hidden" name="customer_id" aria-required="true" aria-invalid="false" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label>Contest <span style="color: red">(*)</span></label>
                            <select name="contest_id" id="contest_id" class="form-control" required aria-required="true" aria-invalid="false">
                                <option value="">Select Contest</option>
                                @if (count($listcontest) !== 0)
                                    @foreach ($listcontest as $item)
                                        <option value={{ $item['id'] }}>{{ $item['event_title'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title <span style="color: red">(*)</span></label>
                            <input type="text" name="title"
                                class="form-control" required aria-required="true" aria-invalid="false">
                            <span
                                class="help text-danger" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Poster</label>
                            <input type="file" name="poster"
                                class="form-control-file" accept="image/*" aria-required="true" aria-invalid="false">
                            <span
                                class="help text-danger" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label>Video Type <span style="color: red">(*)</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="video_type" id="video_type1" value="youtube" onclick="showInputField(1)">
                                <label for="flexRadioDefault1">
                                  Youtube
                                </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="video_type" id="video_type2" value="ptube" onclick="showInputField(2)" checked>
                              <label for="flexRadioDefault2">
                                Ptube
                              </label>
                            </div>
                        </div>
                        <div class="form-group" id="link-video">
                            <!--<label>Video Url<span style="color: red">(*)</span></label>
                            <input type="url" name="link_video"
                                class="form-control" required placeholder="https://example.com" pattern="https://.*" size="30"
                                aria-required="true" aria-invalid="false"> <span class="help text-danger"
                                style="display: none;"></span>-->
                        </div>
                        <button type="submit" class="btn lgx-btn btn-block"><i class="fas fa-sd-card"></i> Save</button>
                    </form>
                </div>
            </section>
            <script>
                CKEDITOR.replace('description');
            </script>
            <script>
                var inputField = document.getElementById('link-video');
                inputField.innerHTML = `<label>Video Url<span style="color: red">(*)</span></label>
                                <input type="url" name="link_video"
                                class="form-control" required placeholder="https://example.com" pattern="https://.*" size="30"
                                aria-required="true" aria-invalid="false"> <span class="help text-danger"
                                style="display: none;"></span>`;
                function showInputField(type) {
                    var inputField = document.getElementById('link-video');
                    if (type === 1) {
                        inputField.innerHTML = `<label>Video Url<span style="color: red">(*)</span></label>
                                <input type="text" name="link_video"
                                class="form-control" required placeholder="Zjq1zRWpcgs" size="30"
                                aria-required="true" aria-invalid="false"> <span class="help-block">Enter Video ID Only: https://www.youtube.com/watch?v=<strong>Zjq1zRWpcgs</strong></span>`;
                    } else if (type === 2) {
                        inputField.innerHTML = `<label>Video Url<span style="color: red">(*)</span></label>
                                <input type="url" name="link_video"
                                class="form-control" required placeholder="https://example.com" pattern="https://.*" size="30"
                                aria-required="true" aria-invalid="false"> <span class="help text-danger"
                                style="display: none;"></span>`;
                    } else {
                        inputField.innerHTML = '';
                    }
                }
            </script>

        </div>
    </main>
@endsection
