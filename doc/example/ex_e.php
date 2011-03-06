<?php

require_once 'Math/TrascendentalNumber/E.php';

$ndecs = (isset($argv[1])) ? $argv[1] : 100;
$e = new Math_TrascendentalNumber_E($ndecs);
echo $e->toString();
?>
