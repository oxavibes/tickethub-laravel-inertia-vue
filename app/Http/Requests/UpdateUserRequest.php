<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
			'name' => ['sometimes', 'required', 'string', 'max:255'],
			'email' => ['sometimes', 'required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
			// 'current_password' => ['nullable', 'required', 'current_password'],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Password is nullable for update
			'role' => ['sometimes', 'required', 'string', 'in:admin,user,agent'],
		];
	}
}
