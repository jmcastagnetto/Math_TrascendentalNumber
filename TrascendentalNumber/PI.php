<?php
require_once 'Math/TrascendentalNumber/Common.php';

define("_MTN_PI_A", "545140134");
define("_MTN_PI_B", "13591409");
define("_MTN_PI_C", "640320");
define("_MTN_PI_D", bcpow(_MTN_PI_C, 3));
define("_MTN_PI_E", _MTN_PI_C/2);
define("_MTN_PI_BIG_INT_", 1000000);
    
class Math_TrascendentalNumber_PI extends Math_TrascendentalNumber_Common {

    var $nloops;

    function _init() {
        bcscale($this->ndecs);
        if (bccomp($this->ndecs, _MTN_PI_BIG_INT_) == 1) {
            $this->nloops = bcadd(bcdiv($this->ndecs, 14, 0), 1);
        } else {
            $this->nloops = ceil($this->ndecs, 14);
        }

    }

    function _calc() {
        $n = 0;
        $total = 0;

        do {
            $lastn = (int)substr($n,-1,1);
            $d1a = ($lastn % 2 == 0) ? 1 : -1;
            $d1b = $this->_fact(6*$n);
            $d1c = bcadd(bcmul(_MTN_PI_A, $n), _MTN_PI_B);
            $d1 = bcmul(bcmul($d1a, $d1b), $d1c);
            $d2a = bcpow($this->_fact($n),3);
            $d2b = $this->_fact(3*$n);
            $d2c = bcpow(_MTN_PI_D, $n);
            $d2 = bcmul(bcmul($d2a, $d2b), $d2c);
            $total = bcadd($total, bcdiv($d1, $d2));
            if ((bccomp($n, _MTN_PI_BIG_INT_, 0) == -1) 
                && (bccomp($this->nloops, _MTN_PI_BIG_INT_, 0) == -1)) {
                $n++;
                $flag = ($n < $this->nloops);
            } else {
                $n = bcadd($n, 1, 0);
                $flag = (bccomp($n, $this->nloops, 0) == -1);
            }
        } while ($flag);
        return bcdiv(bcmul(_MTN_PI_E, bcsqrt(_MTN_PI_C)), bcmul(6,$total));
    }

    function _fact($n) {
        if ($n == 0) { return 1; }
        if (bccomp($n, _MTN_PI_BIG_INT_, 0) == -1) {
            $r = $n--;
            while ($n > 1) {
                $r = bcmul($r, $n--);
            }
        } else {
            $r = $n;
            $n = bcsub($n, 1);
            while (bccomp($n, 1) == 1) {
                $r = bcmul($r, $n);
                $n = bcsub($n, 1);
            }
        }
        return $r;

    }

    function _formatValue($value) {
        $out = "PI = 3.\n     ";
        $groups = 5;
        $offset = 2;
        $count = 10;
        $length = strlen($value);
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
