<?php

namespace maniek431\Inpost_Integration_Api_Rest\Model;

class Point
{
    public string $name;
    public array $type;
    public string $status;
    public array $address;
    public array $location;
    public ?string $location_description;
    public ?string $location_description_1;
    public ?string $location_description_2;
    public ?float $distance;
    public string $opening_hours;
    public array $features;
    public array $functions;
    public ?int $partner_id;
    public bool $is_next;
    public bool $payment_available;
    public array $payment_type;
    public bool $virtual;
    public ?string $image_url;
    public ?string $location_type;
    public bool $easy_access_zone; // Indicates if the point has easy access
    public array $details; // Raw data from API
    public ?int $supported_locker_temperatures; // Can be null or 0 if not applicable
    public ?string $physical_type_description; // Can be null


    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->address = $data['address'] ?? [];
        $this->location = $data['location'] ?? [];
        $this->location_description = $data['location_description'] ?? null;
        $this->location_description_1 = $data['location_description_1'] ?? null;
        $this->location_description_2 = $data['location_description_2'] ?? null;
        $this->distance = isset($data['distance']) ? (float)$data['distance'] : null;
        $this->opening_hours = $data['opening_hours'] ?? [];
        $this->features = $data['features'] ?? [];
        $this->functions = $data['functions'] ?? [];
        $this->partner_id = $data['partner_id'] ?? null;
        $this->is_next = $data['is_next'] ?? false;
        $this->payment_available = $data['payment_available'] ?? false;
        $this->payment_type = $data['payment_type'] ?? [];
        $this->virtual = $data['virtual'] ?? false;
        $this->image_url = $data['image_url'] ?? null;
        $this->location_type = $data['location_type'] ?? null;
        $this->easy_access_zone = $data['easy_access_zone'] ?? false; // Default to false
        $this->details = $data;
        $this->supported_locker_temperatures = $data['supported_locker_temperatures'] ?? null; // Default to null
        $this->physical_type_description = $data['physical_type_description'] ?? null; // Default to null
    }

    public function getFullAddress(): string
    {
        $line1 = $this->address['line1'] ?? '';
        $line2 = $this->address['line2'] ?? '';
        return trim($line1 . ' ' . $line2);
    }

    public function getCity(): string
    {
        return $this->address['city'] ?? '';
    }

    public function getPostCode(): string
    {
        return $this->address['post_code'] ?? '';
    }

    public function getCoordinates(): array
    {
        return $this->location;
    }
}