<?php
namespace TypiCMS\Modules\Groups\Http\Requests;

use TypiCMS\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules()
    {
        $rules = [
            'name' => 'required|min:4|unique:groups,name,' . $this->get('id'),
        ];
        return $rules;
    }
}
