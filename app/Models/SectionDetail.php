<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionDetail extends Model
{
    public $timestamps = false;
    public $fillable = ['title',  'content', 'lang'];
    
}
