<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;

class DispatchOrderService
{
    private ClientInterface $httpClient;
    private ?string $organizationId;

    public function __construct(ClientInterface $httpClient, ?string $organizationId = null)
    {
        $this->httpClient = $httpClient;
        $this->organizationId = $organizationId;
    }

    /**
   
     * @param array
     * @return array
     * @throws InpostApiException
     */
    public function createDispatchOrder(array $data): array
    {
        try {
            $endpoint = "https://api-shipx-pl.easypack24.net/v1/organizations/{$this->organizationId}/dispatch_orders";
            $response = $this->httpClient->post($endpoint, [
                'json' => $data,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to create dispatch order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}