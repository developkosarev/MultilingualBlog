<?php

namespace App\Base\AccumulationRegister;

interface AccumulationEntityCollectionInterface
{
    public function add(AccumulationEntityRecord $record);
}
