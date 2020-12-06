<?php

namespace App\Base\AccumulationRegister;

//https://habr.com/ru/post/518242/
//https://helpf.pro/help/view/14847.html

abstract class AbstractAccumulationRegister
{
    #region Fields

    protected $entityNameRecord;

    protected $entityNameTotal;

    protected $recordCollection;

    #endregion

    #region Constructor

    public function __construct(AccumulationEntityRecordInterface $record, AccumulationEntityTotalInterface $total)
    {

    }

    #endregion

    abstract public function getDimensions(): array;

    abstract public function getResources(): array;

    public function getEntityTotal()
    {
        //return CostTotal::class;
    }

    public function getEntityRecord()
    {
        //return CostTotal::class;
    }

    public function createRecordCollection()
    {
        //return new RecordCollection()
    }
}