<?php

namespace ILukyanov\LocationsGetterBundle\ResponseParser;

use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\ErrorException;
use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\InvalidDataException;
use ILukyanov\LocationsGetterBundle\ResponseParser\Exception\ParseException;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ResponseParser implements ResponseParserInterface
{
    /**
     * @var ArrayTransformerInterface
     */
    private $arrayTransformer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ArrayTransformerInterface $arrayTransformer
     * @param ValidatorInterface $validator
     */
    public function __construct(ArrayTransformerInterface $arrayTransformer, ValidatorInterface $validator)
    {
        $this->arrayTransformer = $arrayTransformer;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(string $jsonData): array
    {
        $responseArray = json_decode($jsonData, true);

        if (json_last_error() > 0) {
            throw new ParseException('Error occured while parsing JSON data: ' . json_last_error_msg());
        }
        if ($responseArray['success'] === false) {
            throw new ErrorException('Erroneous response: ' . json_encode($responseArray['data'] ?? []));
        }

        $result =
            $this->arrayTransformer->fromArray(
                $responseArray['data']['locations'] ?? [],
                'array<ILukyanov\LocationsGetterBundle\Dto\Response\Location>'
            );

        $validatorErrors = $this->validator->validate($result);
        if ($validatorErrors->count() > 0) {
            throw new InvalidDataException('Invalid data: ' . json_encode($this->getValidationErrors($validatorErrors)));
        }

        return $result;
    }

    /**
     * @param ConstraintViolationListInterface $validatorErrors
     * @return string[]
     */
    private function getValidationErrors(ConstraintViolationListInterface $validatorErrors): array
    {
        $errors = [];
        foreach ($validatorErrors as $validatorError) {
            /** @var ConstraintViolationInterface $validatorError */
            $errors[$validatorError->getPropertyPath()] = $validatorError->getMessage();
        }

        return $errors;
    }
}
