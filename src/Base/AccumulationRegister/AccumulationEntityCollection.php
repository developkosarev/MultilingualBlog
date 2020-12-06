<?php

namespace App\Base\AccumulationRegister;

use Symfony\Component\PropertyAccess\PropertyAccess;

class AccumulationEntityCollection
{
    private $propertyAccessor;

    private $accumulationRegister;

    private $items = [];

    private $itemsTotal = [];

    public function __construct(AbstractAccumulationRegister $accumulationRegister)
    {
        $this->accumulationRegister = $accumulationRegister;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function add(AccumulationEntityRecordInterface $record)
    {
        $this->items[] = $record;
    }

    private function getKey(AccumulationEntityRecordInterface $record)
    {
        $result = '';

        $dimensions = $this->accumulationRegister->getDimensions();
        foreach ($dimensions as $dimension) {
            $id = $this->propertyAccessor->getValue($record, $dimension)->getId();
            $result = empty($result) ? $id : $result . '-' . $id;
        }

        return $result;
    }

    private function updateTotal(AccumulationEntityRecordInterface $record)
    {
        $key = $this->getKey($record);
        $itemTotal = $this->itemsTotal[$key] ?? null;

        if ($itemTotal == null) {
//            $className = $accum->getAccumTotal();
//            $itemTotal = new $className();
//
//            $dimensions = $accum->getDimensions();
//            foreach ($dimensions as $dimension) {
//                $value = $this->propertyAccessor->getValue($accum, $dimension);
//                $this->propertyAccessor->setValue($itemTotal, $dimension, $value);
//            }
//
//            $resources = $accum->getResources();
//            foreach ($resources as $resource) {
//                $value = $this->propertyAccessor->getValue($accum, $resource);
//                $this->propertyAccessor->setValue($itemTotal, $resource, $value);
//            }
//
//            $this->itemsTotal->set($key, $itemTotal);
        } else {
//            $resources = $accum->getResources();
//            foreach ($resources as $resource) {
//                $value = $this->propertyAccessor->getValue($itemTotal, $resource);
//                $value = $value + $this->propertyAccessor->getValue($accum, $resource);
//                $this->propertyAccessor->setValue($itemTotal, $resource, $value);
//            }
        }
    }
}
