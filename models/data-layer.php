<?php

class DataLayer
{
    /**
     * @return string[] an array of all possible indoor interests
     */
    public static function getIndoorInterests(): array
    {
        return array(
            "tv",
            "movies",
            "cooking",
            "board-games",
            "puzzles",
            "reading",
            "cards",
            "video-games"
        );
    }

    /**
     * @return string[] an array of all possible outdoor interests
     */
    public static function getOutdoorInterests(): array
    {
        return array(
            "hiking",
            "biking",
            "swimming",
            "collecting",
            "walking",
            "climbing"
        );
    }

    /**
     * @return string[] an array of all possible genders
     */
    public static function getGenders(): array
    {
        return array(
            "male",
            "female",
            "other"
        );
    }

    public static function getStates(): array
    {
        return array(
            'NONE'=>'Select a State',
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming',
        );
    }
}