<?php

namespace App\Http\Requests;

use App\Models\Pourashava;
use App\Models\VehicleType;
use App\Rules\ValidMobile;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'picture'                => ['nullable', Rule::requiredIf($this->isMethod('post')), 'image', 'mimes:png,jpg,jpeg', 'max:5000'],
            'vehicle_type_id'        => ['nullable', Rule::requiredIf($this->isMethod('post')), 'integer', 
                                        function ($attribute, $value, $fail) {
                                            $vehicleType = VehicleType::find($value);
                                            if (! $vehicleType) {
                                                $fail('The vehicle type is not exist.');
                                            }
                                        }],
            'name'                   => 'required|string',
            'email'                  => 'required|email|unique:users,email,'.($this->isMethod('put') ? $this->user->id: ''),
            'mobile'                 => ['required', 'string', 'size:11', new ValidMobile(), 'unique:users,mobile,'.($this->isMethod('put') ? $this->user->id: '')],
            'father_or_husband_name' => 'required|string',
            'mother_name'            => 'required|string',
            'age'                    => 'required|integer',
            'birth_day'              => ['nullable', Rule::requiredIf($this->isMethod('post')), 'date'],
            'nid_no'                 => ['nullable', Rule::requiredIf($this->isMethod('post')), 'integer'],
            'pourashava_id'          =>['nullable', Rule::requiredIf($this->isMethod('post')), 'integer', 
                                        function ($attribute, $value, $fail) {
                                            $pourashava = Pourashava::find($value);
                                            if (! $pourashava) {
                                                $fail('The Pourashava is not exist.');
                                            }
                                        }],
            'post_code'              => ['nullable', Rule::requiredIf($this->isMethod('post')), 'digits:4', 'integer'],
            'permanent_address'      => ['nullable', Rule::requiredIf($this->isMethod('post')), 'string'],
            'word_no'                => ['nullable', Rule::requiredIf($this->isMethod('post')), 'integer'],
            'village'                => ['nullable', Rule::requiredIf($this->isMethod('post')), 'string'],
            'pay_from'               => ['nullable', Rule::requiredIf($this->isMethod('post')), 'size:11', new ValidMobile()],
            'transaction_id'         => ['nullable', Rule::requiredIf($this->isMethod('post')), 'string'],
        ];
    }
}
