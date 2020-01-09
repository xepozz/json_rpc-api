<?php

declare(strict_types=1);

namespace Rpc\Migrations;

use Phinx\Migration\AbstractMigration;

final class create_table_links extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('links');
        if ($table->exists()) {
            return;
        }

        $table
            ->addColumn('uniqueId', 'string', ['limit' => 255])
            ->addColumn('link', 'string', ['limit' => 255])
            ->addIndex(['uniqueId'])
            ->create();
    }
}
