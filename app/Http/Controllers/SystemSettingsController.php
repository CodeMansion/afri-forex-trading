<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MailSetting;
use App\GeneralSetting;

class SystemSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Mailindex()
    {
        $data['menu_id'] = 9.0;
        $data['mailing'] = MailSetting::find(1);

        return view('admin.settings.mail_settings.index')->with($data);
    }

    public function generalSettingsIndex()
    {
        $data['menu_id'] = 9.0;
        $data['settings'] = GeneralSetting::find(1);

        return view('admin.settings.general_settings.index')->with($data);
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
        if(!empty($data)) {
            try {
                
                $update = MailSetting::find(1);
                $update->host = $data['host'];
                $update->password = $data['password'];
                $update->username = $data['username'];
                $update->port = $data['port'];
                $update->encryption = $data['encryption'];
                $update->from_name = $data['sender_name'];
                $update->from_email = $data['sender_email'];
                $update->reply_to = $data['reply_to'];
                $update->save();

                return response()->json([
                    'msg'   => "Mail Settings Updated Successfully",
                    'type'  => "true"
                ], 200);

            } catch(Exception $e) {
                return false;
            }
        }
    }

    public function storeGeneralSettings(Request $request)
    {
        $data = $request->except('_token');
        if(!empty($data)) {
            try {
                
                $update = GeneralSetting::find(1);
                $update->application_name = $data['application_name'];
                $update->motto = $data['motto'];
                $update->description = $data['description'];
                $update->enable_sound_notification = ($data['sound_notification'] == 'true') ? true : false;
                $update->enable_push_notification = ($data['push_notification'] == 'true') ? true : false;
                $update->enable_session_timeout = ($data['session_timeout'] == 'true') ? true : false;
                $update->enable_login_email_alert = ($data['login_alert'] == 'true') ? true : false;
                $update->currency_exchange_api = $data['exchange_api'];
                $update->default_currency = $data['currency'];
                $update->enable_system_backup = ($data['system_backup'] == 'true') ? true : false;
                $update->save();



                return response()->json([
                    'msg'   => "General Settings Updated Successfully",
                    'type'  => "true"
                ], 200);

            } catch(Exception $e) {
                return redirect()->back()->with('error', $e->getMessage);
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
