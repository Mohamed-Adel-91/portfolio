<?php

declare (strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

final class SectionOption extends Enum
{
    const HomeFirstBanner = 'Home-first-banner';
    const HomeOurHistory = 'homeOurHistory';
    const HomeOurFleet = 'homeOurFleet';
    const HomeServices = 'homeServices';
    const HomeHelpCenter = 'homeHelpCenter';
    const AboutUsFirstBanner = 'about-us-first-banner';
    const AboutUsOurHistory = 'about-us-ourHistory';
    const AboutUsOurServices = 'about-us-ourServices';
    const AboutUsOurDna = 'about-us-ourDna';
    const AboutUsTeams = 'about-us-teams';
    const AboutUsJoinUs = 'about-us-joinUs';
    const OurFleetFirstBanner = 'our-Fleet-first-banner';
    const OurFleetSecondSection = 'our-Fleet-second-section';
    const OurFleetOurServices = 'our-Fleet-ourServices';
    const OurFleetTransparency = 'our-Fleet-Transparency';
    const ContactUsStartBanner = 'Contact-Us-start-banner';
    const ContactUsHelpCenter = 'Contact-Us-Help-Center';
    const ContactUsLastSection = 'Contact-Us-Last-Section';
    const WhatsNewStartSection = 'Whats-New-Start-Section';
    const WhatsNewSecondSection = 'Whats-New-Second-Section';
    const CareersStartBanner = 'Careers-Start-Banner';
    const CareersSecondSection = 'Careers-second-section';
    const CareersLastSection = 'Careers-last-section';
    const ServicesStartSection = 'Services-start-section';
    const ServicesCardSection = 'Services-card-section';
    const FAQsStartSection = 'FAQs-start-section';
    const HelpCenterStartSection = 'Help-Center-start-section';
    const HelpCenterCardSection = 'Help-Center-card-section';
    const TermsStartSection = 'Terms-start-section';
    const TermsCardSection = 'Terms-card-section';
    const TermsContactSection = 'Terms-contact-section';
    const OurTeamStartBanner = 'Our-Team-Start-Banner';
    const OurTeamTopManagement = 'Our-Team-Top-Management';
    const OurTeamTopGroup = 'Our-Team-Top-Group';
    const BlogStartBanner = 'Blog-Start-Banner';
    const BlogMedia = 'Blog-Media';
    const CargoTerminalStartBanner = 'Cargo-Terminal-Start-Banner';
    const CargoTerminalTabs = 'Cargo-Terminal-Tabs';
    const CertificatesStartBanner = 'Certificates-Start-Banner';
    const CertificatesGeneralFiles = 'Certificates-General-Files';
    const OurFleetsStartBanner = 'Our-Fleets-Start-Banner';
    const OurFleetsFreighterFleet = 'Our-Fleets-Freighter-Fleet';
    const OurFleetsPassengerFleet = 'Our-Fleets-Passenger-Fleet';
    const PartnersStartBanner = 'Partners-Start-Banner';
    const privacyPolicyStartBanner = 'Privacy-Policy-Start-Banner';
    const privacyPolicyLastBanner = 'Privacy-Policy-Last-Banner';
    const ourCoverageStartBanner = 'Our-Coverage-Start-Banner';

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::HomeFirstBanner:
                return 'Home-first-banner';
            case self::HomeOurHistory:
                return 'homeOurHistory';
            case self::HomeOurFleet:
                return 'homeOurFleet';
            case self::HomeServices:
                return 'homeServices';
            case self::HomeHelpCenter:
                return 'homeHelpCenter';
            case self::AboutUsFirstBanner:
                return 'about-us-first-banner';
            case self::AboutUsOurHistory:
                return 'about-us-ourHistory';
            case self::AboutUsOurServices:
                return 'about-us-ourServices';
            case self::AboutUsOurDna:
                return 'about-us-ourDna';
            case self::AboutUsTeams:
                return 'about-us-teams';
            case self::AboutUsJoinUs:
                return 'about-us-joinUs';
            case self::OurFleetFirstBanner:
                return 'our-Fleet-first-banner';
            case self::OurFleetSecondSection:
                return 'our-Fleet-second-section';
            case self::OurFleetOurServices:
                return 'our-Fleet-ourServices';
            case self::OurFleetTransparency:
                return 'our-Fleet-Transparency';
            case self::ContactUsStartBanner:
                return 'Contact-Us-start-banner';
            case self::ContactUsHelpCenter:
                return 'Contact-Us-Help-Center';
            case self::ContactUsLastSection:
                return 'Contact-Us-Last-Section';
            case self::WhatsNewStartSection:
                return 'Whats-New-Start-Section';
            case self::WhatsNewSecondSection:
                return 'Whats-New-Second-Section';
            case self::CareersStartBanner:
                return 'Careers-Start-Banner';
            case self::CareersSecondSection:
                return 'Careers-second-section';
            case self::CareersLastSection:
                return 'Careers-last-section';
            case self::ServicesStartSection:
                return 'Services-start-section';
            case self::ServicesCardSection:
                return 'Services-card-section';
            case self::FAQsStartSection:
                return 'FAQs-start-section';
            case self::HelpCenterStartSection:
                return 'Help-Center-start-section';
            case self::HelpCenterCardSection:
                return 'Help-Center-card-section';
            case self::TermsStartSection:
                return 'Terms-start-section';
            case self::TermsCardSection:
                return 'Terms-card-section';
            case self::TermsContactSection:
                return 'Terms-contact-section';
            case self::OurTeamStartBanner:
                return 'Our-Team-Start-Banner';
            case self::OurTeamTopManagement:
                return 'Our-Team-Top-Management';
            case self::OurTeamTopGroup:
                return 'Our-Team-Top-Group';
            case self::BlogStartBanner:
                return 'Blog-Start-Banner';
            case self::BlogMedia:
                return 'Blog-Media';
            case self::CargoTerminalStartBanner:
                return 'Cargo-Terminal-Start-Banner';
            case self::CargoTerminalTabs:
                return 'Cargo-Terminal-Tabs';
            case self::CertificatesStartBanner:
                return 'Certificates-Start-Banner';
            case self::CertificatesGeneralFiles:
                return 'Certificates-General-Files';
            case self::OurFleetsStartBanner:
                return 'Our-Fleets-Start-Banner';
            case self::OurFleetsFreighterFleet:
                return 'Our-Fleets-Freighter-Fleet';
            case self::OurFleetsPassengerFleet:
                return 'Our-Fleets-Passenger-Fleet';
            case self::PartnersStartBanner:
                return 'Partners-Start-Banner';
            case self::privacyPolicyStartBanner:
                return 'Privacy-Policy-Start-Banner';
            case self::privacyPolicyLastBanner:
                return 'Privacy-Policy-Last-Banner';
            case self::ourCoverageStartBanner:
                return 'Our-Coverage-Start-Banner';
            default:
                return parent::getDescription($value);
        }
    }
}
