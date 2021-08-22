<?php

namespace App\Helpers;

use App\Models\LogActivity as ModelsLogActivity;

class LogActivity
{
    public static function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = request()->fullUrl();
    	$log['user_id'] = !auth()->check() ?: auth()->user()->id;
    	ModelsLogActivity::create($log);
    }
}