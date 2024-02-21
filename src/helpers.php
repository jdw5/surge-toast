<?php

use Jdw5\SurgeToast\Toast;
use Jdw5\SurgeToast\ToastData;

if (!function_exists('toast')) {
    function toast(?ToastData $data = null)
    {
        $toast = app(Toast::class);
        

        if (!is_null($data)) {
            $toast->send($data);
        }

        return $toast;
    }
}