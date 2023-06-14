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
                    <form method="POST" action="{{ route('eventmie.contestvideo.store') }}" class="lgx-contactform">
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
                            <label>Link Video <span style="color: red">(*)</span></label>
                            <input type="url" name="link_video"
                                class="form-control" required placeholder="https://example.com" pattern="https://.*" size="30"
                                aria-required="true" aria-invalid="false"> <span class="help text-danger"
                                style="display: none;"></span>
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
