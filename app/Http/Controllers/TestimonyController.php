<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Testimony;
use App\Notifications\NewTestimony;
use App\User;

use Gate;
use DB;
use Session;
use Notification;
use Carbon\Carbon;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_admin == 0) {
            if (Gate::allows('is_account_active')) {
                auth()->logout();
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }

            $user = strtoupper(auth()->user()->full_name);
            if (!Gate::allows('has_member_paid')) {
                \Session::flash('error', "Sorry $user, you are required to subscribe for a platform before proceeding. Thank you!");
                return redirect(route('packageSub'));
            }

            $params['menu_id'] = 7;
            $params['testimonies'] = Testimony::memberTestimonies()->orderBy('id','DESC')->get();

            return view('members.testimony.index')->with($params);
        }

        if (\Auth::user()->is_admin) {
            $data['menu_id'] = 11;
            $data['testimonies'] = Testimony::orderBy('id','DESC')->get();

            return view('admin.testimony.index')->with($data);
        }
    }


    public function getEditInfo(Request $request)
    {
        try {
            $params['testimony'] = Testimony::find($request->testimony_id, 'slug');
            return view('members.testimony.partials._testimony_details_')->with($params);
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
        $data = $request->except("_token");
        if ($data) {
            DB::beginTransaction();
            try {

                $new_testmony = Testimony::insert([
                    'user_id'   => auth()->user()->id,
                    'slug'      => bin2hex(random_bytes(64)),
                    'title'     => $data['title'],
                    'message'   => $data['message'],
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);
                
                $admin = User::find(1);
                Notification::send($admin, new NewTestimony($new_testmony));
                
                DB::commit();

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Submitted New Testimony");
                return response()->json([
                    "msg" => "Testimony created successfully",
                    "type" => "true"
                ],200);

            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "msg" => $e->getMessage(),
                    "type" => "false"
                ]);
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
        
    }

    public function approve($id)
    {
        \DB::beginTransaction();
        try {
            $testimony = Testimony::find($id);
            $testimony->status = 1;
            $testimony->save();
            
            \DB::commit();

            activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Approved Member Testimony");
            return response()->json([
                'msg' => "Testimony Approved Successfully.",
                'type' => "true"
            ],200);            

        } catch (Exception $e) {
            \DB::rollback();
            return response()->json([
                "msg" => $e->getMessage(),
                "type" => "false"
            ]);
        }
    }

    public function decline($id)
    {
        \DB::beginTransaction();
        try {
            $testimony = Testimony::find($id);
            $testimony->status = 2;
            $testimony->save();

            \DB::commit();

            activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Declined Member Testimony");
            return response()->json([
                'msg' => "Testimony Delined Successfully.",
                'type' => "true"
            ],200);            

        } catch (Exception $e) {
            \DB::rollback();
            return response()->json([
                "msg" => $e->getMessage(),
                "type" => "false"
            ]);
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
    public function update(Request $request)
    {
        $data = $request->except("_token");
        if ($data) {
            try {
                $testimony = Testimony::find($data['id'], 'slug');
                $testimony->title = $data['title'];
                $testimony->message = $data['message'];
                $testimony->save();

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Updated a Testimony");
                return response()->json([
                    "msg" => "Testimony Updated successfully",
                    "type" => "true"
                ],200);

            } catch (Exception $e) {
                return response()->json([
                    "msg" => $e->getMessage(),
                    "type" => "false"
                ]);
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
        try {
            $testimony = Testimony::find($id, 'slug');
            $testimony->delete();

            $ip = $_SERVER['REMOTE_ADDR'];
            activity_logs(auth()->user()->id, $ip, "Delete Testimony");

            return response()->json([
                'msg' => 'Testimony Deleted successfully',
                'type' => 'true'
            ],200);

        } catch (Exception $e) {
            return response()->json([
                "msg" => $e->getMessage(),
                "type" => "false"
            ]);
        }
    }
}
