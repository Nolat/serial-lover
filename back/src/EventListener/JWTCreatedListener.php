<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    /**
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        try {
            $payload = $event->getData();
            $event->setData($payload);
        } catch (\Exception $e) {
        }
    }
}
