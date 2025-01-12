<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    public $fillable = ['name', 'type', 'description' ,'created_by'];    
    
    
    function createdBy(){
        return $this->belongsTo(User::class , 'created_by' );
    }
}
