<?php
class Sam_News_Block_Sidebar extends Mage_Core_Block_Template
{
	
	protected $_collection;
	
	public function __construct()
	{
		$this->_collection = Mage::getModel('news/news')->getCollection()->addFieldToFilter('status',1)->setOrder('created_time', 'DESC');
		return $this->_collection;
	}
	
	protected function getTotalRecentNews()
	{
		$totalreviewcount = (int) Mage::getStoreConfig('newssection/settings/total_recent_news');
		return $totalreviewcount;
	}
	public function getNews() 
	{
		$collection = $this->_collection->setPageSize($this->getTotalRecentNews());
		return $collection;
	}
	
	public function getCount()
	{
		return $this->_collection->count();
	}
	
	public function getViewMode()
	{
		return Mage::getStoreConfig('newssection/settings/view_type');
	}
	
}