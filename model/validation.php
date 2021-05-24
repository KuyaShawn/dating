<?php

    // returns true if name is valid
    function validName($name)
    {
        return preg_match('/^[a-zA-Z]+$/', $name) == 1;
    }

    function validAge($age)
    {
        if (!empty($age) && is_numeric($age) && $age >= 18 || $age <= 118) {
            return true;
        }
        return false;

    }

    function validPhone($phone)
    {
        $pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
        return preg_match($pattern, $phone) == 1;

    }

    function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return true;
        }
        return false;
    }

    function validOutdoor($outdoor)
    {
        $validOutdoor = getOutdoors();
        if (!empty($outdoor))
        {
            foreach ($outdoor as $userOutdoor)
            {
                if (!in_array($userOutdoor, $validOutdoor))
                {
                    return false;
                }
            }
        }

        // if choices value is valid and value name isn't changed
        return true;
    }

    function validIndoor($indoor)
    {
        $validIndoor = getIndoors();
        if (!empty($indoor))
        {
            foreach ($indoor as $userIndoor)
            {
                if (!in_array($userIndoor, $validIndoor))
                {
                    return false;
                }
            }
        }
        // if choices value is valid and value name isn't changed
        return true;
    }
