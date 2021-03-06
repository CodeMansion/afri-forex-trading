<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;
use App\Subscription;
use App\Referral;
use App\Investment;
use Gate;

class PlatformController extends Controller
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

            $params['menu_id'] = 3;
            $params['subscription'] = Subscription::userSubscriptions()->first();
            $params['investment'] = Investment::userInvestments()->first();
            $params['referral'] = Referral::userReferrals()->first();

            return view('members.platforms.index')->with($params);
        }
        
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 2;
            $data['platforms'] = Platform::all();
            return view('admin.platforms.index')->with($data);
        }
    }


    public function getEditInfo(Request $request)
    {
        try {
            $params['platform'] = Platform::find($request->platform_id,'slug');
            return view('admin.platforms.partials._platforms_details_')->with($params);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if(isset($data) && $data['req'] == 'add_platform') {
            \DB::beginTransaction();
            try {
                    Platform::insert([
                            'slug' => bin2hex(random_bytes(64)),
                            'name' => $data['name'],
                            'price' => ($data['price']) ? $data['price'] : "",
                            'recycle_price' => ($data['recycle_price']) ? $data['recycle_price'] : "",
                            'is_multiple' => $data['is_multiple'],
                    ]);
                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Added Platform");
                \DB::commit();
                return $response = [
                    'msg' => "Platform Addedd Successfully.",
                    'type' => "true"
                ];

            } catch(Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $params['platform'] = Platform::where('slug',$id)->first();
        if($params['platform']->is_multiple == 0){            
            $params['subscriptions'] = Subscription::all();
            $params['referrals']  = Referral::all();
        }else{
            $params['investments'] = Investment::all();
        }
        return view('admin.platforms.show')->with($params);
    }
    
    public function activate($id)
    {
        \DB::beginTransaction();
            try {
                $platform = Platform::find($id);
                if($platform->is_active == 1){
                    $platform->is_active = 0;
                    $platform->save();
                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "De-Activate Platform");
                    \DB::commit();
                    return $response = [
                        'msg' => "Platform De-activated Successfully.",
                        'type' => "true"
                    ];
                }else{
                    $platform->is_active = 1;
                    $platform->save();
                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Activate Platform");
                    \DB::commit();
                    return $response = [
                        'msg' => "Platform Activated Successfully.",
                        'type' => "true"
                    ];
                }

            } catch(\Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token');
        if(isset($data) && $data['req'] == 'update_platform') {
            \DB::beginTransaction();
            try {
                $platform = Platform::find($data['platform_id'],'slug');
                $platform->name = $data['name'];
                $platform->is_multiple = $data['is_multiple'];
                $platform->price = ($data['price']) ? $data['price'] : "";
                $platform->recycle_price = ($data['recycle_price']) ? $data['recycle_price'] : "";
                $platform->save();

                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Update Platform");

                \DB::commit();
                return $response = [
                    'msg' => "Platform Updated Successfully.",
                    'type' => "true"
                ];

            } catch(\Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = $request->except('_token');
        if($data) {
            if($data['req'] == 'platform_delete') {
                try {
                    $platform = Platform::find($id,'slug');
                    $platform->delete();

                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id,$ip,"Delete Platform");

                    return $response = [
                        'msg' => 'Deleted successfully',
                        'type' => 'true'
                    ];

                } catch(\Exception $e) {
                    return $response = [
                        'msg' => "Internal Server Error",
                        'type' => "false"
                    ];
                }
            }
        }
    }
}
