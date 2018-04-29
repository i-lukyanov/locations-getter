<?php

namespace ILukyanov\LocationsGetterBundle\Source;

use ILukyanov\LocationsGetterBundle\Dto\Response\Location;

interface SourceInterface
{
    /**
     * @return Location[]
     */
    public function fetchList(): array;
}
