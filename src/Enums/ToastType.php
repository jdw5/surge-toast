<?php

namespace Jdw5\SurgeToast\Enums;

enum ToastType: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case WARNING = 'warning';
    case INFO = 'info';
    case DEFAULT = 'default';
}