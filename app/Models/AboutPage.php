<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_heading',
        'hero_subheading',
        'story',
        'problem',
        'mission',
        'vision',
        'values',
        'building',
        'impact',
        'testimonial',
        'team_teaser',
        'cta_heading',
        'cta_text',
    ];

    /**
     * There should only ever be one About Page row.
     * This fetches it, or creates it with sensible defaults if it doesn't exist yet.
     */
    public static function getInstance(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'hero_heading'    => 'Our Story',
                'hero_subheading' => 'Limodzi tingathe — together we can.',
                'story'           => 'Chikondi Organisation was founded to change how mothers in Mpemba experience childbirth.',
                'problem'         => 'Access to safe birthing facilities remains a challenge for many families in our community.',
                'mission'         => 'To ensure no woman risks her life while giving life.',
                'vision'          => 'A community where every mother has access to safe, dignified maternal care.',
                'values'          => "Compassion: We care deeply for every mother and child we serve.\nCommunity: We believe change happens together.\nDignity: Every person deserves respect and care.\nAccessibility: Safe care should never be out of reach.",
                'building'        => 'We are finalizing a birth center in Mpemba equipped to serve mothers safely.',
                'impact'          => 'This center will serve mothers and children across the Mpemba community for generations to come.',
                'testimonial'     => '',
                'team_teaser'     => 'Meet the people making this mission possible.',
                'cta_heading'     => 'Help Us Finish What We Started',
                'cta_text'        => 'Your support brings us closer to opening the doors of the Mpemba birth center.',
            ]
        );
    }
}