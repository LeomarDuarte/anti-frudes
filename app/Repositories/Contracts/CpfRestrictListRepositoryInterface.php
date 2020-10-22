<?php

namespace App\Repositories\Contracts;

interface CpfRestrictListRepositoryInterface
{
    public function add(string $cpf);
    public function check(string $cpf);
    public function remove(string $cpf);
    public function findAll();
}
