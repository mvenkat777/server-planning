<?php
declare(strict_types=1);


namespace ServerPlanning;


class ServerPanning
{
    /**
     * @param Server $serverType
     * @param VirtualMachine[] $virtualMachines
     * @return int
     */
    public function calculate(Server $serverType, array $virtualMachines): int
    {
        if (count($virtualMachines) == 0) {
            return 0;
        }

        $policy = new FirstFitPolicy($serverType);
        foreach ($virtualMachines as $vm) {
            $policy->host($vm);
        }

        return $policy->instances();
    }
}
