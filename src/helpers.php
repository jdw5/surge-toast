<?php

use Jdw5\SurgeToast\Toast;
use Jdw5\SurgeToast\ToastData;

function toast(?ToastData $data = null): void
{
    $toast = app(Toast::class);

    if (!is_null($data)) {
        $toast->send($data);
    }

    return $toast;
}