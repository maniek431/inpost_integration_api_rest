<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Shipment; // For the constant

class WeekendDeliveryService
{
    private ClientInterface $httpClient;
    private ServiceService $serviceService;

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
            // Jeśli usługa nie istnieje lub wystąpił inny błąd API, zakładamy, że nie wspiera.
            return false;
        }
    }
}
