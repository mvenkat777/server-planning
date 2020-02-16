Server-Planning
===

Library for server usage planning.


Basic Usage
---
```php
<?php

use ServerPlanning\ServerPanning;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

// create a server type specification
$serverType = new Server(2, 32, 100); // cpu, ram, hdd

// create a list of VMs specifications
$vms = [
    new VirtualMachine(1, 16, 10), // cpu, ram, hdd
];

$planner = new ServerPanning();
// calculate required amount of servers of given type
$instancesRequired = $planner->calculate($serverType, $vms);
```

Requirements
---

PHP 7.1 or above

TODO:
---
1. Hide Server and VirtualMachine creation behind ServerPanning facade.
this will let remove unnecessary imports and simplify usage:

```php
<php

use ServerPlanning\ServerPanning;

$planner = new ServerPanning();

$planner->calculate(
    $planner->server(2, 32, 100),
    [
        $planner->vm(1, 16, 10),
    ]
)
```