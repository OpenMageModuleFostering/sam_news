<?php

class Sam_News_Model_Viewtype
{
    public function toOptionArray()
    {
        return array(
      		array('value' => 'list', 'label' =>'List'),
      		array('value' => 'scroller', 'label' => 'Scroller'),
			array('value' => 'slider', 'label' => 'Slider'),
     		// and so on...
    	);
    }
}