<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;
    public $fillable = ['name_ar' , 'name_en' ,'location_ar','location_en' , 'phone'];

    function sections(){
        return $this->belongsToMany(Section::class);
    }
    
    function users(){
        return $this->hasMany(User::class);
    }
    
    function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
