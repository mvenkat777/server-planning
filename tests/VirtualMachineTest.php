<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InvalidResourceProvisionException;
use ServerPlanning\VirtualMachine;

final class VirtualMachineTest extends TestCase
{

    public function test_virtual_machine_cpu_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $vm = new VirtualMachine(0, 1, 1);
    }

    public function test_server_ram_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $vm = new VirtualMachine(1, 0, 1);
    }

    public function test_server_hdd_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $vm = new VirtualMachine(1, 1, 0);
    }
}
