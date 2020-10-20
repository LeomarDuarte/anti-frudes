<?php

namespace App\Repositories\Contracts;

interface CpfRestrictListRepositoryInterface
{
    public function add(array $dataParams);
    public function check(string $cpf);
    public function remove(string $cpf);
    public function findAll();
}
