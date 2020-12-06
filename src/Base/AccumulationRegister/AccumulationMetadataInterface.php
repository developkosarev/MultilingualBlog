<?php

namespace App\Base\AccumulationRegister;

interface AccumulationMetadataInterface
{
    public function getDimensions(): array;

    public function getAggregateFields(): array;
}