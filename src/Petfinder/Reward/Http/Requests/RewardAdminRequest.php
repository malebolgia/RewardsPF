<?php

namespace Petfinder\Reward\Http\Requests;

use App\Http\Requests\Request;
use User;

class RewardAdminRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(\Illuminate\Http\Request $request)
	{
		// Determine if the user is authorized to create an entry,
		if($request->isMethod('POST') || $request->is('*/create'))
			return User::can('reward.reward.create');

		// Determine if the user is authorized to update an entry,
		if($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit'))
			return User::can('reward.reward.edit');

		// Determine if the user is authorized to delete an entry,
		if($request->isMethod('DELETE'))
			return User::can('reward.reward.delete');

		// Determine if the user is authorized to view the module.
		return User::can('reward.reward.view');
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
				'name' => 'required'
			];

		// Validation rule for update request.
		if($request->isMethod('PUT') || $request->isMethod('PATCH'))
			return [
				'name' => 'required'
			];

		// Default validation rule.
		return [

		];

	}

}