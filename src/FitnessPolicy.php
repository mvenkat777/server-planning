<?php


namespace ServerPlanning;


interface FitnessPolicy
{
    public function host(VirtualMachine $vm): void;
    public function instances(): int;
}
