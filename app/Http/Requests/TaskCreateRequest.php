<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|numeric|exists:status,id'
        ];
    }

        /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Título é obrigatório',
            'title.string' => 'Título deve ser um texto',
            'title.max' => 'Título deve ter no máximo 255 caracteres',

            'description.required' => 'Descrição é obrigatória',
            'description.string' => 'Descrição deve ser um texto',

            'status_id.required' => 'Status é obrigatório',
            'status_id.numeric' => 'Status deve ser um número',
            'status_id.exists' => 'Esse status não existe ou o ID inválido',
        ];
    }
}
