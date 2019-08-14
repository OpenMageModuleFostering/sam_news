<?php

class Sam_News_Model_Observer
{
    public function set_block($observer)
    {
        $action = $observer->getEvent()->getAction();
		$sidebartype = (int) Mage::helper('news')->getSidebarType();
		switch($sidebartype)
		{
			case 1:
			$position = 'left';
			$sub_position = 'before="-"';
			break;
			
			case 2:
			$position = 'right';
			$sub_position = 'before="-"';
			break;
			
			case 3:
			$position = 'left';
			break;
			
			case 4:
			$position = 'right';
			break;
		}
		
		
        $myXml = '<reference name="'.$position.'">';
        $myXml .= '<block type="news/sidebar" name="news_sidebar" template="news/sidebar.phtml" '.$sub_position.'/>';
        $myXml .= '</reference>';
        $layout = $observer->getEvent()->getLayout();
        $layout->getUpdate()->addUpdate($myXml);
        $layout->generateXml();
    }
}
	 