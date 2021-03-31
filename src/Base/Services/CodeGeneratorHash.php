<?php

namespace App\Base\Services;

use App\Base\Interfaces\CodeGeneratorInterface;

class CodeGeneratorHash implements CodeGeneratorInterface
{
    public function generateCode()
    {
        return 'code_hash';
    }
}
