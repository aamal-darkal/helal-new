<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    public $fillable = ['word_ar' , 'word_en' , 'created_by'];

    function doings()
    {
        return $this->belongsToMany(Doing::class);
    }

    function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
