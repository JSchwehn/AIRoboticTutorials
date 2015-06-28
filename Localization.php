<?php
require_once 'GetterSetter.php';

class Localization extends GetterSetter
{
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
     * @return $this
     */
    public function sense($input)
    {
        $retVal = [];
        // Update measurement
        foreach ($this->getProbabilityMatrix() as $index=>$p) {
            if($input == $this->getWorld()[$index]) {
                $retVal[] = $this->getPHit() * $p;
            } else {
                $retVal[] = $this->getPMiss() * $p;
            }
        }

        // Normalize data
        $normalisationFactor = array_sum($retVal);
        foreach($retVal as $index=>$value) {
            $retVal[$index] = $retVal[$index] * (1 / $normalisationFactor);
        }

        $this->setProbabilityMatrix($retVal);
        print_r($this->config);
        return $this;
    }

    public function showProbabilityMatrix()
    {
        //var_export($this->getProbabilityMatrix());
    }
}
