<?php

namespace Petfinder\Reward\Http\Requests;

use App\Http\Requests\Request;
use User;

class RewardUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(\Illuminate\Http\Request $request)
	{
		// Determine if the user is authorized to do  the action,
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(\Illuminate\Http\Request $request)
	{
		// validation rule for create request.
		if($request->isMethod('POST'))
			return [
				'price'          => 'required'
            'status'          => 'required'

			];

		// Validation rule for update request.
		if($request->isMethod('PUT') || $request->isMethod('PATCH'))
			return [
				'price'          => 'required'
            'status'          => 'required'

			];

		// Default validation rule.
		return [

		];

	}

}