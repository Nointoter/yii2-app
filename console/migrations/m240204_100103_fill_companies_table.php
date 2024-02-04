<?php

use app\models\Cities;
use Faker\Factory;
use yii\db\Migration;

/**
 * Class m240204_100103_fill_companies_table
 */
class m240204_100103_fill_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        //$citiesCount = (int)Cities::find()->count();

        for ($i = 0; $i < 100; $i++)
        {
            $this->insert('companies', [
                'cities_id' => $faker->numberBetween(1, 10),
                'name' => $faker->company(30),
                'info' => $faker->text(50),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->truncateTable('companies');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240204_100103_fill_companies_table cannot be reverted.\n";

        return false;
    }
    */
}
