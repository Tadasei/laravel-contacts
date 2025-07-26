<?php

namespace App\Enums;

use App\Models\User;

enum ContactableType: string
{
	case User = User::class;
}
