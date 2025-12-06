<?php

namespace App\Enums;

enum SkillType: string
{
    case BACKEND = 'backend';
    case FRONTEND = 'frontend';
    case DEVOPS = 'devops';
    case TESTING = 'testing';
    case TOOLS = 'tools';
    case GENERAL = 'general';
    case PERSONAL_SKILLS = 'personal_skills';

    public function label(): string
    {
        return match ($this) {
            self::BACKEND => 'Backend',
            self::FRONTEND => 'Frontend',
            self::DEVOPS => 'DevOps',
            self::TESTING => 'Testing',
            self::TOOLS => 'Tools',
            self::GENERAL => 'General',
            self::PERSONAL_SKILLS => 'Personal Skills',
        };
    }
}
