<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public static function type(){
        return [
            'parts' => trans('product_part.parts'),
            'liquids' => trans('product_part.liquids'),
        ];
    }

    public static function parts(){
        return [
            'generic' => trans('product_part.generic'),
            'specific' => trans('product_part.specific'),
        ];
    }
}
