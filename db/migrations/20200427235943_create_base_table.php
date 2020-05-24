<?php

use Phinx\Migration\AbstractMigration;

class CreateBaseTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $tableUsers = $this->table('users');
        $tableUsers->addColumn('name', 'string', ['limit'=>32])
            ->addColumn('password', 'string', ['limit'=>32])
            ->create();
        
        $tableManufacturer = $this->table('manufacturer');
        $tableManufacturer->addColumn('name', 'string', ['limit'=>100])
            ->addColumn('sourceImg', 'string', ['limit'=>1000])
            ->addColumn('hidden', 'boolean')
            ->create();
    }
}
