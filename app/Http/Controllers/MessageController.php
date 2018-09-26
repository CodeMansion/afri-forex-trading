<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MailSetting;
use App\SentMessage;
use App\Subscription;
use App\User;
use App\Mail\BulkMail;

use Mail;
use DB;
use Validator;
use Carbon\Carbon;

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
        $data['signals'] = Subscription::subscriptionMembers()->get();

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

    protected function MailSettingCheck() {
        $setting = MailSetting::find(1);
        return (empty($setting['host']) || empty($setting['username']) || empty($setting['password']));
    }

    protected function SentMail($recipients,$data,$type) {
        foreach($recipients as $recipient) {
            Mail::to($recipient)->queue(new BulkMail($data));
        }

        $sent_msg = SentMessage::insert([
            'slug'      => bin2hex(random_bytes(64)),
            'subject'   => $data['subject'],
            'message'   => htmlspecialchars_decode($data['message']),
            'type'      => $type,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
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
            DB::beginTransaction();
            try {
                exec("php artisan queue:work --daemon --tries=3");
                ini_set('max_execution_time', 0);

                if($this->MailSettingCheck()) {
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
                            array_push($filter_email_address,$recipient);
                        } else {
                            return response()->json([
                                "msg"   => "Invalid email address $recipient",
                                "type"  => "false"
                            ]);
                        }
                    }
                    
                    try {
                        $this->SentMail($filter_email_address,$data,'Individuals');
                    } catch(\Exception $e) {
                        return response()->json([
                            "msg"   => "Please check your internet connection or mail settings",
                            "type"  => "false",
                            "head"  => "Cannot Send Message"
                        ]);
                    }
                }

                if($data['type'] == 'ds_members') {
                    $filter_email_address = [];
                    $subscribers = Subscription::subscriptionMembers()->get();

                    if(count($subscribers) > 0) {
                        foreach($subscribers as $recipient) {
                            if(filter_var($recipient->User->email, FILTER_VALIDATE_EMAIL)) {
                                array_push($filter_email_address,$recipient->User->email);
                            }
                        }

                        try {
                            $this->SentMail($filter_email_address,$data,'Subscribers');
                        } catch(\Exception $e) {
                            return response()->json([
                                "msg"   => "Please check your internet connection",
                                "type"  => "false",
                                "head"  => "Cannot Send Message"
                            ]);
                        }

                    } else {
                        return response()->json([
                            "msg"   => "We could not find any Daily Signal active member",
                            "type"  => "false",
                            "head"  => "No Subcribers Found"
                        ]);
                    }
                }

                if($data['type'] == 'all_members') {
                    $filter_email_address = [];
                    $all_members = User::members()->get();

                    foreach($all_members as $member) {
                        if(filter_var($member->email, FILTER_VALIDATE_EMAIL)) {
                            array_push($filter_email_address,$member->email);
                        }
                    }

                    try {
                        $this->SentMail($filter_email_address,$data,'All Members');
                    } catch(\Exception $e) {
                        return response()->json([
                            "msg"   => "Please check your internet connection",
                            "type"  => "false",
                            "head"  => "Cannot Send Message"
                        ]);
                    }
                }

                DB::commit();

                return response()->json([
                    "msg"   => "Message Sent Successfully",
                    "type"  => "true"
                ],200);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    "msg"   => $e->getMessage(),
                    "type"  => "false",
                    "head"  => "Please try again"
                ]);
            }
        }
    }
}
