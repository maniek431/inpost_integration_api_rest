<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\ShipmentPriceListItem;

class ShipmentPriceListService
{
    private ClientInterface $httpClient;
    private ?string $organizationId;

    public function __construct(ClientInterface $httpClient, ?string $organizationId = null)
    {
        $this->httpClient = $httpClient;
        $this->organizationId = $organizationId;
    }

    /**

     *
     * @param array 
     * @return ShipmentPriceListItem[]
     * @throws InpostApiException
     */
    public function calculate(array $shipmentsData): array
    {
        try {
            $endpoint = "https://api-shipx-pl.easypack24.net/v1/organizations/{$this->organizationId}/shipment_price_lists";
            $response = $this->httpClient->post($endpoint, [
                'json' => ['shipments' => $shipmentsData],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $items = $data['items'] ?? [];

            return array_map(fn($item) => new ShipmentPriceListItem($item), $items);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to calculate shipment prices: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
