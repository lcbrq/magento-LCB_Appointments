<?php

/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Block_Adminhtml_Appointments extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {

        $this->_controller = "adminhtml_appointments";
        $this->_blockGroup = "appointments";
        $this->_headerText = Mage::helper("appointments")->__("Appointments Manager");
        $this->_addButtonLabel = Mage::helper("appointments")->__("Add New Item");
        parent::__construct();
    }

}
