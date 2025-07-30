<?php

namespace App\Traits;

use App\Models\{
	Contact,
	ContactMethod
};

trait InteractsWithContactMethods
{
	protected function syncContactMethods(
		Contact $contact,
		array $contactMethods,
	): void {
		[$existingContactMethods, $newContactMethods] = collect(
			$contactMethods,
		)->partition(
			fn(array $contactMethod) => key_exists("id", $contactMethod),
		);

		$contact
			->contactMethods()
			->whereNotIn("id", $existingContactMethods->pluck("id")->all())
			->delete();

		if ($existingContactMethods->isNotEmpty()) {
			ContactMethod::upsert(
				$existingContactMethods->all(),
				["id"],
				["type", "country_id", "value"],
			);
		}

		if ($newContactMethods->isNotEmpty()) {
			$contact->contactMethods()->createMany($newContactMethods);
		}
	}
}
