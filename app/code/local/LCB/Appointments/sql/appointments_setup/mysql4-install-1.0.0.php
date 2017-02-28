<?php

$installer = $this;
$installer->startSetup();
$sql = <<<SQLTEXT

DROP TABLE IF EXISTS {$this->getTable('lcb_appointments')};
        
CREATE TABLE {$this->getTable('lcb_appointments')}( 
      id int not null auto_increment,
      firstname varchar(255),
      lastname varchar(255),
      email varchar(255),
      telephone varchar(255),
      message longtext,
      created_at timestamp,
      time datetime,
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

        
SQLTEXT;

$installer->run($sql);
$installer->endSetup();
