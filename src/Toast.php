<?php

namespace Jdw5\SurgeToast;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Session\Session;
use Jdw5\SurgeToast\Enums\ToastType;

class Toast
{
    use Macroable;
    // I want to be able to do toast(options) or toast()->type(options)

    protected function __construct(
        protected Session $session
    ) {}

    public function send(ToastData $data): void
    {
        $this->session->flash('toast', $data);
    }

    public function success(ToastData $data): void
    {
        $this->send($data->setType(ToastType::SUCCESS));
    }

    public function error(ToastData $data): void
    {
        $this->send($data->setType(ToastType::ERROR));
    }

    public function warning(ToastData $data): void
    {
        $this->send($data->setType(ToastType::WARNING));
    }

    public function info(ToastData $data): void
    {
        $this->send($data->setType(ToastType::INFO));
    }
}