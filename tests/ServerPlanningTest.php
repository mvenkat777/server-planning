<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\Server;
use ServerPlanning\ServerPanning;
use ServerPlanning\VirtualMachine;

final class ServerPlanningTest extends TestCase
{
    public function test_needs_0_servers_if_VirtualMachines_list_is_empty(): void
    {
        $planner = new ServerPanning();
        $server = new Server(1, 1, 1);

        $this->assertEquals(0, $planner->calculate($server, []));
    }

    public function test_needs_1_server_if_VirtualMachine_fits_server(): void
    {
        $planner = new ServerPanning();
        $server = new Server(2, 32, 100);
        $vm = new VirtualMachine(1, 16, 10);

        $this->assertEquals(1, $planner->calculate($server, [$vm]));
    }

    public function test_needs_1_server_if_2_VirtualMachines_fits_server(): void
    {
        $planner = new ServerPanning();
        $server = new Server(2, 32, 100);
        $vms = [
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(1, 16, 10),
        ];

        $this->assertEquals(1, $planner->calculate($server, $vms));
    }

    public function test_needs_2_servers_when_server_can_host_biggest_vm(): void
    {
        $planner = new ServerPanning();
        $server = new Server(2, 32, 100);
        $vms = [
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(2, 32, 100),
        ];

        $this->assertEquals(2, $planner->calculate($server, $vms));
    }
}
