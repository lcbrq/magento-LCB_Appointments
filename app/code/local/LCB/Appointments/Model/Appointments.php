<?php
/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Model_Appointments extends Mage_Core_Model_Abstract {

    protected function _construct()
    {
        $this->_init("appointments/appointments");
    }

}
