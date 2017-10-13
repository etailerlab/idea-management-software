<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Service\Reference;

abstract class AbstractRequest extends FormRequest
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
    public function rules(Reference $reference)
    {
        $rules = [
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'department_id' => [
                Rule::in(array_keys($reference->getAllDepartmentForSelect())),
                'required',
            ],
            'role_id' => [
                Rule::in(array_keys($reference->getAllRolesForSelect())),
                'required',
            ],
            'position_id' => [
                Rule::in(array_keys($reference->getAllPositionsForSelect())),
                'required',
            ],
        ];

        return array_merge($rules, $this->getEmailValidator());
    }

    /**
     * @return array
     */
    abstract protected function getEmailValidator() : array;
}
