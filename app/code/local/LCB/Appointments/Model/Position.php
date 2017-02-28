<?php
/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Model_Position {

    public function toOptionArray()
    {
        return array(
            array('value' => 'links', 'label' => 'Górne menu'),
            array('value' => 'menu', 'label' => 'Główne menu')
        );
    }

}
