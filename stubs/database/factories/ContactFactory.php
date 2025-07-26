<?php

namespace Database\Factories;

use App\Enums\ContactableType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$contactableType = fake()->randomElement(ContactableType::class);

		$contactableId = match ($contactableType) {
			ContactableType::User => User::factory(),
		};

		return [
			"contactable_type" => $contactableType->value,

			"contactable_id" => $contactableId,

			"details" => null,
		];
	}
}
