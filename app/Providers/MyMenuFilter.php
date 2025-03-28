<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;


class MyMenuFilter implements FilterInterface
{
    public function transform($item)
    {
       if(isset($item['role'])){
        $user = Auth::user();
        /** @disregard P1013 Undefined method*/
        if(!$user->hasAnyRole($item['role']))
            $item['restricted'] = true;
       }

        return $item;
    }
}