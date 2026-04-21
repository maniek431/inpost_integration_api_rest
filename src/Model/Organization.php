<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Organization
{
    public string $id;
    public string $name;
    public ?string $tax_id;
    public ?string $created_at;
    public ?string $updated_at;
    public array $details;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->tax_id = $data['tax_id'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
        $this->details = $data;
    }
}
