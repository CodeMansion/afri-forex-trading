<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MailSetting;

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
