<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dispute;
use App\DisputePriority;
use App\DisputeReply;
use Gate;

class DisputeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5.0;
            $data['disputes'] = Dispute::all();
            $data['priorities'] = DisputePriority::all();
            $data['pending'] = Dispute::isPending();
            $data['resolved'] = Dispute::isResolved();
            $data['responded'] = Dispute::isResponded();

            return view('admin.disputes.index')->with($data);
        }

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

            $data['menu_id'] = 5.0;
            $data['disputes'] = Dispute::userDispute()->get();
            $data['priorities'] = DisputePriority::all();
            
            return view('members.support.index')->with($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDisputes(Request $request)
    {
        $data = $request->except('_token');
        $param['dispute'] = Dispute::find($data['dispute_id'],'slug');
        $data['priorities'] = DisputePriority::all();

        return view('admin.disputes.partials._get_details')->with($param);
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
        if($data) {
            try {
                $ticket = "#" . rand(1000,9999) . "-" . rand(1111,9999) . "-" . rand(3333,9999);
                
                $dispute = new Dispute();
                $dispute->user_id = \Auth::user()->id;
                $dispute->slug = bin2hex(random_bytes(64));
                $dispute->dispute_priority_id = $data['priority_id'];
                $dispute->title = $data['title'];
                $dispute->ticket_no = $ticket;
                $dispute->message = $data['message'];
                $dispute->save();

                //send notification to admin

                return response()->json([
                    "msg"  => "Dispute created successfully",
                    "type"  => "true"
                ]);

            } catch (Exception $e) {
                return response()->json([
                    "msg"  => $e->getMessage(),
                    "type"  => "false"
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
        if(auth()->user()->is_admin == 0) {
            $data['menu_id'] = 5.0;
            $data['dispute'] = Dispute::find($id,'slug');
            $data['priorities'] = DisputePriority::all();
            $data['replies'] = $data['dispute']->reply()->get();

            return view('members.support.view')->with($data);
        }
        
        $data['menu_id'] = 5.0;
        $data['dispute'] = Dispute::find($id,'slug');
        $data['priorities'] = DisputePriority::all();
        $data['replies'] = $data['dispute']->reply()->get();

        return view('admin.disputes.view')->with($data);
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
