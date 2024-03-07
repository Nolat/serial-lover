<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\UsageTrackingTokenStorage;

class EditInfosEntityListener
{
    private $tokenStorage;
    private $em;

    public function __construct(UsageTrackingTokenStorage $tokenStorage, EntityManager $em)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $filter = $this->em
            ->getFilters()
            ->enable('deleted_filter');
    }

    public function onCommand(ConsoleCommandEvent $event)
    {
        $filter = $this->em
            ->getFilters()
            ->enable('deleted_filter');
    }

    public function preFlush(PreFlushEventArgs $event)
    {
        $em = $event->getObjectManager();

        foreach ($em->getUnitOfWork()->getScheduledEntityDeletions() as $object) {
            if (method_exists($object, 'getDeletedAt')) {
                if ($object->getDeletedAt() instanceof \DateTime) {
                    continue;
                }
                $object->setDeletedDate(new \DateTime());
                if ($this->tokenStorage->getToken() != null) {
                    $object->setDeletedBy($this->tokenStorage->getToken()->getUser());
                }
                $em->persist($object);
            }
        }
    }

    public function prePersist(PrePersistEventArgs $event)
    {
        $object = $event->getObject();
        if (method_exists($object, 'getCreatedAt')) {
            if (!($object->getCreatedAt() instanceof \DateTime)) {
                $object->setCreatedAt(new \DateTime());
                if ($this->tokenStorage->getToken() && $this->tokenStorage->getToken()->getUser()) { // Cas pour le faker bundle
                    if ($this->tokenStorage->getToken() && $this->tokenStorage->getToken()->getUser() != 'anon.') {
                        $object->setCreatedBy($this->tokenStorage->getToken()->getUser());
                    }
                }
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $event)
    {
        $em = $event->getObjectManager();
        foreach ($em->getUnitOfWork()->getScheduledEntityUpdates() as $object) {
            if (method_exists($object, 'getUpdatedAt')) {
                $object->setUpdatedAt(new \DateTime());
                if ($this->tokenStorage->getToken() && $this->tokenStorage->getToken()->getUser() != 'anon.') {
                    $object->setUpdatedBy($this->tokenStorage->getToken()->getUser());
                }
            }
        }
    }
}
