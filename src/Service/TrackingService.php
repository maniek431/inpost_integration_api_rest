<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Tracking;

class TrackingService
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Pobiera historię i aktualny status przesyłki na podstawie numeru trackingowego.
     *
     * @param string $trackingNumber
     * @return Tracking
     * @throws InpostApiException
     */
    public function getTracking(string $trackingNumber): Tracking
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/tracking/' . $trackingNumber);
            $data = json_decode($response->getBody()->getContents(), true);
            return new Tracking($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch tracking: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
