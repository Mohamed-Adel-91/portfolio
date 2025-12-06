<?php

namespace App\Enums;

enum SkillType: string
{
    case BACKEND = 'backend';
    case DATABASE = 'database';
    case FRONTEND = 'frontend';
    case DEVOPS = 'devops';
    case DATA_SCIENCE_AND_ANALYTICS = 'data_science_and_analytics';
    case TESTING = 'testing';
    case TOOLS = 'tools';
    case GENERAL = 'general';
    case PERSONAL_SKILLS = 'personal_skills';

    public function label(): string
    {
        return match ($this) {
            self::BACKEND => 'Backend',
            self::DATABASE => 'Database',
            self::FRONTEND => 'Frontend',
            self::DEVOPS => 'DevOps',
            self::DATA_SCIENCE_AND_ANALYTICS => 'Data Science & Analytics',
            self::TESTING => 'Testing',
            self::TOOLS => 'Tools',
            self::GENERAL => 'General',
            self::PERSONAL_SKILLS => 'Personal Skills',
        };
    }
}
