<?php
namespace App;

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
 *
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $fillable = ['name', 'email', 'password'];
    
    protected $hidden = ['password', 'remember_token'];


    public function inbox() {
        return $this->hasMany('App\Mail','to_id');
    }


    public function sent() {
        return $this->hasMany('App\Mail','from_id');
    }
    
    public function contacts() {
        return $this->belongsToMany('App\User',null,'friend_ids','contact_ids');
    }

    public function friends() {
        return $this->belongsToMany('App\User',null,'contact_ids','friend_ids');
    }

    public function getAvatarAttribute($attr)
    {
        $p='upload/avatar/'.$this->id.'.png';
        if (file_exists($p))
            return url($p);
        else
            return '//www.gravatar.com/avatar/' . md5($this->email) . '?d=retro';
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