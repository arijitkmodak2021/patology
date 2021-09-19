<?php

namespace common\models;

use Codeception\Lib\Generator\Test;
use Yii;

/**
 * This is the model class for table "tests_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $reference_interval
 * @property string $specimen_type
 * @property string $testing_frequency
 * @property string $comments
 * @property integer $status
 * @property integer $is_deleted
 * @property integer $cost
 */
class TestsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_name', 'reference_interval'], 'required'],
            [['name', 'category_name', 'reference_interval', 'comments', 'cost'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Test Name',
            'category_name' => 'Test Category',
            'comments' => 'Normal Range',
            'reference_interval' => 'Unit',
            'cost' => 'Cost (₹)',
            //'specimen_type' => 'Specimen Type',
            //'testing_frequency' => 'Testing Frequency',
        ];
    }

    public function createTestsType()
    {
        if(!$this->validate()) {
            return null;
        }

        $model = new TestsType();
        $model->name = $this->name;
        $model->category_name = $this->category_name;
        $model->reference_interval = $this->reference_interval;
        $model->comments = $this->comments;
        $model->cost = $this->cost;

        return $model->save() ? $model : null;
    }
}
