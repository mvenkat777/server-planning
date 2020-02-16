<?php
declare(strict_types=1);


namespace ServerPlanning;


class VirtualMachine
{
    /**
     * @var int
     */
    private $cpu;
    /**
     * @var int
     */
    private $ram;
    /**
     * @var int
     */
    private $hdd;

    /**
     * VirtualMachine constructor.
     * @param $cpu int
     * @param $ram int
     * @param $hdd int
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = self::validateResource('CPU', $cpu);

        // for simplicity assuming that RAM and HDD provisioned without decimal parts
        // otherwise use other validation method
        $this->ram = self::validateResource('RAM', $ram);
        $this->hdd = self::validateResource('HDD', $hdd);
    }

    private static function validateResource($resource, $input)
    {
        $value = filter_var($input, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 1
            ],
        ]);

        if (!$value) {
            throw new InvalidResourceProvisionException($resource, $value);
        }

        return $value;
    }

    public function getCpu(): int {
        return $this->cpu;
    }

    public function getRam(): int
    {
        return $this->ram;
    }

    public function getHdd(): int
    {
        return $this->hdd;
    }
}
