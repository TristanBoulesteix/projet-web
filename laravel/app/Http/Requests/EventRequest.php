<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'id_idea' => 'required',
			'name' => 'required|max:255|unique:events',
			'description' => 'required|max:255',
			'file' => 'required|image',
			'date' => 'required|date|after:today',
			'recurrency' => 'required',
			'type' => '',
			'price' => 'required',
			'cost' => 'nullable|max:255|numeric'
		];
	}
}
