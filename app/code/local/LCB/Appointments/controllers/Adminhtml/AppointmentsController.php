<?php
/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Adminhtml_AppointmentsController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("appointments/appointments")->_addBreadcrumb(Mage::helper("adminhtml")->__("Appointments  Manager"), Mage::helper("adminhtml")->__("Appointments Manager"));
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__("Appointments"));
        $this->_title($this->__("Manager Appointments"));

        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__("Appointments"));
        $this->_title($this->__("Appointments"));
        $this->_title($this->__("Edit Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("appointments/appointments")->load($id);
        if ($model->getId()) {
            Mage::register("appointments_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("appointments/appointments");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Appointments Manager"), Mage::helper("adminhtml")->__("Appointments Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Appointments Description"), Mage::helper("adminhtml")->__("Appointments Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("appointments/adminhtml_appointments_edit"))->_addLeft($this->getLayout()->createBlock("appointments/adminhtml_appointments_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("appointments")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction()
    {

        $this->_title($this->__("Appointments"));
        $this->_title($this->__("Appointments"));
        $this->_title($this->__("New Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("appointments/appointments")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register("appointments_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("appointments/appointments");

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Appointments Manager"), Mage::helper("adminhtml")->__("Appointments Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Appointments Description"), Mage::helper("adminhtml")->__("Appointments Description"));


        $this->_addContent($this->getLayout()->createBlock("appointments/adminhtml_appointments_edit"))->_addLeft($this->getLayout()->createBlock("appointments/adminhtml_appointments_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction()
    {

        $post_data = $this->getRequest()->getPost();


        if ($post_data) {

            try {



                $model = Mage::getModel("appointments/appointments")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();

                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Appointments was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setAppointmentsData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setAppointmentsData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam("id") > 0) {
            try {
                $model = Mage::getModel("appointments/appointments");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
                $this->_redirect("*/*/");
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel("appointments/appointments");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    /**
     * Export order grid to CSV format
     */
    public function exportCsvAction()
    {
        $fileName = 'appointments.csv';
        $grid = $this->getLayout()->createBlock('appointments/adminhtml_appointments_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction()
    {
        $fileName = 'appointments.xml';
        $grid = $this->getLayout()->createBlock('appointments/adminhtml_appointments_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

}
