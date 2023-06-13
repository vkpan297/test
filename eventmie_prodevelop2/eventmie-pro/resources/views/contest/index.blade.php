@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie-pro::em.mycontest')
@endsection

@section('content')
    <main>
        <div class="lgx-post-wrapper">
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 table-responsive table-mobile">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Event</th>
                                        <th>Booked On </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($listContest) !== 0)
                                        @foreach ($listContest as $item)
                                            <tr>
                                                <td data-title="Order Id"><strong>#{{ $item['order_number'] }}</strong></td>
                                                <td data-title="Event"><a
                                                        href="{{ route('eventmie.contestvideo.index') }}?id={{ $item['id'] }}">{{ $item['event_title'] }}</a> <br><br>
                                                </td>
                                                <td data-title="Booked On">{{ date('d M Y', strtotime($item['created_at'])) }}</td>
                                                <td>
                                                    <a href="{{ route('eventmie.contestvideo.index') }}?id={{ $item['id'] }}" class="lgx-btn lgx-btn-sm lgx-btn-success">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="w-100" style="position: relative">
                                            <td class="w-100 text-center" style="position: absolute;
                                            width: 100%;"> @lang('eventmie-pro::em.nothing')</td>
                                        <tr>
                                    @endif
                                    <!---->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            {{ $listContest -> links() }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!---->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
