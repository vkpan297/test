<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
// use Classiebit\Eventmie\Models\ContestVote;
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
        // $this->middleware('auth')->except(['login_first', 'signup_first']);

        $this->contestvideo        = new ContestVideo;
        $this->contest        = new Contest;
        // $this->contestvote        = new ContestVote;
        $this->event        = new Event;
        $this->user        = new User;
    }

    public function index(Request $request, $view = 'eventmie::contestvideo.show', $extra = []){
        if(isset($request->id)){
            $request->session()->put('paramVideo', 'id');
            $request->session()->put('id', $request->id);
            $event = '';
            $customer = 1;

            $listContestVideoByContestId = $this->contestvideo->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->select('contest_video.*','users.name', 'users.id as iduser')
            ->where('contest_id', $request->id)->latest()->paginate(6);

            $mysubmission = $this->contestvideo::where('contest_id', $request->id)->where('customer_id', Auth::id())->latest()->paginate(6);

            $voterank = $this->contestvideo->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->where('contest_id', $request->id)->orderBy('contest_video.vote_count', 'desc')->get();

            $counteachcontestsubmission =  $this->contestvideo::where('contest_id', $request->id)->where('customer_id', Auth::id())->latest()->paginate(6);
        }else if(isset($request->contest_id)){
            $request->session()->put('paramVideo', 'contest_id');
            $request->session()->put('contest_id', $request->contest_id);
            $event = $this->event->find($request->contest_id);

            $listContestVideoByContestId = $this->contestvideo->join('contest', 'contest_video.contest_id', '=', 'contest.id')
            ->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->select('contest_video.*','users.name', 'contest.id as idcontest', 'users.id as iduser')
            ->where('contest.event_id', '=', $request->contest_id)
            ->orderBy('contest_video.created_at', 'desc')
            ->paginate(6);

            $customer = 1;

            $counteachcontestsubmission = ['3','2'];

            $voterank = $this->contestvideo->join('contest', 'contest_video.contest_id', '=', 'contest.id')
            ->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->select('contest_video.*', 'contest.id as idcontest')
            ->where('contest.event_id', '=', $request->contest_id)
            ->orderBy('contest_video.vote_count', 'desc')->get();

            $mysubmission  = $this->contestvideo->join('contest', 'contest_video.contest_id', '=', 'contest.id')
            ->select('contest_video.*', 'contest.id as idcontest')
            ->where('contest.event_id', '=', $request->contest_id)
            ->where('contest_video.customer_id', Auth::id())
            ->orderBy('contest_video.created_at', 'desc')
            ->paginate(6);
        }else{
            $event = '';
            $mysubmission= [];
            $customer = 0;

            $counteachcontestsubmission = ['3','2'];
            $listContestVideoByContestId = $this->contestvideo
            ->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->select('contest_video.*','users.name', 'users.id as iduser')
            ->orderBy('contest_video.created_at', 'desc')
            ->paginate(6);

            $voterank = $this->contestvideo->join('users', 'contest_video.customer_id', '=', 'users.id')
            ->orderBy('contest_video.vote_count', 'desc')->get();
        }
        // return $listContestVideoByContestId;

        return Eventmie::view($view, compact('listContestVideoByContestId','event','mysubmission','customer','counteachcontestsubmission', 'voterank'));
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
        if(isset($request->poster)){
            $imageUrl = $this->storeImage($request);
            $this->contestvideo->create([
                'contest_id' => $request->contest_id,
                'customer_id' => $request->customer_id,
                'title' =>$request->title,
                'description' => $request->description ? $request->description : '',
                'poster' => $imageUrl,
                'link_video' =>$request->link_video,
                'video_type' => $request->video_type
            ]);
        }else{
            $this->contestvideo->create([
                'contest_id' => $request->contest_id,
                'customer_id' => $request->customer_id,
                'title' =>$request->title,
                'description' => $request->description ? $request->description : '',
                'poster' => NULL,
                'link_video' =>$request->link_video,
                'video_type' => $request->video_type
            ]);
        }

        return redirect('/contest/video?id='.$request->contest_id);
    }


    public function edit(Request $request, $view = 'eventmie::contestvideo.edit', $extra = []){
        $contestvideo = $this->contestvideo->find($request->video);

        $contest = $this->contest->find($contestvideo['contest_id']);
        return Eventmie::view($view, compact('contestvideo','contest'));
    }

    public function update(Request $request, $extra = []){
        $videotItem = $this->contestvideo->find($request->id);
        if(isset($request->poster)){
            // Xóa ảnh cũ (nếu có)
            Storage::delete('public/' . $videotItem->poster);
            $imageUrl = $this->storeImage($request);
            $videotItem->title = $request->title;
            $videotItem->description = $request->title;
            $videotItem->poster = $imageUrl;
            $videotItem->save();
        }else{
            $videotItem->title = $request->title;
            $videotItem->description = $request->title;
            $videotItem->save();
        }

        return redirect('/contest/video/detail?video='.$request->id);
    }

    public function detail(Request $request, $view = 'eventmie::contestvideo.detail', $extra = []){
        $videotItem=$this->contestvideo->find($request->video);
        $user = $this->user->find($videotItem->customer_id);
        return Eventmie::view($view, compact('videotItem','user'));
    }

    public function updateVode(Request $request, $view = 'eventmie::contestvideo.detail', $extra = []){
        // $videotItem = $this->contestvideo->find($request->id);

        // $videovote = $this->contestvote::where('contest_video_id', '=', $request->id)->where('customer_id', '=', Auth::id())->get();
        // $out = [];
        // if(count($videovote) >= 1){
        //     $out['status'] = false;
        //     $out['msg'] = "YOU HAVE ALREADY VOTED OUT OF THIS";
        //     $out['color'] = "red";
        // }else{
        //     $vote = $videotItem['vote_count'] += 1;
        //     $videotItem->vote_count = $vote;
        //     if($videotItem->save()){
        //         $params = [];
        //         $params['contest_video_id'] = $request->id;
        //         $params['customer_id'] = Auth::id();
        //         $this->contestvote->make_contest_vote($params);

        //         $out['status'] = true;
        //         $out['msg'] = "THANK YOU";
        //         $out['color'] = "#390";
        //     }else{
        //         $out['status'] = false;
        //         $out['msg'] = "SOME THING WENT WRONG";
        //         $out['color'] = "red";
        //     }
        // }

        // return json_encode($out);
    }

}
