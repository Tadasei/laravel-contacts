<?php

namespace App\Models;

use App\Enums\ContactableType;

use Illuminate\Database\Eloquent\{
	Factories\HasFactory,
	Relations\HasMany,
	Relations\MorphTo,
	Model
};

class Contact extends Model
{
	/** @use HasFactory<\Database\Factories\ContactFactory> */
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ["details"];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			"contactable_type" => ContactableType::class,

			"details" => "array",
		];
	}

	/**
	 * Get the contact methods for the contact.
	 */
	public function contactMethods(): HasMany
	{
		return $this->hasMany(ContactMethod::class);
	}

	/**
	 * Get the parent contactable model.
	 */
	public function contactable(): MorphTo
	{
		return $this->morphTo();
	}
}
