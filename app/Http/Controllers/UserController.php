<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Gate;
use App\ActivityLog;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(auth()->user()->is_admin == 0) {
            if(Gate::allows('is_account_active')) {
                auth()->logout();	
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }
    
            $user = strtoupper(auth()->user()->full_name);
            if(!Gate::allows('has_member_paid')) {
                \Session::flash('error',"Sorry $user, you are required to subscribe for a platform before proceeding. Thank you!");
                return redirect(route('packageSub'));
            }

            $data['menu_id'] = 2;
            $data['profile'] = User::userProfile();
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->get();

            return view('members.profile.index')->with($data);
        }
            
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5;
            $data['members'] = User::all()->except(1);

            return view('admin.members.index')->with($data);
        }
    }

    public function getEditInfo(Request $request)
    {
        try {
            $params['packagetype'] = User::find($request->user_id, 'slug');
            return view('admin.users.partials._users_details_')->with($params);
        } catch (Exception $e) {
            return false;
        }
    }


    public function activate(Request $request)
    {
        $data = $request->except('_token');
        try {
            $user = User::find($data['member_id'],'slug');
            $user->is_active = true;
            $user->save();
            
            activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Activated Member Account");
                
            return response()->json([
                "msg"   => "Account activated successfully!"
            ],200);
        } catch(Exception $e) {
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5;
            $data['profile'] = User::find($slug,'slug');
            $data['activities'] = ActivityLog::where('user_id',$data['profile']->id)->orderBy('id','desc')->get();

            return view('admin.members.show')->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
