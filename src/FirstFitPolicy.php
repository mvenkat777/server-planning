<?php
declare(strict_types=1);


namespace ServerPlanning;


class FirstFitPolicy implements FitnessPolicy
{
    /** @var Server */
    private $serverType;
    /** @var int */
    private $availableCpu = 0;
    /** @var int */
    private $availableRam = 0;
    /** @var int */
    private $availableHdd = 0;
    /** @var int */
    private $instances = 0;
    /**
     * FirstFitPolicy constructor.
     * @param Server $serverType
     */
    public function __construct(Server $serverType)
    {
        $this->serverType = $serverType;
    }

    private function canHost(VirtualMachine $vm): bool
    {
        return $this->availableCpu >= $vm->getCpu() &&
            $this->availableRam >= $vm->getRam() &&
            $this->availableHdd >= $vm->getHdd();
    }

    private function next(): void
    {
        $this->availableCpu = $this->serverType->getCpu();
        $this->availableRam = $this->serverType->getRam();
        $this->availableHdd = $this->serverType->getHdd();

        $this->instances += 1;
    }

    /**
     * @param VirtualMachine $vm
     * @throws InsufficientResourcesException
     */
    public function host(VirtualMachine $vm): void
    {
        if (!$this->canHost($vm)) {
            $this->next();
        }

        $this->availableCpu -= $vm->getCpu();
        $this->availableRam -= $vm->getRam();
        $this->availableHdd -= $vm->getHdd();

        if ($this->availableCpu < 0) {
            throw InsufficientResourcesException::cpu($this->serverType, $vm);
        }

        if ($this->availableRam < 0) {
            throw InsufficientResourcesException::ram($this->serverType, $vm);
        }

        if ($this->availableHdd < 0) {
            throw InsufficientResourcesException::hdd($this->serverType, $vm);
        }
    }

    public function instances(): int
    {
        return $this->instances;
    }
}
