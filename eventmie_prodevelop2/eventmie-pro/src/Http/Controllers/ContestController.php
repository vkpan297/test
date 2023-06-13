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

    public function index(Request $request, $view = 'eventmie::contest.index', $extra = []){
        $listContest = $this->contest->latest()->paginate(10);
        return Eventmie::view($view, compact('listContest'));
    }

}
