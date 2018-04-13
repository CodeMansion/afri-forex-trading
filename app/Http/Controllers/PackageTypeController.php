<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageType;

class PackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['packagetypes'] = PackageType::all();
        return view('admin.packagetypes.index')->with($data);
    }

    public function getEditInfo(Request $request)
    {
        try {
            $params['packagetype'] = PackageType::find($request->packagetype_id, 'slug');
            return view('admin.packagetypes.partials._packagetypes_details_')->with($params);
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
        if (isset($data) && $data['req'] == 'add_packagetype') {
            \DB::beginTransaction();
            try {
                PackageType::insert([
                    'slug' => bin2hex(random_bytes(64)),
                    'name' => $data['name'],
                    'percentage' => $data['percentage'],
                ]);
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Added Package Type");
                \DB::commit();
                return $response = [
                    'msg' => "Package Type Addedd Successfully.",
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
        if (isset($data) && $data['req'] == 'update_packagetype') {
            \DB::beginTransaction();
            try {
                $packagetype = PackageType::find($data['packagetype_id'], 'slug');
                $packagetype->name = $data['name'];
                $packagetype->percentage = $data['percentage'];
                $packagetype->save();
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Update Package Type");
                \DB::commit();
                return $response = [
                    'msg' => "Package Type Updated Successfully.",
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
            if ($data['req'] == 'packagetype_delete') {
                try {
                    $packagetype = PackageType::find($id, 'slug');
                    $packagetype->delete();

                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Delete Package Type");

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
