<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property int $cities_id
 * @property int $companies_id
 * @property string|null $name
 * @property string|null $surname
 *
 * @property Cities $cities
 * @property Companies $companies
 */
class workers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cities_id', 'companies_id'], 'required'],
            [['cities_id', 'companies_id'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 255],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['cities_id' => 'id']],
            [['companies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['companies_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cities_id' => 'Cities ID',
            'companies_id' => 'Companies ID',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::class, ['id' => 'cities_id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::class, ['id' => 'companies_id']);
    }
}
