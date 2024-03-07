<?php

namespace App\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class DeletedFilter extends SQLFilter
{
    /**
     * @var string[bool]
     */
    protected $disabled = [];

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        //        print_r($this);
        if (\array_key_exists($targetEntity->getName(), $this->disabled) && $this->disabled[$targetEntity->getName()]) {
            return '';
        }
        if ($targetEntity->hasField('deletedAt')) {
            return sprintf('%s.deleted_at = 0', $targetTableAlias);
        }

        return '';
    }

    /**
     * @param string $class
     */
    public function disableForEntity($class)
    {
        $this->disabled[$class] = true;
        //        // Make sure the hash (@see SQLFilter::__toString()) for this filter will be changed to invalidate the query cache.
        //        $this->setParameter(sprintf('disabled_%s', $class), true);
    }
}
