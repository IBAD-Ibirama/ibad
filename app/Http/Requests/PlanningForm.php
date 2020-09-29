<?php

namespace App\Http\Requests;

use App\Planning;
use Illuminate\Foundation\Http\FormRequest;

class PlanningForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'training_id' => ['required', 'numeric', 'exists:trainings,id'],
            'name'        => ['required', 'min:3', 'max:50', 'alpha_dash'],
            'description' => ['required', 'min:3', 'max:200']
        ];
    }

    /**
     * Persists planning's data.
     * 
     * @param \App\Planning $planning
     */
    public function persist(Planning $planning)
    {
        $planning->training_id = $this->training_id;
        $planning->name = $this->name;
        $planning->description = $this->description;

        $planning->save();
    }
}
