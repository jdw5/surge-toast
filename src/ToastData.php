<?php

declare(strict_types=1);

namespace Jdw5\SurgeToast;

use Jdw5\SurgeToast\Enums\ToastType;
use Serializable;

class ToastData implements Serializable
{
    const DEFAULT_DURATION = 3000;

    public function __construct(
        public string $message,
        public ?string $title,
        public ?mixed $custom,
        public ?string $type = ToastType::DEFAULT->value,
        public ?int $duration = self::DEFAULT_DURATION,
    ) {}

    public static function from(array $array) 
    {
        return new self(
            message: $array['message'],
            type: $array['type'] ?? ToastType::DEFAULT->value,
            duration: $array['duration'] ?? self::DEFAULT_DURATION,
            title: $array['title'] ?? null,
            custom: $array['custom'] ?? null,
        );
    }

    public function setType(ToastType|string $type): self
    {
        $this->type = $type instanceof ToastType ? $type->value : (in_array($type, ToastType::cases()) ? $type : ToastType::DEFAULT->value);
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

    public function unserialize(string $serialized): void
    {
        $data = unserialize($serialized);
        $this->type = $data['type'];
        $this->duration = $data['duration'];
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->custom = $data['custom'];
    }
}