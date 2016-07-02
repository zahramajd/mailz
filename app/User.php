<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use App\Mail;

/**
 * User
 * The User Model
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property string name
 * @property string email
 * @property string mobile
 * @property string password
 * @property mixed login1
 * @property mixed login2
 *
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['login1', 'login2'];

    protected $appends = ['last_login'];

    public function inbox()
    {
        return $this->hasMany('App\Mail', 'to_id');
    }


    public function sent()
    {
        return $this->hasMany('App\Mail', 'from_id');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\User', null, 'friend_ids', 'contact_ids');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', null, 'contact_ids', 'friend_ids');
    }

    public function getAvatarAttribute($attr)
    {
        $p = 'upload/avatar/' . $this->id . '.png';
        if (file_exists($p))
            return url($p);
        else
            return '//www.gravatar.com/avatar/' . md5($this->email) . '?d=retro';
    }

    public function getBackgroundAttribute($attr)
    {
        $p = 'upload/background/' . $this->id . '.png';
        if (file_exists($p))
            return url($p);
        return null;
    }

    static function get_time_ago ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }

    public function getLastLoginAttribute()
    {
        /** @var Carbon $d */
        $d = null;

        if ($this->login2!=null)
            $d = $this->login2;
        else if ($this->login1!=null)
            $d = $this->login1;

        return $d ?User::get_time_ago($d->getTimestamp()): '';
    }

    public function getNickAttribute($attr)
    {
        if ($attr)
            return $attr;
        else {
            $e = explode(' ', $this->name);
            if (count($e) > 0)
                return str_replace('_', ' ', $e[0]);
            else
                return null;
        }
    }
}