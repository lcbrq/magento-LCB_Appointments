<?php
/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Block_Adminhtml_Appointments_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm()
    {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("appointments_form", array("legend" => Mage::helper("appointments")->__("Item information")));


        $fieldset->addField("firstname", "text", array(
            "label" => Mage::helper("appointments")->__("First Name"),
            "name" => "firstname",
        ));

        $fieldset->addField("lastname", "text", array(
            "label" => Mage::helper("appointments")->__("Last Name"),
            "name" => "lastname",
        ));

        $fieldset->addField("email", "text", array(
            "label" => Mage::helper("appointments")->__("Email"),
            "name" => "email",
        ));

        $fieldset->addField("telephone", "text", array(
            "label" => Mage::helper("appointments")->__("Telephone"),
            "name" => "telephone",
        ));

        $fieldset->addField("message", "textarea", array(
            "label" => Mage::helper("appointments")->__("Message"),
            "name" => "message",
        ));


        if (Mage::getSingleton("adminhtml/session")->getAppointmentsData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getAppointmentsData());
            Mage::getSingleton("adminhtml/session")->setAppointmentsData(null);
        } elseif (Mage::registry("appointments_data")) {
            $form->setValues(Mage::registry("appointments_data")->getData());
        }
        return parent::_prepareForm();
    }

}
