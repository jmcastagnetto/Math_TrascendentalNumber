<?php

require_once 'PEAR.php';

class Math_TrascendentalNumber_Common {

    var $ndecs;
    var $lastValue;
    var $lastStr;

    function Math_TrascendentalNumber_Common($ndecs=20) {
        $this->setNumberOfDecimals($ndecs);
    }

    function setNumberOfDecimals($ndecs) {
        if (is_null($this->ndecs) || $this->ndecs != $ndecs) {
            $this->ndecs = $ndecs;
            $this->lastValue = null;
            $this->lastStr = null;
            $this->_init();
        }
    }

    function getValue() {
        if (is_null($this->lastValue)) {
            $this->lastValue = $this->_calc();
        }
        return $this->lastValue;
    }

    function toString() {
        if (is_null($this->lastStr)) {
            $this->lastStr = $this->_formatValue($this->getValue());
        }
        return $this->lastStr;
    }
}

?>
