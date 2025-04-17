<?php

namespace App\Interfaces\Http\Requests;

use App\Domain\Users\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddSportRequest extends FormRequest {
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $arenas = auth()->user()->arenas()->select('id')->pluck('id')->toArray();
        return in_array($this->input('arena_id') , $arenas);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "sports" => ['required' , 'array'] ,
            "sports.*" => [Rule::exists('sports' , 'id')] ,
        ];
    }
}