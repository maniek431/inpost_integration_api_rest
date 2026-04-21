<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\MPK;

class MPKService
{
    private ClientInterface $httpClient;
    private ?string $organizationId;

    public function __construct(ClientInterface $httpClient, ?string $organizationId = null)
    {
        $this->httpClient = $httpClient;
        $this->organizationId = $organizationId;
    }

    /**
     * Pobiera listę MPK dla organizacji.
     *
     * @return MPK[]
     * @throws InpostApiException
     */
    public function getMPKs(): array
    {
        try {
            $response = $this->httpClient->get("https://api-shipx-pl.easypack24.net/v1/organizations/{$this->organizationId}/mpks");
            $data = json_decode($response->getBody()->getContents(), true);
            $items = $data['items'] ?? [];

            return array_map(fn($item) => new MPK($item), $items);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch MPKs: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Pobiera szczegóły konkretnego MPK.
     * @param string $id
     * @return MPK
     * @throws InpostApiException
     */
    public function getMPK(string $id): MPK
    {
        try {
            $response = $this->httpClient->get("https://api-shipx-pl.easypack24.net/v1/mpks/{$id}");
            $data = json_decode($response->getBody()->getContents(), true);
            return new MPK($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch MPK: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Tworzy nowe MPK.
     *
     * @param array $data
     * @return MPK
     * @throws InpostApiException
     */
    public function createMPK(array $data): MPK
    {
        try {
            $response = $this->httpClient->post("/v1/organizations/{$this->organizationId}/mpks", [
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
            return new MPK($responseData);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to create MPK: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Aktualizuje istniejące MPK.
     * @param string $id
     * @param array $data
     * @return MPK
     * @throws InpostApiException
     */
    public function updateMPK(string $id, array $data): MPK
    {
        try {
            $response = $this->httpClient->put("/v1/mpks/{$id}", [
                
                'json' => $data
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
            return new MPK($responseData);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to update MPK: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
