<?php

namespace app\models;

use Yii;
use common\models\User;
use app\models\Regions;
/**
 * This is the model class for table "ware_house".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $region_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $short_code
 * @property string $address
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ProductHistory[] $productHistories
 * @property Products[] $products
 * @property User $createdBy
 * @property Regions $region
 * @property User $updatedBy
 */
class WareHouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ware_house';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'status', 'region_id', 'short_code', 'address'], 'required'],
            [['id', 'status', 'region_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['short_code'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 150],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'region_id' => Yii::t('app', 'Region ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'short_code' => Yii::t('app', 'Short Code'),
            'address' => Yii::t('app', 'Address'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHistories()
    {
        return $this->hasMany(ProductHistory::className(), ['ware_house_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['ware_house_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return WareHouseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WareHouseQuery(get_called_class());
    }
}
