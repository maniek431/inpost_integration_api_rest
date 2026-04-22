<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class DispatchOrderPriceList
{

    public ?string $type;
    public ?int $total_success_count;
    public ?int $total_error_count;
    public ?string $total_price;
    public array $invalid_shipments; 
    public array $price_list; 

    public function __construct(array $data)
    {
        $this->type = $data['type'] ?? '';
        $this->total_success_count = $data['total_success_count'] ?? null;
        $this->total_error_count = $data['total_error_count'] ?? null;
        $this->total_price = $data['total_price'] ?? '';
        $this->invalid_shipments = $data['invalid_shipments'] ?? '';
        $this->price_list = $data['price_list'] ?? [];

    }
}