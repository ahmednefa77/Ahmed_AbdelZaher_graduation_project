<?php
//***************تظبيت الميل Verification Email + Reset password reset Email
namespace App;


use App\Mail\Mailresetpassword;
use App\Mail\Mailverificationtouser;
use Auth\Notifications\CustomNotification;
use http\Env\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','blocked','email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'remember_token',
    ];

    public function profile()
    {
        return$this->hasOne('App\Models\Profile',"user_id","id");
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendEmailVerificationNotification()
    {
       $verificationUrl=URL::temporarySignedRoute(
           'verification.verify',
           Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
           [
               'id' => $this->getKey(),
               'hash' => sha1($this->getEmailForVerification()),
           ]
       );

        /*$this->notify(new \App\Notifications\CustomNotification);*/
           Mail::to($this->getEmailForVerification())->send(new Mailverificationtouser($verificationUrl));

    }
    //////PassWord Reset send this Mail
    public function sendPasswordResetNotification($token)
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        /*$this->notify(new \App\Notifications\CustomNotification);*/
        Mail::to($this->getEmailForVerification())->send(new Mailresetpassword($url));

    }

    /////////////////////////////////////

}
