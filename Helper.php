<?php

class Helper
{

    public static function shift(array $arr, $steps)
    {
        if (!is_int($steps)) {
            throw new InvalidArgumentException(
                'steps has to be an (int)');
        }

        if ($steps === 0) {
            return $arr;
        }

        $l = count($arr);

        if ($l === 0) {
            return $arr;
        }

        $steps = $steps % $l;
        $steps *= -1;

        $retVal = array_merge(array_slice($arr, $steps),
            array_slice($arr, 0, $steps));

        return $retVal;
    }

}

