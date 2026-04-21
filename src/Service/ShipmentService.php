<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Shipment; 
use maniek431\Inpost_Integration_Api_Rest\Model\Batch;



class ShipmentService
{
    private ClientInterface $httpClient;
    private ?string $organizationId;

    public function __construct(ClientInterface $httpClient, ?string $organizationId = null)
    {
        $this->httpClient = $httpClient;
        $this->organizationId = $organizationId;
    }

    /**
     * Tworzy przesyłkę (bezpośrednio lub na podstawie wybranej oferty)
     *
     * @param array $shipmentData
     * @return Shipment
     * @throws InpostApiException
     */
    public function createShipment(array $shipmentData): Shipment
    {
        try {
            
            $endpoint = $this->organizationId ? "/v1/organizations/{$this->organizationId}/shipments" : '/v1/shipments';
            
            $response = $this->httpClient->post($endpoint, [
                'json' => $shipmentData,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return new Shipment($data);

        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to create shipment: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     *
     * @param array $shipmentData
     * @return array
     * @throws InpostApiException
     */
    public function getOffers(array $shipmentData): array
    {
        try {
            $endpoint = $this->organizationId ? "/v1/organizations/{$this->organizationId}/offers" : '/v1/offers';

            $response = $this->httpClient->post($endpoint, [
                'json' => $shipmentData,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to get offers: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $shipmentId ID przesyłki
     * @return Shipment
     * @throws InpostApiException
     */
    public function getShipments(string $shipmentId): Shipment
    {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/shipments/' . $shipmentId);
            $data = json_decode($response->getBody()->getContents(), true);
            return new Shipment($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to get shipment: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Tworzy wiele przesyłek w trybie wsadowym (Batch)
     *
     * @param array $shipmentsData Tablica przesyłek (zgodna ze strukturą pojedynczej przesyłki)
     * @return Batch
     * @throws InpostApiException
     */
    public function createBatch(array $shipmentsData): Batch
    {
        try {
            $endpoint = "https://api-shipx-pl.easypack24.net/v1/organizations/{$this->organizationId}/batches";
            
            $response = $this->httpClient->post($endpoint, [
                'json' => ['shipments' => $shipmentsData],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return new Batch($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to create batch: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Pobiera szczegóły i status operacji wsadowej
     *
     * @param string $batchId
     * @return Batch
     * @throws InpostApiException
     */
    public function getBatch(string $batchId): Batch
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/batches/' . $batchId);
            $data = json_decode($response->getBody()->getContents(), true);
            return new Batch($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to get batch: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
