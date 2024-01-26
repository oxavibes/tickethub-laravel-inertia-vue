<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
			'title' => ['required', 'string', 'max:50'],
			'description' => ['required', 'string', 'max:1000'],
			// 'file_paths' => ['nullable', 'array'],
			'status' => ['required', 'in:open,closed'],
			'priority' => ['required', 'in:low,medium,high'],
			'labels' => ['required', 'array', 'distinct', 'exists:labels,id'],
			'categories' => ['required', 'array', 'distinct', 'exists:categories,id'],
			'agent_id' => ['nullable', 'exists:users,id'],
		];
	}
}
