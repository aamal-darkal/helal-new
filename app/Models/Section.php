<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;
    public $fillable = ['type',  'image_id'  ,'created_by' , 'updated_by'];


    function sectionDetails(){
        return $this->hasMany(SectionDetail::class);
    }

    function sectionDetail_ar(){
        return $this->hasOne(SectionDetail::class)->where('lang' , 'ar');
    }

    function sectionDetail_en(){
        return $this->hasOne(SectionDetail::class)->where('lang', 'en');
    }
    function image(){
        return $this->belongsTo(Image::class);
    }
    
    function doings(){
        return $this->belongsToMany(Doing::class);
    }

    function provinces(){
        return $this->belongsToMany(Province::class);
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
