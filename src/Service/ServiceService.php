<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Service;

class ServiceService
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Pobiera listę dostępnych usług InPost.
     *
     * @return Service[]
     * @throws InpostApiException
     */
    public function getServices(): array
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/services');
            $data = json_decode($response->getBody()->getContents(), true);
            $items = $data['items'] ?? [];

            return array_map(fn($item) => new Service($item), $items);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch services: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Pobiera szczegóły konkretnej usługi po jej ID.
     *
     * @param string $serviceId
     * @return Service
     * @throws InpostApiException
     */
    public function getService(string $serviceId): Service
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/services/' . $serviceId);
            $data = json_decode($response->getBody()->getContents(), true);
            return new Service($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch service: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
