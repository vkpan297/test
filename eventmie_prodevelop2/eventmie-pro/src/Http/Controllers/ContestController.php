<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Facades\Classiebit\Eventmie\Eventmie;
use Auth;

use Classiebit\Eventmie\Models\Contest;


class ContestController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // language change
        $this->middleware('common');

        // authenticate except
        $this->middleware('auth')->except(['login_first', 'signup_first']);

        $this->contest       = new Contest;
    }

    // public function index(Request $request, $view = 'eventmie::contest.index', $extra = []){
    //     $listContest = $this->contest->all();

    //     return Eventmie::view($view, compact('listContest'));
    // }

    public function index($view = 'eventmie::contest.customer_bookings', $extra = [])
    {
        // get prifex from eventmie config
        $path = false;
        if(!empty(config('eventmie.route.prefix')))
            $path = config('eventmie.route.prefix');

        // if have booking email data then send booking notification
        $is_success = !empty(session('booking_email_data')) ? 1 : 0;

        return Eventmie::view($view, compact('path', 'is_success','extra'));
    }

}
