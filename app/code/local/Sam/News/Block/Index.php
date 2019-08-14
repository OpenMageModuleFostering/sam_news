<?php   
class Sam_News_Block_Index extends Mage_Core_Block_Template
{   

	protected $_newsCollection;
	
	public function __construct()
	{
		if (is_null($this->_newsCollection)) 
		{
			$this->_newsCollection = Mage::getModel('news/news')->getCollection()->addFieldToFilter('status',1);
			$this->setCollection($this->_newsCollection);
		}
		return $this->_newsCollection;
	}

	protected function _prepareLayout()
    {
		
        parent::_prepareLayout();
		
        $pager = $this->getLayout()->createBlock('page/html_pager', 'news.pager');
        $pager->setAvailableLimit($this->getNewsPerPageAllowed());
		//$pager->setLimit($this->getReviewPerPageDefault());
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }


	public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
	public function getNewsPerPageAllowed()
	{
		$newsperpage = Mage::getStoreConfig('newssection/settings/news_per_page_allowed');
		$allowed = explode(',',$newsperpage);
		$allowedcopy = $allowed;
		$combine = array_combine($allowed,$allowedcopy);
		return $combine;
	}

	public function getLoadedNewsCollection()
	{
		return $this->_newsCollection;
	}

}