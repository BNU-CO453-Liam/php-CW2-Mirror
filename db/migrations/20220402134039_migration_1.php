<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class Migration1 extends AbstractMigration
{
    /**
     * Add Image column
     */
    public function change(): void
    {
		$table = $this->table('student');
		$table->addColumn('image', 'blob', ['limit' => MysqlAdapter::BLOB_LONG])
			  ->save();
    }
}
