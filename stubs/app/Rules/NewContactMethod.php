<?php

namespace App\Rules;

use App\Models\Country;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;

use App\Enums\{ContactMethodType, PhoneValueRegex};

class NewContactMethod implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(
		string $attribute,
		mixed $value,
		Closure $fail
	): void {
		$validator = validator($value, $this->rules());

		$validator
			->sometimes(
				"value",
				["email"],
				fn(Fluent $input) => $input->type ===
					ContactMethodType::Email->value
			)
			->sometimes(
				"value",
				["url:http,https"],
				fn(Fluent $input) => $input->type ===
					ContactMethodType::Url->value
			)
			->sometimes(
				"value",
				["regex:" . PhoneValueRegex::Mobile->value . "i"],
				fn(Fluent $input) => $input->type ===
					ContactMethodType::Mobile->value
			)
			->sometimes(
				"value",
				["regex:" . PhoneValueRegex::Landline->value . "i"],
				fn(Fluent $input) => in_array($input->type, [
					ContactMethodType::Landline->value,
					ContactMethodType::Fax->value,
				])
			);

		if ($validator->fails()) {
			collect($validator->errors()->messages())->each(
				fn(array $messages, string $field) => collect($messages)->each(
					fn(string $message) => $fail("$attribute.$field", $message)
				)
			);
		}
	}

	/**
	 * Get the standard rules for all contact method types.
	 *
	 */
	protected function rules(): array
	{
		return [
			"type" => [
				"required",
				"string",
				Rule::enum(ContactMethodType::class),
			],
			"country_id" => [
				"nullable",
				"required_if:type," . ContactMethodType::Landline->value,
				"required_if:type," . ContactMethodType::Mobile->value,
				"required_if:type," . ContactMethodType::Fax->value,
				"numeric",
				"integer",
				Rule::exists(Country::class, "id"),
			],
			"value" => ["required", "string"],
		];
	}
}
