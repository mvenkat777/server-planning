<?php
declare(strict_types=1);

namespace ServerPlanning;

final class Server
{
    /** @var int */
    private $cpu;
    /** @var int */
    private $ram;
    /** @var int */
    private $hdd;

    /**
     * @param $cpu int - max available CPU units
     * @param $ram int - max available RAG Gb
     * @param $hdd int - max available HDD Gb
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = self::validateResource('CPU', $cpu);

        // for simplicity assuming that RAM and HDD provisioned without decimal parts
        // otherwise use other validation method
        $this->ram = self::validateResource('RAM', $ram);
        $this->hdd = self::validateResource('HDD', $hdd);
    }

    /**
     * @return int
     */
    public function getCpu(): int
    {
        return $this->cpu;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getHdd(): int
    {
        return $this->hdd;
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
}
