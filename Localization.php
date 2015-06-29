<?php
require_once 'GetterSetter.php';

class Localization extends GetterSetter
{
    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->load($params);
    }

    /**
     * Measurement Update Function
     *
     * That's where we are scanning the world trying to find the place where are at.
     * Updates the internal probability matrix
     *
     * @param $input
     * @param Robot $robot
     * @return $this
     */
    public function sense($input, Robot $robot)
    {
        $retVal = [];
        // Update measurement
        foreach ($robot->getProbabilityMatrix() as $index => $p) {
            if ($input == $robot->getWorld()[$index]) {
                $retVal[] = $robot->getPHit() * $p;
            } else {
                $retVal[] = $robot->getPMiss() * $p;
            }
        }

        // Normalize data
        $normalisationFactor = array_sum($retVal);
        foreach($retVal as $index=>$value) {
            $retVal[$index] = $retVal[$index] * (1 / $normalisationFactor);
        }

        $robot->setProbabilityMatrix($retVal);
        return $this;
    }
}
