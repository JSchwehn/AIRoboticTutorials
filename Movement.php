<?php

class Movement {

    private $biasMatrix = [
        'over' => 0.,
        'under' => 0.,
        'exact' => 1.
    ];

    /**
     * @param array $biasMatrix
     */
    public function __construct(array $biasMatrix = [])
    {
        if (
            !isset($biasMatrix['over']) &&
            !isset($biasMatrix['under']) &&
            !isset($biasMatrix['exact'])
        ) {
            return;
        }
        $this->biasMatrix = array_merge($this->biasMatrix, $biasMatrix);
        foreach ($biasMatrix as $key => $value) {
            $this->biasMatrix[$key] = (float)$value;
        }

    }

    public function move($p, $U)
    {
        $retVal = [];

        $l = count($p);
        foreach ($p as $i => $value) {

            $s = $p[$this->mod(($i - $U), $l)] * $this->getExactHit();
            $s += $p[$this->mod(($i - $U - 1), $l)] * $this->getUnderShoot();
            $s += $p[$this->mod(($i - $U + 1), $l)] * $this->getOverShoot();

            array_push($retVal, $s);
        }

        return $retVal;
    }

    /**
     * Fun fact PHP calculates mod with negative numbers wrong - who thought that?
     *
     * @param $a
     * @param $n
     * @return int
     */
    private function mod($a, $n)
    {
        return ($a % $n) + ($a < 0 ? $n : 0);
    }

    private function getExactHit()
    {
        return $this->biasMatrix['exact'];
    }

    private function getUnderShoot()
    {
        return $this->biasMatrix['under'];
    }

    private function getOverShoot()
    {
        return $this->biasMatrix['over'];
    }



}