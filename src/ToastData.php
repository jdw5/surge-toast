<?php

namespace Jdw5\SurgeToast;

use Jdw5\SurgeToast\Enums\ToastType;
use Serializable;

class ToastData implements Serializable
{
    public function __construct(
        public string $message,
        public ?string $type = ToastType::DEFAULT->value,
        public ?int $duration = 3000,
        public ?string $title,
        public ?mixed $custom,
    ) {}

    public function setType(ToastType|string $type): self
    {
        $this->type = $type instanceof ToastType ? $type->value : $type;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'duration' => $this->duration,
            'title' => $this->title,
            'message' => $this->message,
            'custom' => $this->custom,
        ];
    }

    public function serialize(): string
    {
        return serialize([
            'type' => $this->type,
            'duration' => $this->duration,
            'title' => $this->title,
            'message' => $this->message,
            'custom' => $this->custom,
        ]);
    }

    public function unserialize($serialized): void
    {
        $data = unserialize($serialized);
        $this->type = $data['type'];
        $this->duration = $data['duration'];
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->custom = $data['custom'];
    }
}