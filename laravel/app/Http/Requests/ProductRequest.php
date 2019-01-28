<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
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
			'name' => 'required|max:255|unique:products',
			'description' => 'required|max:255',
			'file' => 'required|image',
			'price' => 'max:255|numeric',
			'category' => 'max:255|required',
			'added' => 'nullable|max:255'
		];
	}
}
