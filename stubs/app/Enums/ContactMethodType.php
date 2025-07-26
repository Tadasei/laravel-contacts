<?php

namespace App\Enums;

enum ContactMethodType: string
{
	case Url = "url";

	case Email = "email";

	case Landline = "landline";

	case Mobile = "mobile";

	case Fax = "fax";
}
