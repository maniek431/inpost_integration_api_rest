<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Service
{
    public string $id;
    public string $name;
    public ?string $description;
    public string $type;
    public array $additional_services;
    public array $custom_attributes;

    


    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? '';
        $this->parcel_templates = $data['parcel_templates'] ?? [];
        $this->additional_services = $data['additional_services'] ?? [];
        $this->details = $data;
    }
}
