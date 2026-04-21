<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\RaportCOD;

class RaportCODService
{
    private ClientInterface $httpClient;
    private ?string $organizationId;

    public function __construct(ClientInterface $httpClient, ?string $organizationId = null)
    {
        $this->httpClient = $httpClient;
        $this->organizationId = $organizationId;
    }

    /**
     * Pobiera raport COD (pobrania) dla organizacji w zadanym zakresie dat.
     *
     * @param string $startDate Data początkowa (format YYYY-MM-DD)
     * @param string $endDate Data końcowa (format YYYY-MM-DD)
     * @return RaportCOD
     * @throws InpostApiException
     */
    public function getRaportCOD(string $startDate, string $endDate): RaportCOD
    {
        try {
            $endpoint = "https://api-shipx-pl.easypack24.net/v1/organizations/{$this->organizationId}/reports/cod";
            $response = $this->httpClient->get($endpoint, [
                'query' => [
                    'format' => 'csv',
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return new RaportCOD($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch COD report: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
