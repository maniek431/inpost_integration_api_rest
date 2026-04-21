<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class ShipmentPriceListItem
{
    public ?string $id;
    public string $service;
    public array $parcel_templates;
    public string $price;
    public string $currency;
    public array $details;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->service = $data['service'] ?? '';
        $this->parcel_templates = $data['parcel_templates'] ?? [];
        $this->price = $data['price'] ?? '0.00';
        $this->currency = $data['currency'] ?? 'PLN';
        $this->details = $data;
    }
}
