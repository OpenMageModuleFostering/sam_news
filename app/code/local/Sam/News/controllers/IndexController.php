<?php
class Sam_News_IndexController extends Mage_Core_Controller_Front_Action
{
    public function IndexAction() 
	{
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("News"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home"),
                "title" => $this->__("Home"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("news", array(
                "label" => $this->__("News"),
                "title" => $this->__("News")
		   ));

      $this->renderLayout(); 
	  
    }
	
	
	public function ViewAction() 
	{
      $newsModel = Mage::getModel('news/news')->load($this->getRequest()->getParam('id'));
	  Mage::register('news',$newsModel);
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($newsModel->getTitle());
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home"),
                "title" => $this->__("Home"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("news", array(
                "label" => $this->__("News"),
                "title" => $this->__("News"),
				"link"  => Mage::getUrl('news')
		   ));

	  $breadcrumbs->addCrumb($newsModel->getTitle(), array(
                "label" => $newsModel->getTitle(),
                "title" => $newsModel->getTitle(),
		   ));
		   
      $this->renderLayout(); 
	  
    }
}