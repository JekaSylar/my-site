<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,255',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Назва категорії є обов’язковим для заповнення.',
            'name.string' => 'Назва категорії повинно бути рядком.',
            'slug.required' => 'Slug є обов’язковим для заповнення.',
            'slug.string' => 'Slug категорії повинно бути рядком.',
            'name.between' => 'Назва категорії має містити від 1 до 255 символів.',
            'description.string' => 'Опис категорії повинен бути текстом.',
            'meta_description.string' => 'Мета-опис повинен бути текстом.',
            'meta_keywords.string' => 'Мета-ключові слова повинні бути текстом.',
        ];
    }
}
