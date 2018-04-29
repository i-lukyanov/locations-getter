<?php

namespace ILukyanov\LocationsGetterBundle\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ILukyanov\LocationsGetterBundle\Transport\Exception\BadResponseException;
use ILukyanov\LocationsGetterBundle\Transport\Exception\ConnectException;
use RuntimeException;

final class GuzzleTransport implements TransportInterface
{
    private const METHOD_GET = 'GET';

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $url, array $params = []): string
    {
        try {
            $response = $this->client->request(self::METHOD_GET, $url, $params);

            return $response->getBody()->getContents();
        } catch (GuzzleException $ge) {
            throw new ConnectException('Error occured during remote service interaction: ' . $ge->getMessage());
        } catch (RuntimeException $re) {
            throw new BadResponseException('Error occured while reading response content: ' . $re->getMessage());
        }
    }
}
