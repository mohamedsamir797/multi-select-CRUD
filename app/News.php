<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes ;
    protected $fillable =['title','desc','user_id'];
    protected $date = 'delete_at';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
