<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class DispatchOrder
{
    public string $id;
    public string $status;
    public string $created_at;
    public string $updated_at;
    public array $address;
    public array $details;
    public array $shipments;
    public array $comment;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->address = $data['address'] ?? [];
        $this->details = $data['details'] ?? [];
        $this->shipments = $data['shipments'] ?? [];
        $this->comment = $data['comment'] ?? []; // This might be a string in API, but array is fine for now
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function hasErrors(): bool
    {
        return $this->status === 'error' || !empty($this->details['errors']);
    }
}
