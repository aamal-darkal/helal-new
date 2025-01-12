<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doing extends Model
{
    use HasFactory;
    public $fillable = ['title_ar', 'title_en', 'icon' , 'updated_by' ];

    function Keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }

    function sections()
    {
        return $this->belongsToMany(section::class);
    }

    function menu(){
        return $this->belongsTo(Menu::class);
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

