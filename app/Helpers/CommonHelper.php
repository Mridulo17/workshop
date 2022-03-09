<?php


namespace App\Helpers;


class CommonHelper
{
    public static function trackingNumber(string $model,array $parameters = null){
        $count = $model::query()
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->whereDay('created_at', date('d'))
            ->count();

        return $parameters['prefix'].'-'.date('Y').date('m').date('d').str_pad($count, 2, '0', STR_PAD_LEFT);
    }

    public static function findType($types,$type){
        foreach ($types as $key=>$value){
            if($key == $type){
                return $value;
                exit();
            }elseif(str_contains($value,$type)){
                return $key;
                exit();
            }
        }
    }

}
