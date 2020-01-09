<?php

namespace Api\Migrations;

use Phinx\Migration\AbstractMigration;

class CreateTableLinks extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('links');

        $table
            ->addColumn('uniqueId', 'string', ['limit' => 255])
            ->addColumn('link', 'string', ['limit' => 255])
            ->addIndex(['uniqueId'])
            ->save();
    }
}
