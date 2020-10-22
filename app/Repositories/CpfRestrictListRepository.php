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

    public function add(string $cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $cpf)->exists()) {
            return response()->json(['type' => 'ExistsCpfException', 'message' => 'CPF already registered.'], Response::HTTP_PRECONDITION_FAILED);
        }

        return  $this->cpfRestrictList->create(['cpf' => $cpf])->only(['cpf', 'createdAt']);
    }

    public function check(string $cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(['type' => 'InvalidCpfException', 'message' => 'CPF is not valid.'], Response::HTTP_PRECONDITION_FAILED);
        } elseif ($this->cpfRestrictList->where('cpf', $cpf)->doesntExist()) {
            return ['type' => 'NotFoundCpfException', 'message' => 'CPF not found.'];
        }

        return  $this->cpfRestrictList->where('cpf', $cpf)->first(['cpf', 'createdAt']);
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
        return $this->cpfRestrictList->all(['cpf', 'createdAt']);
    }
}
