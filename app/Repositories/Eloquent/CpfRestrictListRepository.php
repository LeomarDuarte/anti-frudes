<?php

namespace App\Repositories\Eloquent;

use App\Models\CpfRestrictList;
use App\Exceptions\CpfException;
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
        return $this->cpfRestrictList->create($dataParams);
    }

    public function check(string $cpf)
    {
        if ($this->cpfRestrictList->where('cpf', $cpf)->doesntExist()) {
            return CpfException::class;
        }

        return  $this->cpfRestrictList->where('cpf', $cpf)->first(['cpf', 'created_at']);
    }

    public function remove(string $cpf)
    {
        if ($this->cpfRestrictList->where('cpf', $cpf)->doesntExist()) {
            return "NotFoundCpfException";
        }

        return  $this->cpfRestrictList->where('cpf', $cpf)->delete();
    }

    public function findAll()
    {
        return $this->cpfRestrictList->all(['cpf', 'created_at']);
    }
}
