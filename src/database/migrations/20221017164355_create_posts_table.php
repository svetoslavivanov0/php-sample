<?php

declare(strict_types=1);

use Phoenix\Database\Element\Index;
use Phoenix\Migration\AbstractMigration;

final class CreatePostsTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('posts')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users')
            ->addColumn('title', 'string')
            ->addColumn('content', 'longtext')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex('id', Index::TYPE_UNIQUE)
            ->create();
    }

    protected function down(): void
    {
        $this->table('posts')->drop();
    }
}
