<?php

namespace app\models;

use yii\bootstrap4\Html;
use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $deadline
 * @property string|null $description
 * @property bool $completed
 *
 * @property Users $user
 * @property Tags[] $tags
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['title', 'deadline'], 'required'],
            [['deadline'], 'safe'],
            [['description'], 'string'],
            [['completed'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Título',
            'deadline' => 'Fecha de vencimiento',
            'description' => 'Descripción',
            'completed' => 'Completada',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }


    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])->viaTable('tasks_tags', ['task_id' => 'id']);
    }


    public static function getTagsTitlesURL($id)
    {
        $tags[] = Tags::find()->select(['id', 'title'])->where(['task_id' => $id])->asArray()->all();
        $dev = [];
        foreach ($tags[0] as $key => $value) {
            $dev[] = Html::a($value['title'], ['/tags/view', 'id' => $value['id']]);
        }

        return $dev;
    }
}
