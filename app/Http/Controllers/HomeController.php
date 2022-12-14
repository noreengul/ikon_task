<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $suggestion;
    private $sentRequest;
    private $receivedRequest;
    private $connections;

    private $user_id;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData(){

        $user_id = Auth::id();

        $this->suggestion = User::whereNotExists(function($query)
        {
            $query->select(DB::raw('id'))
                ->from('user_invitations')
                ->whereRaw('users.id = user_invitations.invited_to');
        })->where('id','<>',$user_id)->get();

        $this->sentRequest = User::whereExists(function($query)
        {
            $query->select(DB::raw('id'))
                ->from('user_invitations')
                ->whereRaw('users.id = user_invitations.invited_to')
                ->whereRaw('user_invitations.is_accepted = 0');
        })->where('id','<>',$user_id)->get();


        $this->receivedRequest = User::whereExists(function($query) use ($user_id)
        {
            $query->select(DB::raw('id'))
                ->from('user_invitations')
                ->whereRaw('users.id = user_invitations.user_id')
                ->whereRaw('user_invitations.invited_to ='.$user_id)
                ->whereRaw('user_invitations.is_accepted = 0');
        })->where('id','<>',$user_id)->get();

        $this->connections = User::whereExists(function($query)
        {
            $query->select(DB::raw('id'))
                ->from('user_invitations')
                ->whereRaw('users.id = user_invitations.invited_to')
                ->whereRaw('user_invitations.is_accepted = 1')
                ->orwhereRaw('users.id = user_invitations.user_id');

        })->where('id','<>',$user_id)->get();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->getData();
        $user_id=  Auth::user()->id;
        $users = $this->suggestion ;

        return view('home')->with([

            'counts'=>[
                'suggestion_count'      =>  $this->suggestion->where('id','<>',$user_id)->count(),
                'sent_count'            =>  $this->sentRequest->where('id','<>',$user_id)->count(),
                'received_count'        =>  $this->receivedRequest->where('id','<>',$user_id)->count(),
                'connections_count'     =>  $this->connections->where('id','<>',$user_id)->count()
            ],
            'users'                 =>  $users,
            'type'                  =>  'suggestions'
        ]);
    }

    public function getSuggestion(){

        $this->getData();
        $user_id = Auth::id();
        $users = $this->suggestion;

        $data = view('components.suggestion', compact('users','user_id'))->render();
        return response()->json([
            'success' => true,
            'data' => $data,
            'counts'=>[
                'suggestion_count'      =>  $this->suggestion->count(),
                'sent_count'            =>  $this->sentRequest->count(),
                'received_count'        =>  $this->receivedRequest->count(),
                'connections_count'     =>  $this->connections->count()
            ]
        ]);
    }

    public function getSentRequest(){

        $this->getData();
        $users = $this->sentRequest;
        $mode = 'sent';
        $user_id = Auth::id();

        $data = view('components.request', compact('users','mode','user_id'))->render();
        return response()->json([
            'success' => true,
            'data' => $data,
            'mode'=>'sent',
            'counts'=>[
                'suggestion_count'      =>  $this->suggestion->count(),
                'sent_count'            =>  $this->sentRequest->count(),
                'received_count'        =>  $this->receivedRequest->count(),
                'connections_count'     =>  $this->connections->count()
            ]
        ]);
    }

    public function getReceivedRequests(){

        $this->getData();
        $users = $this->receivedRequest;
        $mode = 'received';
        $user_id = Auth::id();

        $data = view('components.request', compact('users','mode','user_id'))->render();
        return response()->json([
            'success' => true,
            'data' => $data,
            'counts'=>[
                'suggestion_count'      =>  $this->suggestion->count(),
                'sent_count'            =>  $this->sentRequest->count(),
                'received_count'        =>  $this->receivedRequest->count(),
                'connections_count'     =>  $this->connections->count()
            ]
        ]);
    }

    public function getConnections(){

        $this->getData();
        $users = $this->connections;

        $data = view('components.connection', compact('users'))->render();
        return response()->json([
            'success' => true,
            'data' => $data,
            'counts'=>[
                'suggestion_count'      =>  $this->suggestion->count(),
                'sent_count'            =>  $this->sentRequest->count(),
                'received_count'        =>  $this->receivedRequest->count(),
                'connections_count'     =>  $this->connections->count()
            ]
        ]);

    }

    public function sendInvitation($id){

        $user_id = Auth::id();

        UserInvitation::insert([
            'invited_to'=>$id,
            'user_id'=>$user_id,
            'is_accepted'=>0,
        ]);

        return redirect('suggestions')->with('Connection Request Sent');
    }

    public function removeNetwork($id){

        $user_id = Auth::id();
        try {

            UserInvitation::where('invited_to',$id)->where('user_id',$user_id)->delete();
            return redirect('connections')->with('Network Removed Successfully');
        } catch (Throwable $e) {

            report($e);
            return false;
        }
    }

    public function acceptNetwork($id){

        try {

            UserInvitation::where('id',$id)->update(['is_accepted'=>1]);
            return redirect('received_requests')->with('Connection Request Sent');
        } catch (Throwable $e) {

            report($e);
            return false;
        }
    }

    public function withdrawNetwork($id){

        try {

            UserInvitation::where('user_id',Auth::id())->where('invited_to',$id)->delete();
            return redirect('sent_requests')->with('Connection Request Sent');
        } catch (Throwable $e) {

            report($e);
            return false;
        }
    }
}
