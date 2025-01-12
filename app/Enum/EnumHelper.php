<?php

namespace App\Enum;
/** get  name & value as id & name */
class EnumHelper
{
    public $id;
    public $name;

    public static function getCases($cases)
    {
        foreach ($cases as $case) {
            $enumObj = new EnumHelper();
            $enumObj->id = $case->value ;
            $enumObj->name = $case->name;

            $enumObjs[] = $enumObj;
        }
        return $enumObjs;
    }
    public static function getAsArray($cases)
    {
        foreach ($cases as $case) {            
            $enumArr[] = $case->value;
        }
        return $enumArr;
    }
}