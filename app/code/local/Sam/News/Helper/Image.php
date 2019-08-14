<?php
class Sam_News_Helper_Image extends Mage_Core_Helper_Abstract
{
	public function getImageresize($image,$type,$width,$height)
	{
		//IMAGE RESIZE CODE START
	if(!file_exists(Mage::getBaseDir('media').'/news/resized/'.$type.'/'))mkdir(Mage::getBaseDir('media').'/news/resized/'.$type.'/',0777);
		$imageUrl = Mage::getBaseDir('media').DS.$image;             
		if($imageUrl):
			$imageName = substr(strrchr($imageUrl,"/"),1);
			$imageResized = Mage::getBaseDir('media').DS."news".DS."resized".DS."".$type."".DS.$imageName;
			$dirImg = Mage::getBaseDir().str_replace("/",DS,strstr($imageUrl,'/media'));
			if (!file_exists($imageResized)&&file_exists($dirImg)) :
				$imageObj = new Varien_Image($imageUrl);
				$imageObj->constrainOnly(TRUE);
				$imageObj->keepAspectRatio(TRUE);
				$imageObj->keepFrame(TRUE);
				$imageObj->backgroundColor(array(255,255,255));
				//Uncomment below Code if u want to use.
				//$imageObj->backgroundColor(false);
				$imageObj->keepTransparency(True);
				//$imageObj->setImageBackgroundColor(false);             
				$imageObj->quality(100);
				//$imageObj->setWatermarkImageOpacity(0);
				$imageObj->resize($width, $height);
				$imageObj->save($imageResized);
			endif;
			return Mage::getBaseUrl('media')."news/resized/".$type."/".$imageName;
		endif;
		//IMAGE RESIZE CODE END
	}
}
	 