<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InvalidResourceProvisionException;
use ServerPlanning\Server;

final class ServerTest extends TestCase
{
    public function test_server_cpu_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(0, 1, 1);
    }

    public function test_server_ram_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(1, 0, 1);
    }

    public function test_server_hdd_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(1, 1, 0);
    }
}
