<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class MPK
{
    public string $id;
    public string $description;
    public ?string $name; // Name can be null
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
    }
}