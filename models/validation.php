<?php

class Validation
{
    /**
     * @param string $name the name to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validPartialName(string $name): bool
    {
        return preg_match("/^[a-zA-Z]+$/", $name);
    }

    /**
     * @param string $name the name to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validFullName(string $name): bool
    {
        return preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $name);
    }

    /**
     * @param integer $age the age to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validAge(int $age): bool
    {
        return ($age >= 18 && $age <= 118);
    }

    /**
     * @param string $phone the  number to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validPhone(string $phone): bool
    {
        return preg_match("/^\(?[0-9]{3}\)?[ .-]?[0-9]{3}[ .-]?[0-9]{4}$/", $phone);
    }

    /**
     * @param array $outdoor the outdoor interests to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validOutdoor(array $outdoor): bool
    {
        $options = DataLayer::getOutdoorInterests();
        foreach ($outdoor as $interest)
        {
            if(!in_array($interest, $options)){
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $indoor the indoor interests to validate
     * @return bool returns true if valid, otherwise false
     */
    public static function validIndoor(array $indoor): bool
    {
        $options = DataLayer::getIndoorInterests();
        foreach ($indoor as $interest)
        {
            if(!in_array($interest, $options)){
                return false;
            }
        }

        return true;
    }
}