<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create("contact_methods", function (Blueprint $table) {
			$table->id();

			$table
				->foreignId("contact_id")
				->constrained()
				->cascadeOnDelete()
				->restrictOnUpdate();

			$table
				->foreignId("country_id")
				->nullable()
				->constrained()
				->cascadeOnDelete()
				->restrictOnUpdate();

			$table->string("type");

			$table->string("value");

			$table->unique(["country_id", "type", "value"]);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("contact_methods");
	}
};
