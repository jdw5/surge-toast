<?php

namespace Jdw5\SurgeToast;

use Jdw5\SurgeToast\Enums\ToastType;

class ToastData
{
    public function __construct(
        public ?string $type = ToastType::DEFAULT->value,
        public ?int $duration = 3000,
        public ?string $title,
        public ?string $message,
        public ?mixed $custom,
    )
    {}
}