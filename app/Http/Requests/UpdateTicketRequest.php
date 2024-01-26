<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
			'title' => ['sometimes', 'required', 'string', 'max:50'],
			'description' => ['sometimes', 'required', 'string', 'max:1000'],
			// 'file_paths' => ['nullable', 'array'],
			'status' => ['sometimes', 'required', 'in:open,closed'],
			'priority' => ['sometimes', 'required', 'in:low,medium,high'],
			'labels' => ['sometimes', 'array', 'distinct', 'exists:labels,id'],
			'categories' => ['sometimes', 'array', 'distinct', 'exists:categories,id'],
			'agent_id' => ['sometimes', 'nullable',  'exists:users,id'],
		];
	}
}
