<?php

require_once 'Math/TrascendentalNumber/PI.php';

$ndecs = (isset($argv[1])) ? $argv[1] : 100;
$pi = new Math_TrascendentalNumber_PI($ndecs);
echo $pi->toString();
?>
