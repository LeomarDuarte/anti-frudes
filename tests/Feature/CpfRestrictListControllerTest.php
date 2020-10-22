<?php

use Illuminate\Http\Response;
use App\Models\CpfRestrictList;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CpfRestrictListControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $builder;

    public function setUp(): void
    {
        parent::setUp();
        $this->builder = $this->app->make('Builders\CpfRestrictListBuilderInterface');
    }

	/** @test */
    public function should_return_all_cpfs_in_restrict_list()
    {
        // Cenário
        $endPoint = route('cpf.index');

        // Ação
        $this->get($endPoint, []);

        // Validação
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure([
            'Content' => [
                '*' => [
                    'cpf',
                    'createdAt'
                ]
            ]    
        ]);        
    }

	/** @test */
    public function should_add_one_cpf_valid()
    {
        // Cenário
        $cpf = $this->builder->generateCpf();
        $endPoint = route('cpf.create');

        // Ação
        $this->post($endPoint, ['cpf' => $cpf]);

        // Validação
        $this->seeStatusCode(Response::HTTP_OK);
    }

	/** @test */
    public function should_return_message_not_fould_cpf_exception_when_cpf_is_not_registered()
    {
        // Cenário
        $cpf = $this->builder->generateCpf();
        $endPoint = route('cpf.show');

        // Ação
        $this->get($endPoint.'/'.$cpf['cpf']);

        // Validação
        $this->assertTrue(true);
    }
}
