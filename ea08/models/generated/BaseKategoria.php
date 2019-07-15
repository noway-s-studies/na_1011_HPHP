<?php

Doctrine_Manager::getInstance()->bindComponent('Kategoria', 'blogconn');

abstract class BaseKategoria extends Doctrine_Record {
    public function setTableDefinition() {
        $this->setTableName('kategoria');
        $this->hasColumn('kid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nev', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('leiras', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasMany('Blog', array(
             'local' => 'kid',
             'foreign' => 'kid'));
    }
}