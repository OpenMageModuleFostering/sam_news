<?php
$installer = $this;
$installer->startSetup();
$sql="
-- DROP TABLE IF EXISTS {$this->getTable('news')};
CREATE TABLE {$this->getTable('news')} (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',         
  `short_description` text NOT NULL default '',
  `description` text NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `counts` int(11) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 

Mage::getConfig()->saveConfig('newssection/settings/recent_news', '1');
Mage::getConfig()->saveConfig('newssection/settings/view_type', 'list');
Mage::getConfig()->saveConfig('newssection/settings/total_recent_news', '5');
Mage::getConfig()->saveConfig('newssection/settings/news_per_page_allowed', '5,10,15,20');

$installer->endSetup();
	 