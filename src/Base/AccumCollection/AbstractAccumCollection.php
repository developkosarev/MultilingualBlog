<?php

namespace App\Base\AccumCollection;

use App\Entity\Base\AbstractAccum;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AbstractAccumCollection
{
    private $propertyAccessor;

    protected $items;

    protected $itemsTotal;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();

        $this->items = new ArrayCollection();
        $this->itemsTotal = new ArrayCollection();
    }

    private function getKey(AbstractAccum $accum)
    {
        $result = '';

        $dimensions = $accum->getDimensions();
        foreach ($dimensions as $dimension) {
            $id = $this->propertyAccessor->getValue($accum, $dimension)->getId();
            $result = empty($result) ? $id : $result . '-' . $id;
        }

        return $result;
    }

    private function updateTotal(AbstractAccum $accum)
    {
        $key = $this->getKey($accum);
        $itemTotal = $this->itemsTotal->get($key);

        if ($itemTotal == null) {
            $className = $accum->getAccumTotal();
            $itemTotal = new $className();

            $dimensions = $accum->getDimensions();
            foreach ($dimensions as $dimension) {
                $value = $this->propertyAccessor->getValue($accum, $dimension);
                $this->propertyAccessor->setValue($itemTotal, $dimension, $value);
            }

            $resources = $accum->getResources();
            foreach ($resources as $resource) {
                $value = $this->propertyAccessor->getValue($accum, $resource);
                $this->propertyAccessor->setValue($itemTotal, $resource, $value);
            }

            $this->itemsTotal->set($key, $itemTotal);
        } else {
            $resources = $accum->getResources();
            foreach ($resources as $resource) {
                $value = $this->propertyAccessor->getValue($itemTotal, $resource);
                $value = $value + $this->propertyAccessor->getValue($accum, $resource);
                $this->propertyAccessor->setValue($itemTotal, $resource, $value);
            }
        }
    }

    public function add(AbstractAccum $accum)
    {
        $this->updateTotal($accum);

        $this->items->add($accum);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getItemsTotal()
    {
        return $this->itemsTotal;
    }
}
