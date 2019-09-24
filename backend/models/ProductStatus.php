<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_status".
 *
 * @property int $id
 * @property string $name
 * @property string $state
 * @property int $sort
 * @property int $status
 * @property string $color
 * @property int $parent_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Products[] $products
 */
class ProductStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state', 'sort', 'status', 'color'], 'required'],
            [['sort', 'status', 'parent_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['state'], 'string', 'max' => 16],
            [['color'], 'string', 'max' => 6],
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
            'state' => Yii::t('app', 'State'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'color' => Yii::t('app', 'Color'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['product_status_id' => 'id']);
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
