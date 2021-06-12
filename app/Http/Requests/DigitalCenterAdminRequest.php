<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;

class DigitalCenterAdminRequest extends FormRequest
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
            'picture'     =>'nullable|image|mimes:png,jpg,jpeg|max:5000',
            'name'        =>'required|string',
            'email'       =>'required|email|unique:admins,email,'.($this->isMethod('put') ? $this->digital_center_admin->id: ''),
            'mobile'      =>['required', 'string', 'size:11', new ValidMobile(), 'unique:admins,mobile,'.($this->isMethod('put') ? $this->digital_center_admin->id: '')],
        ];
    }
}
