<?php

class Movement {

//    private

    public function __construct()
    {

    }

    public function getMotions()
    {
        // two steps forward.
        return [1,1];
    }

    public function move($p, $units)
    {
        $p = Helper::shift($p, $units);

        return $p;
    }



}