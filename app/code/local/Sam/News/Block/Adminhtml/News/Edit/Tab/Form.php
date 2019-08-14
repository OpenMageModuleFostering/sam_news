<?php
class Sam_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	protected function _prepareLayout()
	{
		$return = parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
		return $return;
	}
	
		protected function _prepareForm()
		{
				$form = new Varien_Data_Form();
				$this->setForm($form);
				$form->setHtmlIdPrefix('editor_');
				$fieldset = $form->addFieldset("news_form", array("legend"=>Mage::helper("news")->__("Item information")));

				
				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("news")->__("Title"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "title",
						));
					
						$fieldset->addField("url", "text", array(
						"label" => Mage::helper("news")->__("URL"),					
						"class" => "validate-url",
						"required" => true,
						"name" => "url",
						));
									
						$fieldset->addField('image', 'image', array(
						'label' => Mage::helper('news')->__('Image'),
						'name' => 'image',
						'note' => '(*.jpg, *.png, *.gif)',
						));
						$fieldset->addField("short_description", "editor", array(
						"label" => Mage::helper("news")->__("Short Description"),
						"name" => "short_description",
						"class" => "required-entry",
						"required" => true,
						'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
						));
					
						$fieldset->addField("description", "editor", array(
						"label" => Mage::helper("news")->__("Description"),
						"name" => "description",
						"class" => "required-entry",
						"required" => true,
						'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
						));
					
						$fieldset->addField("status", "select", array(
						"label" => Mage::helper("news")->__("Status"),
						"name" => "status",
						'values'    => Mage::getSingleton('news/status')->getOptionArray()
						));
					

				if (Mage::getSingleton("adminhtml/session")->getNewsData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getNewsData());
					Mage::getSingleton("adminhtml/session")->setNewsData(null);
				} 
				elseif(Mage::registry("news_data")) {
				    $form->setValues(Mage::registry("news_data")->getData());
				}
				return parent::_prepareForm();
		}
}
