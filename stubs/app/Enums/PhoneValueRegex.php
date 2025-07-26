<?php

namespace App\Enums;

enum PhoneValueRegex: string
{
	case Mobile = "/^[1-9]\d{8,14}$/";

	case Landline = "/^[1-9]\d{6,11}$/";
}
