<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nnjeim\World\Models\Country;

use App\Enums\{ContactMethodType, PhoneValueRegex};

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
}
