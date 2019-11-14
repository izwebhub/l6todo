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
