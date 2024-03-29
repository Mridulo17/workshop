<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserMenuActionRequest extends FormRequest
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
        $data = request()->all();
        $data['menu_id'] = request('menu_id');
        return [
            'route_name' => 'nullable|'.$this->routeNameUnique($data),
            'custom_element' => 'nullable|unique:user_menu_actions,custom_element,'.@$this->id,
            'order_by' => 'required',
            'status' => 'required',
        ];
    }



    private function routeNameUnique($data)
    {
        $rule = Rule::unique('user_menu_actions','route_name')->ignore(@$this->id, 'id');
        $rule->where('menu_id',$data['menu_id'])->where('route_name',$data['route_name']);

        return $rule;
    }
}
