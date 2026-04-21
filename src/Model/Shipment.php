<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Shipment
{
    public const ADDITIONAL_SERVICE_WEEKEND_DELIVERY = 'weekend_delivery';

    public string $id;
    public string $status;
    public ?string $tracking_number;
    public ?string $return_tracking_number;
    public ?string $service;
    public ?string $reference;
    public bool $is_return;
    public ?int $application_id;
    public ?int $created_by_id;
    public ?string $external_customer_id;
    public bool $end_of_week_collection;
    public ?string $comments;
    public array|string|null $mpk; 
    public array $additional_services;
    public array $custom_attributes;
    public array $cod;
    public array $insurance;
    public array $sender;
    public array $receiver;
    public array $parcels;
    public ?string $created_at;
    public ?string $updated_at;
    public array $offers;
    public array $selected_offer;
    public array $transactions;
    public array $details; 

    
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->tracking_number = $data['tracking_number'] ?? null;
        $this->return_tracking_number = $data['return_tracking_number'] ?? null;
        $this->service = $data['service'] ?? null;
        $this->reference = $data['reference'] ?? null;
        $this->is_return = $data['is_return'] ?? false;
        $this->application_id = $data['application_id'] ?? null;
        $this->created_by_id = $data['created_by_id'] ?? null;
        $this->external_customer_id = $data['external_customer_id'] ?? null;
        $this->end_of_week_collection = $data['end_of_week_collection'] ?? false;
        $this->comments = $data['comments'] ?? null;
        $this->mpk = $data['mpk'] ?? null;
        $this->additional_services = $data['additional_services'] ?? [];
        $this->custom_attributes = $data['custom_attributes'] ?? [];
        $this->cod = $data['cod'] ?? [];
        $this->insurance = $data['insurance'] ?? [];
        $this->sender = $data['sender'] ?? [];
        $this->receiver = $data['receiver'] ?? [];
        $this->parcels = $data['parcels'] ?? [];
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
        $this->offers = $data['offers'] ?? [];
        $this->selected_offer = $data['selected_offer'] ?? [];
        $this->transactions = $data['transactions'] ?? [];
        $this->details = $data;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isWeekendDelivery(): bool
    {
        return $this->end_of_week_collection && in_array(self::ADDITIONAL_SERVICE_WEEKEND_DELIVERY, $this->additional_services);
    }
}
