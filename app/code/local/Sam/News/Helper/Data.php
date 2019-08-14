<?php
class Sam_News_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getSidebarType()
	{
		return Mage::getStoreConfig('newssection/settings/recent_news');
	}
}
	 