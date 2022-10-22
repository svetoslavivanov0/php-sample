<?php

declare(strict_types=1);

use Phoenix\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('users')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->addIndex('email', \Phoenix\Database\Element\Index::TYPE_UNIQUE)
            ->create();
    }

    protected function down(): void
    {
        $this->table('users')
            ->drop();
    }
}
