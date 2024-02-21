<?php

declare(strict_types=1);

namespace Jdw5\SurgeToast;

use Illuminate\Contracts\Session\Session;
use Jdw5\SurgeToast\Enums\ToastType;

class Toast
{
    const FLASH_TO = 'toast';

    protected function __construct(
        protected Session $session
    ) {}

    public function send(ToastData $data): void
    {
        $this->session->flash(self::FLASH_TO, $data);
    }

    public function success(ToastData $data): void
    {
        $this->send($data->setType(ToastType::SUCCESS));
    }

    public function error(ToastData $data): void
    {
        $this->send($data->setType(ToastType::ERROR));
    }

    public function warn(ToastData $data): void
    {
        $this->send($data->setType(ToastType::WARNING));
    }

    public function info(ToastData $data): void
    {
        $this->send($data->setType(ToastType::INFO));
    }
}