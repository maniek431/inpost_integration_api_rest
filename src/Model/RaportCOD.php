<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class RaportCOD
{
    public string $start_date;
    public string $end_date;
    public array $items;

    public function __construct(array $data)
    {
        $this->start_date = $data['start_date'] ?? '';
        $this->end_date = $data['end_date'] ?? '';
        $this->items = $data['items'] ?? [];
    }
}