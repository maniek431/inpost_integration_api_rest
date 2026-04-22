<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;

class DispatchOrderPriceListService
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**

     * @param array 
     * @return array 
     * @throws InpostApiException
     */
    public function getPriceList(array $filters = []): array
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/dispatch_order_price_lists', [
                'query' => $filters,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data['items'] ?? [];
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch dispatch order price list: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
