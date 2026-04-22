<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Service
{
    public string $id;
    public string $name;
    public ?string $description;
    public array $additional_services;


    


    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? null;

        $this->additional_services = $data['additional_services'] ?? [];
    }
}
