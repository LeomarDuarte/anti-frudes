<?php

namespace App\Repositories;

use Illuminate\Http\Response;

use App\Models\CpfRestrictList;
use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\CpfRestrictListRepositoryInterface;

class CpfRestrictListRepository implements CpfRestrictListRepositoryInterface
{
    private $cpfRestrictList;

    public function __construct(CpfRestrictList $cpfRestrictList)
    {
        $this->cpfRestrictList = $cpfRestrictList;
    }

    public function add(array $dataParams)
    {
        if (preg_match('/(\d)\1{10}/', $dataParams['cpf'])) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $dataParams['cpf'])->exists()) {
            return response()->json(['type' => 'ExistsCpfException', 'message' => 'CPF already registered.'], Response::HTTP_PRECONDITION_FAILED);
        }

        return $this->cpfRestrictList->create($dataParams);
    }

    public function check(string $cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $cpf)->doesntExist()) {
            return ['type' => 'NotFoundCpfException', 'message' => 'CPF not found.'];
        }

        return  $this->cpfRestrictList->where('cpf', $cpf)->first(['cpf', 'created_at']);
    }

    public function remove(string $cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $cpf)->doesntExist()) {
            return ['type' => 'NotFoundCpfException', 'message' => 'CPF not found.'];
        }

        $this->cpfRestrictList->where('cpf', $cpf)->delete();
    }

    public function findAll()
    {
        return $this->cpfRestrictList->all(['cpf', 'created_at']);
    }
}
