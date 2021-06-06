<?php

/**
 * Class DataLayer
 */
class DataLayer
{
    static function getIndoors(): array
    {
        return array("TV", "movies", "cooking", "board games",
            "puzzles", "reading", "playing cards", "video games");
    }

    static function getOutdoors(): array
    {
        return array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
    }

    static function getStates(): array
    {
        return array('Choose a State','Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware',
            'District of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas',
            'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
            'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
            'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington',
            'West Virginia', 'Wisconsin', 'Wyoming');
    }
}



