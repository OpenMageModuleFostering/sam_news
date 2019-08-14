<?php
class Sam_News_Block_Adminhtml_News_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{
     
    public function render(Varien_Object $row)
    {
        $html = '<img ';
        $html .= 'id="' . $this->getColumn()->getId() . '" ';
        $html .= 'src="'. Mage::getBaseUrl('media') . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss().'"';
		$html .= 'style="weight:75px;height:75px"' . '"/>';
        return $html;
    }
}
