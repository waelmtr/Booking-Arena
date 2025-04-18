<?php

namespace App\Interfaces\Http\Requests;

use App\Domain\Users\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required' , 'string'] ,
            "email" => ['required' , 'email:filter' , Rule::unique('users' , 'email')] ,
            "password" => ['required' , 'string' , 'min:8' , 'confirmed'] ,
            "role" => ['required' , Rule::in(RoleEnum::allRoles())] ,
        ];
    }
}
