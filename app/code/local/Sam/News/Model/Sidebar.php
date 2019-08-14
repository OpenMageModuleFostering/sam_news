<?php

class Sam_News_Model_Sidebar
{
    public function toOptionArray()
    {
        return array(
			array('value' => '1', 'label' =>'Top Left'),
			array('value' => '2', 'label' => 'Top Right'),
      		array('value' => '3', 'label' =>'Left'),
      		array('value' => '4', 'label' => 'Right'),
    	);
    }
}