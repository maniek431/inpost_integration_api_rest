<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class SendingMethod
{
    public string $id;
    public string $name;
    public ?string $description;
    public array $details;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? null;
        $this->details = $data;
    }
}