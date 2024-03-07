<?php

namespace App\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var Request|null
     */
    protected $request;

    /**
     * @var ObjectManager|null
     */
    protected $objectManager;

    /**
     * @var EntityManagerInterface|null
     */
    protected $entityManager;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, RequestStack $request, EntityManagerInterface $entityManager)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->request = $request->getCurrentRequest();
        $this->entityManager = $entityManager;
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     *
     * @final
     */
    protected function renderSerializeJson($data, $context = null, int $status = 200, array $headers = []): JsonResponse
    {
        if ($this->serializer && !empty($data)) {
            if (null !== $context && !empty($context)) {
                if (\is_string($context)) {
                    $context = [$context];
                } elseif (!\is_array($context)) {
                    $context = [(string) $context];
                }

                $json = $this->serializer->serialize($data, 'json', SerializationContext::create()
                    ->setGroups($context)
                    ->enableMaxDepthChecks()
                );
            } else {
                $json = $this->serializer->serialize($data, 'json');
            }

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     *
     * @final
     */
    protected function renderSampleJson($data, int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse(json_encode($data), $status, $headers, true);
    }
}
