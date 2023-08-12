<?php

declare(strict_types=1);

namespace App\Enums;

enum TokenAbilityEnum: string
{
    case ISSUE_ACCESS_TOKEN = 'issue-access-token';
    case ACCESS_API = 'access-api';
}
