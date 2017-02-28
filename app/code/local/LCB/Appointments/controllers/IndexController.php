<?php

class LCB_Appointments_IndexController extends Mage_Core_Controller_Front_Action {

    public function IndexAction()
    {

        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("Make an appointment"));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
            "label" => $this->__("Home Page"),
            "title" => $this->__("Home Page"),
            "link" => Mage::getBaseUrl()
        ));

        $breadcrumbs->addCrumb("Make an appointment", array(
            "label" => $this->__("Make an appointment"),
            "title" => $this->__("Make an appointment")
        ));

        $this->renderLayout();
    }

    public function AjaxAction()
    {
        $this->loadLayout();
        $this->getLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {

        $data = $this->getRequest()->getParams();

        $appointment = Mage::getModel('appointments/appointments')->load();

        $appointment->setFirstname($data['firstname']);
        $appointment->setLastname($data['lastname']);
        $appointment->setEmail($data['email']);
        $appointment->setTelephone($data['telephone']);
        $appointment->setMessage($data['message']);

        $appointment->save();

        $storeName = Mage::getStoreConfig('trans_email/ident_general/name');
        $storeEmail = Mage::getStoreConfig('trans_email/ident_general/email');

        $customerEmail = $data['email'];

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault('lcb_appointments_template');

        $emailTemplate->setTemplateSubject('Prośba o spotkanie');

        $emailTemplate->setSenderName($storeName);
        $emailTemplate->setSenderEmail($storeEmail);

        $emailTemplateVariables = array();
        $emailTemplateVariables['firstname'] = $data['firstname'];
        $emailTemplateVariables['lastname'] = $data['lastname'];
        $emailTemplateVariables['telephone'] = $data['telephone'];
        $emailTemplateVariables['email'] = $data['email'];
        $emailTemplateVariables['message'] = $data['message'];

        try {
            $emailTemplate->send($storeEmail, null, $emailTemplateVariables);
            Mage::getSingleton('core/session')->addSuccess('Pomyślnie wysłano');
        } catch (Exception $error) {
            Mage::getSingleton('core/session')->addError($error->getMessage());
        }

        $this->_redirect('*/*/');
    }

}
