<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $fillable = ['title_ar', 'title_en', 'order' ,'url', 'menu_id', 'section_id'];

    function subMenus(){
        return $this->hasMany(Menu::class);
    }
    function parentMenu(){
        return $this->belongsTo(Menu::class , 'menu_id' );
    }

    function doing(){
        return $this->hasOne(Doing::class);
    }
    function province(){
        return $this->hasOne(Province::class);
    }

}
