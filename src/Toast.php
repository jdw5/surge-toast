<?php

declare(strict_types=1);

namespace Jdw5\SurgeToast;

use Illuminate\Contracts\Session\Session;
use Jdw5\SurgeToast\Enums\ToastType;

class Toast
{   
    const FLASH_TO = 'toast';

    private bool $sent = false;

    public function __construct(
        protected Session $session,
        protected ToastData $data = new ToastData()
    ) {}

    public function __destruct()
    {
        if (!$this->sent) {
            $this->flash();
        }
    }

    private final function flash()
    {
        $this->session->flash(self::FLASH_TO, $this->data);
        $this->sent = true;
    }

    private final function some_message(ToastData|array|string $data = null): void
    {
        if (is_null($data)) {}
        else if (is_string($data)) {
            $this->data->setMessage($data);
        } else {
            $this->data->update($data);
        }
    }

    public function send(ToastData|array $data): void
    {
        $this->data->update($data);
        $this->flash();
    }

    public function success(ToastData|array|string $data = null): self
    {
        $this->some_message($data, 'title');

        $this->data->setType(ToastType::SUCCESS);

        return $this;
    }

    public function error(ToastData|array|string $data): self
    {
        $this->some_message($data);        
        $this->data->setType(ToastType::ERROR);

        return $this;
    }

    public function warn(ToastData $data): self
    {
        $this->some_message($data);
        $this->data->setType(ToastType::WARNING);

        return $this;
    }

    public function info(ToastData $data): self
    {
        $this->some_message($data);
        $this->data->setType(ToastType::INFO);

        return $this;
    }

    public function title(string $title): self
    {
        $this->data->setTitle($title);
        return $this;
    }

    public function message(string $message): self
    {
        $this->data->setMessage($message);
        return $this;
    }

    public function duration(int $duration): self
    {
        $this->data->setDuration($duration);
        return $this;
    }

    public function more(mixed $more): self
    {
        $this->data->setMore($more);
        return $this;
    }
}