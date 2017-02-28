<?php

/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Model_Mysql4_Appointments_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct()
    {
        $this->_init("appointments/appointments");
    }

}
