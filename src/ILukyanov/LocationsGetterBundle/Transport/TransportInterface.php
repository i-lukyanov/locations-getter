<?php

namespace ILukyanov\LocationsGetterBundle\Transport;

use ILukyanov\LocationsGetterBundle\Transport\Exception\BadResponseException;
use ILukyanov\LocationsGetterBundle\Transport\Exception\ConnectException;

interface TransportInterface
{
    /**
     * @param string $url
     * @param mixed[] $params
     * @return null|string
     * @throws ConnectException
     * @throws BadResponseException
     */
    public function get(string $url, array $params = []): string;
}
