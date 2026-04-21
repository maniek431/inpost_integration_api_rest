<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Organization;

class OrganizationService
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Pobiera listę organizacji powiązanych z kontem.
     * @return Organization[]
     * @throws InpostApiException
     */
    public function getOrganizations(): array
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/organizations');
            $data = json_decode($response->getBody()->getContents(), true);
            $items = $data['items'] ?? [];

            return array_map(fn($item) => new Organization($item), $items);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch organizations: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $organizationId
     * @return Organization
     * @throws InpostApiException
     */
    public function getOrganization(string $organizationId): Organization
    {
        try {
            $response = $this->httpClient->get('https://api-shipx-pl.easypack24.net/v1/organizations/' . $organizationId);
            $data = json_decode($response->getBody()->getContents(), true);
            return new Organization($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch organization: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
