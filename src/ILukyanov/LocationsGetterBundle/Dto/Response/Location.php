<?php

namespace ILukyanov\LocationsGetterBundle\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var Coordinates
     *
     * @Assert\NotNull()
     * @Assert\Valid()
     *
     * @Serializer\SerializedName("coordinates")
     * @Serializer\Type("ILukyanov\LocationsGetterBundle\Dto\Response\Coordinates")
     */
    private $coordinates;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Location
     */
    public function setName(?string $name): ?Location
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinates $coordinates
     * @return Location
     */
    public function setCoordinates(?Coordinates $coordinates): ?Location
    {
        $this->coordinates = $coordinates;
        return $this;
    }
}
