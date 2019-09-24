<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property double $longitude
 * @property double $latitude
 * @property string $color
 * @property string $created_date
 * @property string $updated_date
 *
 * @property WareHouse[] $wareHouses
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'status', 'longitude', 'latitude', 'color'], 'required'],
            [['id', 'status'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'color' => Yii::t('app', 'Color'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWareHouses()
    {
        return $this->hasMany(WareHouse::className(), ['region_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionsQuery(get_called_class());
    }
}
