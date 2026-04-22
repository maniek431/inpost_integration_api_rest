<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Shipment;

class WeekendDeliveryService
{
    private ClientInterface $httpClient;


    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->serviceService = new ServiceService($httpClient);
    }

    /**
     *
     * @param string 
     * @return bool 
     * @throws InpostApiException
     */
    public function isServiceWeekendDeliveryEnabled(string $serviceId): bool
    {
        try {
            $service = $this->serviceService->getService($serviceId);
            return in_array(Shipment::ADDITIONAL_SERVICE_WEEKEND_DELIVERY, $service->additional_services);
        } catch (InpostApiException $e) {
            
            return false;
        }
    }
}
