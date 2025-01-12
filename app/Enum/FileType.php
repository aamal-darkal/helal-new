<?php
namespace App\Enum;

enum FileType:string{
    
    case image = 'IMAGE';
    case pdf = 'PDF';
    case video = 'VIDEO';

    public static function getFileTypes(){
        return EnumHelper::getCases(self::cases());
    }
    public static function getAsArray(){
        return EnumHelper::getAsArray(self::cases());
    }
}