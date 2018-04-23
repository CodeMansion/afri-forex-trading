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
        if(Gate::allows('is_account_active')){
            auth()->logout();	
            \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
            return redirect('/login');
        }

        // $user = strtoupper(auth()->user()->full_name);
        // if(Gate::allows('has_member_paid')) {
        //     \Session::flash('error',"Hi, $user, you are required to subscribe for a platform before proceeding. Thank you!");
        //     return redirect(route('packageSub'));
        // }
            
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 1;
            $data['users'] = User::all();

            return view('admin.users.index')->with($data);
        }

        $data['menu_id'] = 2;
        $data['profile'] = User::userProfile();
        $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->get();

        return view('members.users.index')->with($data);
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


    public function activate($id)
    {
        \DB::beginTransaction();
            try {
                    $user = User::find($id);
                    if($user->is_active == 1){
                        $user->is_active = 0;
                        $user->save();
                        $ip = $_SERVER['REMOTE_ADDR'];
                        activity_logs(auth()->user()->id, $ip, "De-Activate User");
                        \DB::commit();
                        return response()->json([
                            'msg' => "User De-activated Successfully.",
                            'type' => "true"
                        ]);
                    }else{
                        $user->is_active = 1;
                        $user->save();
                        $ip = $_SERVER['REMOTE_ADDR'];
                        activity_logs(auth()->user()->id, $ip, "Activate User");
                        \DB::commit();
                        return $response = [
                            'msg' => "User Activated Successfully.",
                            'type' => "true"
                        ];
                    }

            } catch(Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
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
    public function show($id)
    {
        if(\Auth::user()->is_admin) {
            $data['users'] = User::all();
            return view('admin.users.show')->with($data);
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
