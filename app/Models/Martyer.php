<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Martyer extends Model
{
    /** @use HasFactory<\Database\Factories\MartyerFactory> */
    use HasFactory;
    
    public $fillable = ['name_ar','name_en','DOD' , 'province_id'];

    function province(){
        return $this->belongsTo(Province::class);
    }    

    function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
