<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Requests\AthleteEvaluationForm;

class AthleteEvaluationFormTest extends TestCase
{
    /**
     * Verifica a validação do método de autorização do formulário.
     *
     * @return void
     */
    public function testAuthorize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Verifica a validação do parâmetro <b>athlete_id</b>.
     * O parâmetro <b>athlete_id</b> deve ser definido como obrigatório.
     * O parâmetro <b>athlete_id</b> deve ser definido com o tipo numérico.
     * O parâmetro <b>athlete_id</b> deve existir na tabela de atletas.
     *
     * @return void
     */
    public function testAthleteIdRule()
    {
        $athleteEvaluationForm = new AthleteEvaluationForm();
        $rules = $athleteEvaluationForm->rules();
        $this->assertTrue(isset($rules['athlete_id']));
        $this->assertStringContainsString('required', $rules['athlete_id']);
        $this->assertStringContainsString('numeric', $rules['athlete_id']);
        $this->assertStringContainsString('exists:athletes,id', $rules['athlete_id']);
    }

    /**
     * Verifica a validação do parâmetro <b>realization_date</b>.
     *
     * @return void
     */
    public function testRealizationDateRule()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Verifica a validação do parâmetro <b>physicalTests</b>.
     *
     * @return void
     */
    public function testPhysicalTestsRule()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Verifica a validação do parâmetro <b>bodyIndexes</b>.
     *
     * @return void
     */
    public function testBodyIndexesRule()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Verifica a validação do método de persistência do formulário para adicionar um novo registro.
     *
     * @return void
     */
    public function testPersistStore()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Verifica a validação do método de persistência do formulário para alterar um registro existente.
     *
     * @return void
     */
    public function testPersistUpdate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
