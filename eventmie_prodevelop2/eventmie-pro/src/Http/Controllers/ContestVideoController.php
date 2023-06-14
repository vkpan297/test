<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Facades\Classiebit\Eventmie\Eventmie;
use Auth;

use Classiebit\Eventmie\Models\ContestVideo;
use Classiebit\Eventmie\Models\Contest;


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
        $this->contest        = new Contest;
    }

    public function index(Request $request, $view = 'eventmie::contestvideo.show', $extra = []){
        $listContestVideoByContestId = $this->contestvideo::where('contest_id', $request->id)->latest()->paginate(6);

        return Eventmie::view($view, compact('listContestVideoByContestId'));
    }

    public function addVideo($view = 'eventmie::contestvideo.add', $extra = []){
        $listcontest = $this->contest::all();
        return Eventmie::view($view, compact('listcontest'));
    }

    public function storeVideo(Request $request, $extra = []){
        $this->contestvideo->create([
            'contest_id' => $request->contest_id,
            'customer_id' => $request->customer_id,
            'title' =>$request->title,
            'description' => $request->description,
            'link_video' =>$request->link_video
        ]);
        return redirect('/contest/video?id='.$request->contest_id);
    }

    public function detail(Request $request, $view = 'eventmie::contestvideo.detail', $extra = []){
        $videotItem=$this->contestvideo->find($request->video);
        return Eventmie::view($view, compact('videotItem'));
    }
}
