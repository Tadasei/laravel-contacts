<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\{ContactMethodType, PhoneValueRegex};
use App\Models\{Contact, Country};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMethod>
 */
class ContactMethodFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$type = fake()->randomElement(ContactMethodType::class);

		["country_id" => $countryId, "value" => $value] = match ($type) {
			ContactMethodType::Url => [
				"country_id" => null,

				"value" => fake()->url(),
			],

			ContactMethodType::Email => [
				"country_id" => null,

				"value" => fake()->email(),
			],

			ContactMethodType::Landline => [
				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Landline->value),
			],

			ContactMethodType::Mobile => [
				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Mobile->value),
			],

			ContactMethodType::Fax => [
				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Landline->value),
			],
		};

		return [
			"contact_id" => Contact::factory(),

			"country_id" => $countryId,

			"type" => $type->value,

			"value" => $value,
		];
	}

	/**
	 * Indicate that the contact method is of url type.
	 */
	public function url(): Factory
	{
		return $this->state(
			fn(array $attributes) => [
				"type" => ContactMethodType::Url->value,

				"country_id" => null,

				"value" => fake()->url(),
			]
		);
	}

	/**
	 * Indicate that the contact method is of email type.
	 */
	public function email(): Factory
	{
		return $this->state(
			fn(array $attributes) => [
				"type" => ContactMethodType::Email->value,

				"country_id" => null,

				"value" => fake()->email(),
			]
		);
	}

	/**
	 * Indicate that the contact method is of landline type.
	 */
	public function landline(): Factory
	{
		return $this->state(
			fn(array $attributes) => [
				"type" => ContactMethodType::Landline->value,

				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Landline->value),
			]
		);
	}

	/**
	 * Indicate that the contact method is of mobile type.
	 */
	public function mobile(): Factory
	{
		return $this->state(
			fn(array $attributes) => [
				"type" => ContactMethodType::Mobile->value,

				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Mobile->value),
			]
		);
	}

	/**
	 * Indicate that the contact method is of fax type.
	 */
	public function fax(): Factory
	{
		return $this->state(
			fn(array $attributes) => [
				"type" => ContactMethodType::Fax->value,

				"country_id" => Country::inRandomOrder()->first()->id,

				"value" => fake()->regexify(PhoneValueRegex::Landline->value),
			]
		);
	}
}
