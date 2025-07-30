<?php

namespace App\Rules;

use App\Models\ContactMethod;
use Illuminate\Validation\Rule;

class ContactMethodUpdate extends NewContactMethod
{
	/**
	 * Get the standard rules for all contact method types.
	 *
	 */
	protected function rules(): array
	{
		return array_merge_recursive(parent::rules(), [
			"id" => [
				"sometimes",
				"numeric",
				"integer",
				Rule::exists(ContactMethod::class, "id"),
			],
		]);
	}
}
