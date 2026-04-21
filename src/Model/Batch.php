<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Batch
{
    public string $id;
    public string $status;
    public ?string $name;
    public int $shipments_count;
    public array $shipments;
    public ?string $created_at;
    public ?string $updated_at;
    public array $details;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->name = $data['name'] ?? null;
        $this->shipments_count = $data['shipments_count'] ?? 0;
        $this->shipments = $data['shipments'] ?? [];
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
        $this->details = $data;
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
