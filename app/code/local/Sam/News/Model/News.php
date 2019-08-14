<?php

class Sam_News_Model_News extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("news/news");

    }
	
	public function getNewsUrl()
	{
		return Mage::getBaseUrl().'news/index/view/id/'.$this->getId();
	}

	public function getThumbnailImage()
	{
		return Mage::getBaseUrl('media').$this->getImage();
	}
	
	/*public function getDate()
	{
		return Mage::getModel('core/date')->date('M d, Y', strtotime($this->getCreatedTime()));
	}*/
}
	 