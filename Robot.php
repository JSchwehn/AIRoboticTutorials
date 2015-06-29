<?php

/**
 * @method array getProbabilityMatrix()
 * @method Localization setProbabilityMatrix(array $probabilityMatrix)
 *
 * @method float getPHit()
 * @method Localization setPHit(float $pHit)
 *
 * @method float getPMiss()
 * @method Localization setPMiss(float $pMiss)
 *
 * @method array getWorld()
 * @method Localization setWorld(float $world)
 */
class Robot extends GetterSetter {

    /** @var Sensors  */
    private $sensors      = null;
    /** @var Localization  */
    private $localization = null;
    /** @var Movement  */
    private $movement     = null;

    public function __construct(array $config) {
        $this->load($config);
    }

    /**
     * @return Sensors
     */
    public function getSensor()
    {
        return $this->sensors;
    }

    /**
     * @param Sensors $sensor
     * @return $this
     */
    public function setSensor(Sensors $sensor)
    {
        $this->sensors = $sensor;

        return $this;
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

        return $this->getLocalization()->sense($input, $this);
    }

    /**
     * @return Localization
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * @param Localization $localization
     * @return $this
     */
    public function setLocalization(Localization $localization)
    {
        $this->localization = $localization;

        return $this;
    }

    public function move($units)
    {
        $move = $this->getMovement()->move($this->getProbabilityMatrix(),$units);
        $this->setProbabilityMatrix($move);
    }

    /**
     * @return Movement
     */
    public function getMovement()
    {
        return $this->movement;
    }

    /**
     * @param movement
     * @return $this
     */
    public function setMovement(Movement $movement)
    {
        $this->movement = $movement;
        return $this;
    }

    public function showWorld()
    {
        var_export($this->getProbabilityMatrix());
    }

}