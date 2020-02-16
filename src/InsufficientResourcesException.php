<?php
declare(strict_types=1);


namespace ServerPlanning;


class InsufficientResourcesException extends \DomainException
{
    static function cpu(Server $serverType, VirtualMachine $vm)
    {
        return new self(strtr("Can not host VM on this server. {available} CPU < {required} CPU", [
            '{available}' => $serverType->getCpu(),
            '{required}' => $vm->getCpu(),
        ]));
    }

    static function ram(Server $serverType, VirtualMachine $vm)
    {
        return new self(strtr("Can not host VM on this server. {available} RAM < {required} RAM", [
            '{available}' => $serverType->getRam(),
            '{required}' => $vm->getRam(),
        ]));
    }

    static function hdd(Server $serverType, VirtualMachine $vm)
    {
        return new self(strtr("Can not host VM on this server. {available} HDD < {required} HDD", [
            '{available}' => $serverType->getHdd(),
            '{required}' => $vm->getHdd(),
        ]));
    }
}
