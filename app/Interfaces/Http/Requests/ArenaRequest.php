<?php

namespace App\Interfaces\Http\Requests;

use App\Domain\Users\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class ArenaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == RoleEnum::ArenaOwner->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->modelRules(false) : $this->modelRules();
    }

    public function modelRules($nullable = true){
        $required = $nullable ? 'nullable' : 'required';
        return [
            "name" => [$required , 'string'] ,
            "description" => ['string'] ,
            "location" => [$required , 'array'] ,
        ];
    }
}
