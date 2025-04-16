<?php
namespace App\Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimeSlotRequest extends FormRequest
{
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
        return $this->isMethod('POST') ? $this->modelRules(false) : $this->modelRules();
    }

    public function modelRules($nullable = true){
        $required = $nullable ? 'nullable' : 'required';
        return [
            "start_date" => [$required , 'date' ,'after:now'] ,
            "end_date" => [$required , 'date'] ,
            "price" => [$required , 'numeric'] ,
            "arena_id" => [$required , Rule::exists('arenas' , 'id')] ,
        ];
    }
}