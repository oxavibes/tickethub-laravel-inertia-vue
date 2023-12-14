<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLabelRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	public function prepareForValidation()
	{
		$this->merge([
			'id' => $this->route('label')->id, // Assuming 'id' is the primary key column name
		]);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'title' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('labels')->ignore($this->id)],
			'visible' => ['sometimes', 'required', 'boolean'],
		];
	}
}
