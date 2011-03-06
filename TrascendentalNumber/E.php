<?php

require_once 'Math/TrascendentalNumber/Common.php';

class Math_TrascendentalNumber_E extends Math_TrascendentalNumber_Common {

    var $nloops;

    function _init() {
        bcscale($this->ndecs + 5);
        $this->nloops = $this->ndecs * 2;
    }

    function _calc() {
        $e = 2;
        $f = 1;
        for ($j=0; $j < $this->nloops; $j++) {
            $f = bcdiv($f, $j+2);
            $e = bcadd($e, $f);
        }
        return $e;
    }

    function _formatValue($value) {
        $decs = $this->ndecs;
        $out = "e = 2.\n     ";
        $groups = 5;
        $offset = 2;
        $count = 10;
        $length = $decs + 2;
        $n = 0; 
        while ($offset < $length) {
            $out .= substr($value, $offset, $count)." ";
            $offset += $count;
            $n++;
            if ($n % $groups == 0) {
                $out .= "  [".($n * 10)."]\n     ";
            }
            if ($offset >= $length) {
                break;
            }
        }
        return $out."\n";
    }
}
?>
