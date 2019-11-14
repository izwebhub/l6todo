<?php

if (!function_exists('hca')) {

    function hca($created_at)
    {
        return '<i class="fa fa-clock-o"></i> ' . \Carbon\Carbon::createFromTimeStamp(strtotime($created_at))->diffForHumans();
    }
}

if (!function_exists('hs')) {

    function hs($s)
    {
        return $s == 1 ? '<label class="badge badge-success"><i class="fa fa-arrow-up"></i> ACTIVE</label>' : '<label class="badge badge-danger"><i class="fa fa-arrow-down"></i> BLOCKED</label>';
    }
}

if(!function_exists('ts')) {

    function ts($s) {
        return $s == 'IN_PROGRESS' 
        ? '<label class="badge badge-primary"><i class="fa fa-clock"></i> ' . $s . '</label>'
        : '<label class="badge badge-warning"><i class="fa fa-check-double"></i> ' . $s . '</label>';
    }

}

if (!function_exists('getCat')) {

    function getCat($c)
    {
        $check = \App\Category::where('id', $c)->count();
        if($check == 0) {
            return "-";
        }else {
            return '<label class="badge badge-success"><i class="fa fa-list"></i> '.  
            \App\Category::find($c)->name . '</label>';
        }
    }
}

