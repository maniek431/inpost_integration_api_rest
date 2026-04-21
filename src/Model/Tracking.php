<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Tracking
{
    public string $tracking_number;
    public string $status;
    public ?string $type;
    public ?string $service;
    public array $tracking_details;
    public array $custom_attributes; // This might be an object in API, but array is fine for now
    public ?string $expected_flow;
    public ?string $created_at;
    public ?string $updated_at;
    public array $details;

    public function __construct(array $data)
    {
        $this->tracking_number = $data['tracking_number'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->type = $data['type'] ?? null;
        $this->service = $data['service'] ?? null;
        $this->tracking_details = $data['tracking_details'] ?? [];
        $this->custom_attributes = $data['custom_attributes'] ?? [];
        $this->expected_flow = $data['expected_flow'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
        $this->details = $data;
    }
}
