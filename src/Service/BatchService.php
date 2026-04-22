<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Batch;

class BatchService
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