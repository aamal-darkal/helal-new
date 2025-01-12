<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xxxxx extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;
    public $fillable = [ 'title', 'content', 'hidden'  , 'image_id' , 'province_id' ,'created_by' , 'updated_by'];

    function image(){
        return $this->belongsTo(Image::class);
    }
        
    function province(){
        return $this->belongsTo(Province::class);
    }
    
    function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    function updatedBy(){
        return $this->belongsTo(User::class , 'updated_by');
    }
    
}
