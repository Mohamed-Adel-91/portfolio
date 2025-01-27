<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

final class PageOption extends Enum
{
    const HOME = 1;
    const ABOUT = 2;
    const RESUME = 3;
    const PORTFOLIO = 4;
    const PROJECTS = 5;
    const CONTACT = 6;


    public static function getDescription($value): string
    {
        switch ($value) {
            case self::HOME:
                return 'Home';
            case self::ABOUT:
                return 'About';
            case self::RESUME:
                return 'Resume';
            case self::PORTFOLIO:
                return 'Portfolio';
            case self::PROJECTS:
                return 'Projects';
            case self::CONTACT:
                return 'Contact';
            default:
                return parent::getDescription($value);
        }
    }
}
