<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "practices".
 *
 * @property int $id
 * @property string|null $practice_id
 * @property string|null $creation_date
 * @property string|null $practice_status
 * @property string|null $note
 * @property int|null $customer_id
 *
 * @property Customers $customer
 */
class Practice extends \yii\db\ActiveRecord
{
    public $fiscal_code;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'practices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_date'], 'safe'],
            [['practice_status', 'note'], 'string'],
            [['customer_id'], 'integer'],
            [['practice_id'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'practice_id' => 'Practice ID',
            'creation_date' => 'Creation Date',
            'practice_status' => 'Practice Status',
            'note' => 'Note',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])->inverseOf('practices');
    }
}
