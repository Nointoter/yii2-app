<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property int $cities_id
 * @property string|null $name
 * @property string|null $info
 *
 * @property Cities $cities
 * @property Compworkers[] $compworkers
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cities_id'], 'required'],
            [['cities_id'], 'integer'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['cities_id' => 'id']],
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
            'name' => 'Name',
            'info' => 'Info',
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
     * Gets query for [[Compworkers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompworkers()
    {
        return $this->hasMany(Compworkers::class, ['companies_id' => 'id']);
    }
}
