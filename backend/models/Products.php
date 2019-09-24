<?php

namespace app\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property string $bcode
 * @property string $price
 * @property string $function
 * @property string $notes
 * @property int $product_status_id
 * @property int $ware_house_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ProductHistory[] $productHistories
 * @property User $createdBy
 * @property ProductStatus $productStatus
 * @property User $updatedBy
 * @property WareHouse $wareHouse
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'model', 'bcode', 'price', 'function', 'notes', 'product_status_id', 'ware_house_id'], 'required'],
            [['id', 'product_status_id', 'ware_house_id', 'created_by', 'updated_by'], 'integer'],
            [['function', 'notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'model', 'bcode'], 'string', 'max' => 50],
            [['price'], 'string', 'max' => 20],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['product_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductStatus::className(), 'targetAttribute' => ['product_status_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['ware_house_id'], 'exist', 'skipOnError' => true, 'targetClass' => WareHouse::className(), 'targetAttribute' => ['ware_house_id' => 'id']],
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
            'model' => Yii::t('app', 'Model'),
            'bcode' => Yii::t('app', 'Bcode'),
            'price' => Yii::t('app', 'Price'),
            'function' => Yii::t('app', 'Function'),
            'notes' => Yii::t('app', 'Notes'),
            'product_status_id' => Yii::t('app', 'Product Status ID'),
            'ware_house_id' => Yii::t('app', 'Ware House ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHistories()
    {
        return $this->hasMany(ProductHistory::className(), ['product_id' => 'id']);
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
    public function getProductStatus()
    {
        return $this->hasOne(ProductStatus::className(), ['id' => 'product_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWareHouse()
    {
        return $this->hasOne(WareHouse::className(), ['id' => 'ware_house_id']);
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
