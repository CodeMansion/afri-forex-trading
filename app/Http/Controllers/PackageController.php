<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Platform;
use Gate;

class PackageController extends Controller
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

        $user = strtoupper(auth()->user()->full_name);
        if(Gate::allows('has_member_paid')) {
            \Session::flash('error',"Sorry $user, you are required to subscribe for a platform before proceeding. Thank you!");
            return redirect(route('packageSub'));
        }
            
        $data['packages'] = Package::all();
        $data['platforms'] = Platform::whereIsActive(true)->get();
        return view('admin.packages.index')->with($data);
    }


    public function getEditInfo(Request $request)
    {
        try {
            $params['package'] = Package::find($request->package_id, 'slug');
            $params['platforms'] = Platform::whereIsActive(true)->get();
            return view('admin.packages.partials._packages_details_')->with($params);
        } catch (Exception $e) {
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
        $data = $request->except('_token');
        if (isset($data) && $data['req'] == 'add_package') {
            \DB::beginTransaction();
            try {
                Package::insert([
                    'slug' => bin2hex(random_bytes(64)),
                    'platform_id' => $data['platform_id'],
                    'name' => $data['name'],
                    'investment_amount' => $data['investment_amount'],
                    'monthly_charge' => $data['monthly_charge'],
                ]);
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Added Package");
                \DB::commit();
                return $response = [
                    'msg' => "Package Addedd Successfully.",
                    'type' => "true"
                ];

            } catch (Exception $e) {
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
        //
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
    public function update(Request $request)
    {
        $data = $request->except('_token');
        if (isset($data) && $data['req'] == 'update_package') {
            \DB::beginTransaction();
            try {
                $package = Package::find($data['package_id'], 'slug');
                $package->name = $data['name'];
                $package->platform_id = $data['platform_id'];
                $package->investment_amount = $data['investment_amount'];
                $package->monthly_charge = $data['monthly_charge'];
                $package->save();
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Update Package");
                \DB::commit();
                return $response = [
                    'msg' => "Package Updated Successfully.",
                    'type' => "true"
                ];

            } catch (Exception $e) {
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
    public function destroy(Request $request, $id)
    {
        $data = $request->except('_token');
        if ($data) {
            if ($data['req'] == 'package_delete') {
                try {
                    $package = Package::find($id, 'slug');
                    $package->delete();

                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Delete Package");

                    return $response = [
                        'msg' => 'Deleted successfully',
                        'type' => 'true'
                    ];

                } catch (Exception $e) {
                    return $response = [
                        'msg' => "Internal Server Error",
                        'type' => "false"
                    ];
                }
            }
        }
    }
}
