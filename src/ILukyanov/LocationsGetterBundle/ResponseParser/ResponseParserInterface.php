<?php

namespace ILukyanov\LocationsGetterBundle\ResponseParser;

use ILukyanov\LocationsGetterBundle\Dto\Response\Location;
use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\ErrorException;
use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\InvalidDataException;
use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\ParseException;

interface ResponseParserInterface
{
    /**
     * @param string $jsonData
     * @return Location[]
     * @throws ParseException
     * @throws ErrorException
     * @throws InvalidDataException
     */
    public function parse(string $jsonData): array;
}
