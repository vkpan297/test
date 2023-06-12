<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Facades\Classiebit\Eventmie\Eventmie;
use Auth;

use Classiebit\Eventmie\Models\ContestVideo;


class ContestVideoController extends Controller
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

        $this->contestvideo        = new ContestVideo;
    }

    public function index(Request $request, $view = 'eventmie::contestvideo.show', $extra = []){
        $listContestVideoByContestId = $this->contestvideo::where('contest_id', $request->id)->get();

        return Eventmie::view($view, compact('listContestVideoByContestId'));
    }

}
