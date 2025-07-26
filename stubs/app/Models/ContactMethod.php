<?php

namespace App\Models;

use Nnjeim\World\Models\Country;

use Illuminate\Database\Eloquent\{
	Factories\HasFactory,
	Relations\BelongsTo,
	Model,
};

class ContactMethod extends Model
{
	/** @use HasFactory<\Database\Factories\ContactMethodFactory> */
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ["country_id", "type", "value"];

	/**
	 * Get the contact that owns the contact method.
	 */
	public function contact(): BelongsTo
	{
		return $this->belongsTo(Contact::class);
	}

	/**
	 * Get the country that owns the contact method.
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Country::class);
	}
}
