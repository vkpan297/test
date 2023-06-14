<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use Redirect;
use File;
use Throwable;
use Facades\Classiebit\Eventmie\Eventmie;

use Classiebit\Eventmie\Models\ContestVideo;
use Classiebit\Eventmie\Models\Contest;
use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\User;


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
        $this->event        = new Event;
        $this->user        = new User;
    }

    public function index(Request $request, $view = 'eventmie::contestvideo.show', $extra = []){
        if(isset($request->id)){
            $event = '';
            $listContestVideoByContestId = $this->contestvideo::where('contest_id', $request->id)->latest()->paginate(6);
        }else if(isset($request->contest_id)){
            $event = $this->event->find($request->contest_id);
            $listContestVideoByContestId = $this->contestvideo->join('contest', 'contest_video.contest_id', '=', 'contest.id')->where('contest.event_id', '=' ,$request->contest_id)->orderBy('contest_video.created_at', 'desc')->paginate(6);
        }
        // return $listContestVideoByContestId;

        return Eventmie::view($view, compact('listContestVideoByContestId','event'));
    }

    public function addVideo($view = 'eventmie::contestvideo.add', $extra = []){
        $listcontest = $this->contest::all();
        return Eventmie::view($view, compact('listcontest'));
    }
    protected function storeImage(Request $request) {
        $path = $request->file('poster')->store('public/contest');
        return substr($path, strlen('public/'));
      }

    public function storeVideo(Request $request, $extra = []){

        $imageUrl = $this->storeImage($request);
        $this->contestvideo->create([
            'contest_id' => $request->contest_id,
            'customer_id' => $request->customer_id,
            'title' =>$request->title,
            'description' => $request->description,
            'poster' => $imageUrl,
            'link_video' =>$request->link_video,
            'video_type' => $request->video_type
        ]);
        return redirect('/contest/video?id='.$request->contest_id);
    }

    public function detail(Request $request, $view = 'eventmie::contestvideo.detail', $extra = []){
        $videotItem=$this->contestvideo->find($request->video);
        $user = $this->user->find($videotItem->customer_id);
        return Eventmie::view($view, compact('videotItem','user'));
    }

    public function updateVode(Request $request, $view = 'eventmie::contestvideo.detail', $extra = []){
        // $videotItem=$this->contestvideo->find($request->video);
        // $user = $this->user->find($videotItem->customer_id);
        // return Eventmie::view($view, compact('videotItem','user'));
    }

}
