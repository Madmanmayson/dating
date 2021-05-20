<?php

class DataLayer
{
    /**
     * @return string[] a array of all possible indoor interests
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
     * @return string[] a array of all possible outdoor interests
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

    public static function getGenders(): array
    {
        return array(
            "male",
            "female",
            "other"
        );
    }
}