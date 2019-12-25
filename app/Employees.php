<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table='employees';
    protected $primaryKey='id';
    protected $fillable=['First_name','last_name','Company_id','email','phone'];


    public function companies(){
        return $this->belongsTo(Companies::class,'Company_id','id');
    }
}
