<?php

namespace ILukyanov\LocationsGetterBundle\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Coordinates
{
    /**
     * @var float
     *
     * @Assert\NotNull()
     * @Assert\Type("float")
     *
     * @Serializer\SerializedName("lat")
     * @Serializer\Type("float")
     */
    private $lat;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @Assert\Type("float")
     *
     * @Serializer\SerializedName("long")
     * @Serializer\Type("float")
     */
    private $long;

    /**
     * @return float
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return Coordinates
     */
    public function setLat(?float $lat): ?Coordinates
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLong(): ?float
    {
        return $this->long;
    }

    /**
     * @param float $long
     * @return Coordinates
     */
    public function setLong(?float $long): ?Coordinates
    {
        $this->long = $long;
        return $this;
    }
}
