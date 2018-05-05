<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MailSetting;
use App\SentMessage;
use Mail;
use Validator;

use App\Mail\BulkMail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_id'] = 3;
        $data['sentMessages'] = SentMessage::all();

        return view('admin.messaging.index')->with($data);

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

    protected function settingsCheck() {
        $setting = MailSetting::find(1);
        if(empty($setting['host']) || empty($setting['username']) || empty($setting['password'])) {
            return false;
        }

        return true;
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
        if($data) {
            try {

                if(!$this->settingsCheck()) {
                    return response()->json([
                        'msg'  => "Invalid Mail Settings",
                        'type' => "false"
                    ]);
                }

                if($data['type'] == 'individuals') {
                    $filter_email_address = [];
                    $recipients = explode(';', $data['to']);
                    
                    foreach($recipients as $recipient) {
                        if(filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                            array_push($filter_email_address, $recipient);
                        } else {
                            return response()->json([
                                "msg"   => "Invalid email address $recipient",
                                "type"  => "false"
                            ]);
                        }
                    }

                    foreach($filter_email_address as $key => $email) {
                        Mail::to($email)->send(new BulkMail($data));
                    }

                    $new = new SentMessage();
                    $new->slug = bin2hex(random_bytes(64));
                    $new->subject = $data['subject'];
                    $new->message = htmlspecialchars_decode($data['message']);
                    $new->type = "Individuals";
                    $new->save();
                }

                if($data['type'] == 'ds_members') {
                    return response()->json([
                        "msg"   => "This feature is not ready",
                        "type"  => "false"
                    ]);
                }

                if($data['type'] == 'all_members') {
                    return response()->json([
                        "msg"   => "This feature is not ready",
                        "type"  => "false"
                    ]);
                }

                return response()->json([
                    "msg"   => "Message Sent Successfully",
                    "type"  => "true"
                ],200);

            } catch (Exception $e) {
                return response()->json([
                    "msg"   => $e->getMessage(),
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
