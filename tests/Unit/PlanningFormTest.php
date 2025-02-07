<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Requests\PlanningForm;

class PlanningFormTest extends TestCase
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
     * Verifica a validação do método de regras do formulário.
     * Todas as regras devem estar no formato de array.
     *
     * @return void
     */
    public function testRules()
    {
        $planningForm = new PlanningForm();
        $rules = $planningForm->rules();
        $this->assertIsArray($rules);
        foreach($rules as $rule) {
            $this->assertIsArray($rule);
        }
    }

    /**
     * Verifica a validação do parâmetro <b>training_id</b>.
     * O parâmetro <b>training_id</b> deve ser definido como obrigatório.
     * O parâmetro <b>training_id</b> deve ser definido com o tipo numérico.
     * O parâmetro <b>training_id</b> deve ser existir na tabela de treinos.
     *
     * @return void
     */
    public function testTrainingIdRule()
    {
        $planningForm = new PlanningForm();
        $rules = $planningForm->rules();
        $this->assertTrue(isset($rules['training_id']));
        $this->assertContains('required', $rules['training_id']);
        $this->assertContains('numeric', $rules['training_id']);
        $this->assertContains('exists:trainings,id', $rules['training_id']);
    }

    /**
     * Verifica a validação do parâmetro <b>name</b>.
     * O parâmetro <b>name</b> deve ser definido como obrigatório.
     * O parâmetro <b>name</b> deve ser definido com o mínimo de 3 caracteres.
     * O parâmetro <b>name</b> deve ser definido com o máximo de 50 caracteres.
     * O parâmetro <b>name</b> deve ser definido permitindo apenas letras, números, hífens e underlines.
     *
     * @return void
     */
    public function testNameRule()
    {
        $planningForm = new PlanningForm();
        $rules = $planningForm->rules();
        $this->assertTrue(isset($rules['name']));
        $this->assertContains('required', $rules['name']);
        $this->assertContains('min:3', $rules['name']);
        $this->assertContains('max:50', $rules['name']);
        $this->assertContains('alpha_dash', $rules['name']);
    }

    /**
     * Verifica a validação do parâmetro <b>description</b>.
     * O parâmetro <b>description</b> deve ser definido como obrigatório.
     * O parâmetro <b>description</b> deve ser definido com o mínimo de 3 caracteres.
     * O parâmetro <b>description</b> deve ser definido com o máximo de 200 caracteres.
     *
     * @return void
     */
    public function testDescriptionRule()
    {
        $planningForm = new PlanningForm();
        $rules = $planningForm->rules();
        $this->assertTrue(isset($rules['description']));
        $this->assertContains('required', $rules['description']);
        $this->assertContains('min:3', $rules['description']);
        $this->assertContains('max:200', $rules['description']);
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
