<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessHolderRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            // 'picture'                => ['nullable', Rule::requiredIf($this->isMethod('post')), 'image', 'mimes:png,jpg,jpeg', 'max:5000'],

            'name'                   => 'required|string',
            'email'                  => 'required|email|unique:users,email,' . ( $this->isMethod( 'put' ) ? $this->user->id : '' ),
            'mobile'                 => ['required', 'string', 'size:11', new ValidMobile(), 'unique:users,mobile,' . ( $this->isMethod( 'put' ) ? $this->user->id : '' )],
            'father_or_husband_name' => 'required|string',
            'mother_name'            => 'required|string',
            'birth_day'              => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'date'],
            'nid_no'                 => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'integer'],

            'permanent_address'      => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'string'],
            'present_address'        => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'string'],
            'ward_id'                => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'integer'],

            'business_name'          => 'required|string',
            'business_address'       => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'string'],
            // 'business_tin_no'        => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'integer'],

        ];
    }
}
