<?php

/**
 * Appointments module 
 *
 * @category   LCB
 * @package    LCB_Slides
 * @author     Silpion Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_Appointments_Block_Adminhtml_Appointments_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId("appointmentsGrid");
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("appointments/appointments")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("id", array(
            "header" => Mage::helper("appointments")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "id",
        ));

        $this->addColumn("firstname", array(
            "header" => Mage::helper("appointments")->__("First Name"),
            "index" => "firstname",
        ));
        $this->addColumn("lastname", array(
            "header" => Mage::helper("appointments")->__("Last Name"),
            "index" => "lastname",
        ));
        $this->addColumn("email", array(
            "header" => Mage::helper("appointments")->__("Email"),
            "index" => "email",
        ));
        $this->addColumn("telephone", array(
            "header" => Mage::helper("appointments")->__("Telephone"),
            "index" => "telephone",
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_appointments', array(
            'label' => Mage::helper('appointments')->__('Remove Appointments'),
            'url' => $this->getUrl('*/adminhtml_appointments/massRemove'),
            'confirm' => Mage::helper('appointments')->__('Are you sure?')
        ));
        return $this;
    }

}
