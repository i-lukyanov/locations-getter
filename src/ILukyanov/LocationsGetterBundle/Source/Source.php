<?php

namespace ILukyanov\LocationsGetterBundle\Source;

use ILukyanov\LocationsGetterBundle\ResponseParser\ResponseParserInterface;
use ILukyanov\LocationsGetterBundle\Transport\TransportInterface;

final class Source implements SourceInterface
{
    private const URI_GET_LOCATIONS = 'locations';

    /**
     * @var TransportInterface
     */
    private $transport;

    /**
     * @var ResponseParserInterface
     */
    private $responseParser;

    /**
     * @param TransportInterface $transport
     * @param ResponseParserInterface $responseParser
     */
    public function __construct(TransportInterface $transport, ResponseParserInterface $responseParser)
    {
        $this->transport = $transport;
        $this->responseParser = $responseParser;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchList(): array
    {
        $jsonResponse = $this->transport->get(self::URI_GET_LOCATIONS);

        return $this->responseParser->parse($jsonResponse);
    }
}
