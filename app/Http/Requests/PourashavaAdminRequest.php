<?php

namespace App\Http\Requests;

use App\Models\Pourashava;
use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PourashavaAdminRequest extends FormRequest {
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
            'picture'                => 'nullable|image|mimes:png,jpg,jpeg|max:5000',
            'name'                   => 'required|string',
            'email'                  => 'required|email|unique:admins,email,' . ( $this->isMethod( 'put' ) ? $this->pourashava_admin->id : '' ),
            'mobile'                 => ['required', 'string', 'size:11', new ValidMobile(), 'unique:admins,mobile,' . ( $this->isMethod( 'put' ) ? $this->pourashava_admin->id : '' )],
            'pourashava_id'          => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'integer',
                function ( $attribute, $value, $fail ) {
                    $pourashava = Pourashava::find( $value );
                    if ( !$pourashava ) {
                        $fail( 'The Pourashava is not exist.' );
                    } elseif ( count( $pourashava->admins ) > 0 ) {
                        $fail( 'The Pourashava is already added to another.' );
                    }
                }],
            'pourashava_name'        => 'required|string',
            'pourashava_logo'        => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ),'image','mimes:png,jpg,jpeg','max:5000'],
            'pourashava_url'         => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'unique:admins,pourashava_url,' . ( $this->isMethod( 'put' ) ? $this->pourashava_admin->id : '' )],
            'post_code'              => ['nullable', Rule::requiredIf( $this->isMethod( 'post' ) ), 'digits:4', 'integer'],
             'admin_account_renew_fee' => 'required|numeric',
            'user_registration_fee'  => 'required|numeric',
            'user_account_renew_fee' => 'required|numeric',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'pourashava_id'           => 'pourashava',
            'admin_account_renew_fee' => 'software use fee',
        ];
    }
}
