<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cities}}`
 * - `{{%companies}}`
 */
class m240203_130440_create_workers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workers}}', [
            'id' => $this->primaryKey(),
            'cities_id' => $this->integer()->notNull(),
            'companies_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'surname' => $this->string(),
        ]);

        // creates index for column `cities_id`
        $this->createIndex(
            '{{%idx-workers-cities_id}}',
            '{{%workers}}',
            'cities_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-workers-cities_id}}',
            '{{%workers}}',
            'cities_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );

        // creates index for column `companies_id`
        $this->createIndex(
            '{{%idx-workers-companies_id}}',
            '{{%workers}}',
            'companies_id'
        );

        // add foreign key for table `{{%companies}}`
        $this->addForeignKey(
            '{{%fk-workers-companies_id}}',
            '{{%workers}}',
            'companies_id',
            '{{%companies}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-workers-cities_id}}',
            '{{%workers}}'
        );

        // drops index for column `cities_id`
        $this->dropIndex(
            '{{%idx-workers-cities_id}}',
            '{{%workers}}'
        );

        // drops foreign key for table `{{%companies}}`
        $this->dropForeignKey(
            '{{%fk-workers-companies_id}}',
            '{{%workers}}'
        );

        // drops index for column `companies_id`
        $this->dropIndex(
            '{{%idx-workers-companies_id}}',
            '{{%workers}}'
        );

        $this->dropTable('{{%workers}}');
    }
}
