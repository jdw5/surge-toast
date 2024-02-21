<?php

declare(strict_types=1);

namespace Jdw5\SurgeToast;

use Jdw5\SurgeToast\Enums\ToastType;
use Serializable;

class ToastData implements Serializable
{
    const DEFAULT_DURATION = 3000;

    public function __construct(
        public ?string $message = '',
        public ?string $title = '',
        public mixed $more = null,
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
            more: $array['more'] ?? null,
        );
    }

    public function update(ToastData|array $data): self
    {
        if ($data instanceof self) {
            $data = $data->toArray();
        }

        return new self(
            message: $data['message'] ?? $this->message,
            type: $data['type'] ?? $this->type,
            duration: $data['duration'] ?? $this->duration,
            title: $data['title'] ?? $this->title,
            more: $data['more'] ?? $this->more,
        );
    }

    public function setType(ToastType|string $type): self
    {
        $this->type = $type instanceof ToastType ? $type->value : (in_array($type, ToastType::cases()) ? $type : ToastType::DEFAULT->value);
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function setmore(mixed $more): self
    {
        $this->more = $more;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'duration' => $this->duration,
            'title' => $this->title,
            'message' => $this->message,
            'more' => $this->more,
        ];
    }

    public function serialize(): string
    {
        return serialize([
            'type' => $this->type,
            'duration' => $this->duration,
            'title' => $this->title,
            'message' => $this->message,
            'more' => $this->more,
        ]);
    }

    public function unserialize(string $serialized): void
    {
        $data = unserialize($serialized);
        $this->type = $data['type'];
        $this->duration = $data['duration'];
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->more = $data['more'];
    }
}