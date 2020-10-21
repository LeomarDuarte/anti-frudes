<?php

namespace App\Rules;

class CpfRules
{
    public function rule(string $cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $cpf)->exists()) {
            return response()->json(['type' => 'ExistsCpfException', 'message' => 'CPF already registered.'], Response::HTTP_PRECONDITION_FAILED);
        }
    }

    public function 
}
