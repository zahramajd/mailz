<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Mail
 * The Mail Model
 * @mixin \Eloquent
 *
 *
 * @property bool read
 */
class Mail extends Model{

    protected $with= ['to','from'];

    use SoftDeletes;

    public function to() {
        return $this->hasOne('App\User','_id','to_id');
    }

    public function from() {
        return $this->hasOne('App\User','_id','from_id');
    }
    
}