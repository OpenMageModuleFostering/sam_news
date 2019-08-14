<?php

class Sam_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("newsGrid");
				$this->setDefaultSort("news_id");
				$this->setDefaultDir("ASC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("news/news")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("news_id", array(
				"header" => Mage::helper("news")->__("ID"),
				"align" =>"center",
				"width" => "50px",
				"index" => "news_id",
				));
                
				$this->addColumn('image', array(
          'header'    => Mage::helper('news')->__('Image'),
          'align'     =>'left',
		  "width" => "80px",
          'index'     => 'image',
          'renderer'  => 'news/adminhtml_news_renderer_image'
      ));
	
				
				$this->addColumn("title", array(
				"header" => Mage::helper("news")->__("Title"),
				"index" => "title",
				));
				$this->addColumn("url", array(
				"header" => Mage::helper("news")->__("URL"),
				"index" => "url",
				));
				
				$this->addColumn('created_time', array(
            'header'    => Mage::helper('news')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        )); 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('news')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));   
				
				
				$this->addColumn("status", array(
				"header" => Mage::helper("news")->__("Status"),
				"index" => "status",
				'type'      => 'options',
				"options" => Mage::getSingleton('news/status')->getOptionArray(),
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
			$this->setMassactionIdField('news_id');
			$this->getMassactionBlock()->setFormFieldName('news_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_news', array(
					 'label'=> Mage::helper('news')->__('Remove News'),
					 'url'  => $this->getUrl('*/adminhtml_news/massRemove'),
					 'confirm' => Mage::helper('news')->__('Are you sure?')
				));
				
			
			 $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('news')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('news')->__('Status'),
                         'values' => array(
                      array(
                          'value'     => 1,
                          'label'     => Mage::helper('news')->__('Enabled'),
                      ),
                      array(
                          'value'     => 2,
                          'label'     => Mage::helper('news')->__('Disabled'),
                      ),
					  ),
        )
        )
        ));	
		
		
		
			return $this;
		}
			

}