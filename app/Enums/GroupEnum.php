<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GroupEnum extends Enum
{
    const ADMIN =   0;
    const EMPLOYEE =   1;
    const CUSTOMER = 2;
}
