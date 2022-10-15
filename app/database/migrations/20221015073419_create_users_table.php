<?php

use Phoenix\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('users')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->addColumn('created_at', 'datetime')
            ->create();
    }

    protected function down(): void
    {
        $this->table('users')
            ->drop();
    }
}
