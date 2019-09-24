<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WareHouse]].
 *
 * @see WareHouse
 */
class WareHouseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WareHouse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WareHouse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
