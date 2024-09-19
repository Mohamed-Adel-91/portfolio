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
    const Home = 'Home';
    const AboutUs = 'about-us';
    const OurFleet = 'our-Fleet';
    const ContactUs = 'Contact-Us';
    const WhatsNew = 'Whats-New';
    const Careers = 'Careers';
    const Services = 'Services';
    const FAQs = 'FAQs';
    const HelpCenter = 'Help-Center';
    const Terms = 'Terms';
    const ourTeam = 'Our-Team';
    const blog = 'Blog';
    const cargoTerminal = 'Cargo-Terminal';
    const certificates = 'Certificates';
    const ourFleets = 'Our-Fleets';
    const partners = 'Partners';
    const privacyPolicy = 'Privacy-Policy';
    const ourCoverage = 'Our-Coverage';

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Home:
                return 'Home';
            case self::AboutUs:
                return 'about-us';
            case self::OurFleet:
                return 'our-Fleet';
            case self::ContactUs:
                return 'Contact-Us';
            case self::WhatsNew:
                return 'Whats-New';
            case self::Careers:
                return 'Careers';
            case self::Services:
                return 'Services';
            case self::FAQs:
                return 'FAQs';
            case self::HelpCenter:
                return 'Help-Center';
            case self::Terms:
                return 'Terms';
            case self::ourTeam:
                return 'Our-Team';
            case self::blog:
                return 'Blog';
            case self::cargoTerminal:
                return 'Cargo-Terminal';
            case self::ourFleets:
                return 'Our-Fleets';
            case self::partners:
                return 'Partners';
            case self::privacyPolicy:
                return 'Privacy-Policy';
            case self::ourCoverage:
                return 'Our-Coverage';
            default:
                return parent::getDescription($value);
        }
    }
}
