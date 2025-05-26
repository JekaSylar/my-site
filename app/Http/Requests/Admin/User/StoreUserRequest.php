<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Вкажіть ім’я.',
            'name.max' => 'Ім’я не повинно перевищувати 255 символів.',
            'email.required' => 'Вкажіть електронну пошту.',
            'email.email' => 'Введіть дійсну електронну пошту.',
            'email.max' => 'Електронна пошта не повинна перевищувати 255 символів.',
            'email.unique' => 'Користувач з такою електронною поштою вже існує.',
            'password.required' => 'Вкажіть пароль.',
            'password.min' => 'Пароль має містити щонайменше 6 символів.',
        ];
    }
}
