<?php

namespace App\Base\AccumulationRegister;

interface AccumulationEntityCollectionInterface
{
    public function getRecorder(): AccumulationEntityRecorderInterface;

    public function setRecorder(AccumulationEntityRecorderInterface $recorder): void;

    public function add(AccumulationEntityRecordInterface $record);

    public function read();

    public function clear();

    public function save();
}
