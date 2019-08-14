<?php

class Sam_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("news/news")->_addBreadcrumb(Mage::helper("adminhtml")->__("News  Manager"),Mage::helper("adminhtml")->__("News Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("News"));
			    $this->_title($this->__("Manager News"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("News"));
				$this->_title($this->__("News"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("news/news")->load($id);
				if ($model->getId()) {
					Mage::register("news_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("news/news");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("News Manager"), Mage::helper("adminhtml")->__("News Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("News Description"), Mage::helper("adminhtml")->__("News Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("news/adminhtml_news_edit"))->_addLeft($this->getLayout()->createBlock("news/adminhtml_news_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("news")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("News"));
		$this->_title($this->__("News"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("news/news")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("news_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("news/news");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("News Manager"), Mage::helper("adminhtml")->__("News Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("News Description"), Mage::helper("adminhtml")->__("News Description"));


		$this->_addContent($this->getLayout()->createBlock("news/adminhtml_news_edit"))->_addLeft($this->getLayout()->createBlock("news/adminhtml_news_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{
			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						
				 //save image
		try{

if((bool)$post_data['image']['delete']==1) {

	        $post_data['image']='';

}
else {

	unset($post_data['image']);

	if (isset($_FILES)){

		if ($_FILES['image']['name']) {

			if($this->getRequest()->getParam("id")){
				$model = Mage::getModel("news/news")->load($this->getRequest()->getParam("id"));
				if($model->getData('image')){
						$io = new Varien_Io_File();
						$io->rm(Mage::getBaseDir('media').DS.implode(DS,explode('/',$model->getData('image'))));	
				}
			}
						$path = Mage::getBaseDir('media') . DS . 'news' . DS .'news'.DS;
						$uploader = new Varien_File_Uploader('image');
						$uploader->setAllowedExtensions(array('jpg','png','gif'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						$destFile = $path.$_FILES['image']['name'];
						$filename = $uploader->getNewFileName($destFile);
						$uploader->save($path, $filename);
						
						
						//Create Thumbnail and upload
						$thumbnailpath = Mage::getBaseDir('media') . DS . 'thumbnail' . DS . 'news' . DS .'news'.DS;
						$imgName = $_FILES['image']['name'];
						$imgPathFull = $path.$imgName;
						$resizeFolder = "thumbnail";
						$imageResizedPath = $thumbnailpath.$imgName;
						$imageObj = new Varien_Image($imgPathFull);
						$imageObj->constrainOnly(TRUE);
						$imageObj->keepAspectRatio(FALSE);
						$imageObj->keepFrame(FALSE);
						$imageObj->resize(100,100);
						$imageObj->save($imageResizedPath);
						
						//Create Medium and upload
						$mediumpath = Mage::getBaseDir('media') . DS . 'medium' . DS . 'news' . DS .'news'.DS;
						$imgName = $_FILES['image']['name'];
						$imgPathFull = $path.$imgName;
						$resizeFolder = "thumbnail";
						$imageResizedPath = $mediumpath.$imgName;
						$imageObj = new Varien_Image($imgPathFull);
						$imageObj->constrainOnly(TRUE);
						$imageObj->keepAspectRatio(FALSE);
						$imageObj->keepFrame(FALSE);
						$imageObj->resize(300,200);
						$imageObj->save($imageResizedPath);
						
						//Create Small and upload
						$smallpath = Mage::getBaseDir('media') . DS . 'small' . DS . 'news' . DS .'news'.DS;
						$imgName = $_FILES['image']['name'];
						$imgPathFull = $path.$imgName;
						$resizeFolder = "thumbnail";
						$imageResizedPath = $smallpath.$imgName;
						$imageObj = new Varien_Image($imgPathFull);
						$imageObj->constrainOnly(TRUE);
						$imageObj->keepAspectRatio(FALSE);
						$imageObj->keepFrame(FALSE);
						$imageObj->resize(80,80);
						$imageObj->save($imageResizedPath);
						
						
						$post_data['image']='news/news/'.$filename;
		}
    }
}

        } catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
        }
//save image

						$newsModel = Mage::getModel('news/news')->load($this->getRequest()->getParam("id"));
						
						if ($newsModel->getCreatedTime() == NULL || $newsModel->getUpdateTime() == NULL) {
					$post_data['created_time'] = now();
					$post_data['update_time'] = now();
				} else {
					$post_data['update_time'] = now();
				}	

						$model = Mage::getModel("news/news")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))	
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("News was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setNewsData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setNewsData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("news/news");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('news_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("news/news");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
		
		
		public function massStatusAction()
		  {
			  $ids = $this->getRequest()->getParam('news_ids');
			  foreach($ids as $id)
			  {
				  $model = Mage::getModel('news/news');
				  $model->setId($id)
				  		->setStatus($this->getRequest()->getParam('status'))
						->save();
			  }
			  $this->_redirect('*/*/');
			  
		  }
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'news.csv';
			$grid       = $this->getLayout()->createBlock('news/adminhtml_news_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'news.xml';
			$grid       = $this->getLayout()->createBlock('news/adminhtml_news_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
