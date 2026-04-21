<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Status
{
    public string $name;
    public string $title;
    public string $description;

    public function __construct(array $data)
    {

        $this->name = $data['name'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
    
    }
}