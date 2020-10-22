<?php

namespace Builders;

use App\Models\CpfRestrictList;
use Builders\Contracts\CpfRestrictListBuilderInterface;

class CpfRestrictListBuilder implements CpfRestrictListBuilderInterface
{
    private $cpfRestrictList;

    public function __construct(CpfRestrictList $cpfRestrictList)
    {
        $this->cpfRestrictList = $cpfRestrictList;
    }

    public function generateCpf()
    {
        return $this->cpfRestrictList
                    ->factory()
                    ->make()
                    ->only('cpf');
    }
}
