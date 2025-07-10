<?php

namespace App\Http\Controllers\Admin\EmailConfig;

use Illuminate\Http\Request;
use App\Models\EmailConfigration;
use App\Http\Controllers\Controller;

class EmailConfigrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    function index(){
        $emailOption = EmailConfigration::all()->first();
        // return $emailConfigrations;
        return view('admin.emailconfig.email-config',compact(('emailOption')));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sender_name'=>['required'],
            'mailer_name'=>['required'],
            'host_email'=>['required'],
            'mail_user_name'=>['required'],
            'mail_from_address'=>['required'],
            'smtp_password'=>['required'],
            'mail_port'=>['required'],
            'mail_encryption'=>['required'],
        ],[
            'sender_name.required' => 'Sender name is required.',
            'mailer_name.required' => 'Mailer name is required.',
            'host_email.required' => 'Host email is required.',
            'mail_user_name.required' => 'Mail user name is required.',
            'mail_from_address.required' => 'Mail from address is required.',
            'smtp_password.required' => 'SMTP password is required.',
            'mail_port.required' => 'Mail port is required.',
            'mail_encryption.required' => 'Mail encryption is required.',
        ]);

        $emailConfig = EmailConfigration::findOrFail($id);
        $emailConfig->update([
            'sender_name' => $request->sender_name,
            'mailer_name' => $request->mailer_name,
            'host_email' => $request->host_email,
            'mail_user_name' => $request->mail_user_name,
            'mail_from_address' => $request->mail_from_address,
            'mail_password' => $request->smtp_password,
            'mail_port' => $request->mail_port,
            'mail_encryption' => $request->mail_encryption,
        ]);

        $message='Email configuration updated successfully.';
        return redirect()->back()->with( ['message'=>$message,'alert-type'=> 'success']);
    }
}
