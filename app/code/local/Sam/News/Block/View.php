<?php   
class Sam_News_Block_View extends Mage_Core_Block_Template
{   

	protected $_news;
	public function __construct()
	{
		$this->_news = Mage::registry('news');
		return $this->_news;
	}
	
	public function getTitle()
	{
		return $this->_news->getTitle();
	}
	
	public function hasImage()
	{
		if($this->_news->getImage())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getImage()
	{
		return $this->_news->getImage();
	}

	public function getNewsCreatedTime()
	{
		return $this->_news->getCreatedTime();
	}
	
	public function getDescription()
	{
		return $this->_news->getDescription();
	}
	
	public function getAllNewsUrl()
	{
		return Mage::getUrl('news');
	}
}