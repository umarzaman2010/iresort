<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductHistory]].
 *
 * @see ProductHistory
 */
class ProductHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
