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
        $athleteEvaluationForm = new AthleteEvaluationForm();
        $rules = $athleteEvaluationForm->rules();
        $this->assertTrue(isset($rules['realization_date']));
        $this->assertStringContainsString('required', $rules['realization_date']);
        $this->assertStringContainsString('date', $rules['realization_date']);
        $this->assertStringContainsString('before:tomorrow', $rules['realization_date']);
    }

    /**
     * Verifica a validação do parâmetro <b>physicalTests</b>.
     *
     * @return void
     */
    public function testPhysicalTestsRule()
    {
        $athleteEvaluationForm = new AthleteEvaluationForm();
        $rules = $athleteEvaluationForm->rules();
        $this->assertTrue(isset($rules['physical_testes']));
        $this->assertStringContainsString('array', $rules['physical_testes']);
    }

    /**
     * Verifica a validação do parâmetro <b>bodyIndexes</b>.
     *
     * @return void
     */
    public function testBodyIndexesRule()
    {
        $athleteEvaluationForm = new AthleteEvaluationForm();
        $rules = $athleteEvaluationForm->rules();
        $this->assertTrue(isset($rules['body_indexes']));
        $this->assertStringContainsString('array', $rules['body_indexes']);
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
