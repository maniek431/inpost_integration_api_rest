<?php

namespace maniek431\Inpost_Integration_Api_Rest;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use maniek431\Inpost_Integration_Api_Rest\Service\ShipmentService;
use maniek431\Inpost_Integration_Api_Rest\Service\DispatchOrderPriceListService;
use maniek431\Inpost_Integration_Api_Rest\Service\ShipmentPriceListService;
use maniek431\Inpost_Integration_Api_Rest\Service\PointService;
use maniek431\Inpost_Integration_Api_Rest\Service\TrackingService;
use maniek431\Inpost_Integration_Api_Rest\Service\OrganizationService;
use maniek431\Inpost_Integration_Api_Rest\Service\ServiceService;
use maniek431\Inpost_Integration_Api_Rest\Service\SendingMethodService;
use maniek431\Inpost_Integration_Api_Rest\Service\WeekendDeliveryService;
use maniek431\Inpost_Integration_Api_Rest\Service\MPKService;
use maniek431\Inpost_Integration_Api_Rest\Service\StatusService;
use maniek431\Inpost_Integration_Api_Rest\Service\RaportCODService;

class InpostApi
{
    private ClientInterface $httpClient;
    private string $apiKey;
    private string $apiUrl;
    private ?string $organizationId;

    public function __construct(string $apiKey, ?string $organizationId = null, string $apiUrl = 'https://api-shipx-pl.inpost.pl', ?ClientInterface $httpClient = null)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->organizationId = $organizationId;
        $this->httpClient = $httpClient ?? new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey, 
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-requested-with' => 'XMLHttpRequest',
                'X-User-Agent-Version' => '1.0',
                'Accept-Language' => 'en-US,en;q=0.9',
            ],
        ]);
    }

    public function shipments(): ShipmentService
    {
        return new ShipmentService($this->httpClient, $this->organizationId);
    }

    public function points(): PointService
    {
        return new PointService($this->httpClient);
    }

    public function dispatchOrderPriceList(): DispatchOrderPriceListService
    {
        return new DispatchOrderPriceListService($this->httpClient);
    }

    public function tracking(): TrackingService
    {
        return new TrackingService($this->httpClient);
    }

    public function shipmentPriceList(): ShipmentPriceListService
    {
        return new ShipmentPriceListService($this->httpClient, $this->organizationId);
    }

    public function organizations(): OrganizationService
    {
        return new OrganizationService($this->httpClient);
    }

    public function sendingMethods(): SendingMethodService
    {
        return new SendingMethodService($this->httpClient);
    }

    public function services(): ServiceService
    {
        return new ServiceService($this->httpClient);
    }

    public function mpk(): MPKService
    {
        return new MPKService($this->httpClient, $this->organizationId);
    }

    public function weekendDelivery(): WeekendDeliveryService
    {
        return new WeekendDeliveryService($this->httpClient);
    }
    public function status(): StatusService
    {
        return new StatusService($this->httpClient);
    }
    public function raportcod(): RaportCODService
    {
        return new RaportCODService($this->httpClient, $this->organizationId);
    }


}
