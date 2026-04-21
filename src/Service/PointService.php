<?php

namespace maniek431\Inpost_Integration_Api_Rest\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use maniek431\Inpost_Integration_Api_Rest\Exception\InpostApiException;
use maniek431\Inpost_Integration_Api_Rest\Model\Point;

class PointService
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    /*
     * Pobiera listę punktów na podstawie filtrów.
     * @param array $filters Tablica filtrów (np. ['city' => 'Kraków', 'type' => 'parcel_locker'])
     * @return Point[]
     * @throws InpostApiException
     */
    public function getPoints(array $filters = []): array
    {
        try {
            $response = $this->httpClient->get('https://api.inpost.pl/v1/points', [
                'query' => $filters
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $items = $data['items'] ?? [];

            return array_map(fn($item) => new Point($item), $items);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch points: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Pobiera szczegóły konkretnego punktu po jego nazwie (np. KRA011)
     *
     * @param string $name
     * @return Point
     * @throws InpostApiException
     */
    public function getPointByName(string $name): Point
    {
        try {
            $response = $this->httpClient->get('https://api.inpost.pl/v1/points/' . $name);
            $data = json_decode($response->getBody()->getContents(), true);
            
            if (empty($data)) {
                throw new InpostApiException("Point $name not found", 404);
            }

            return new Point($data);
        } catch (GuzzleException $e) {
            throw new InpostApiException('Failed to fetch point detail: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
