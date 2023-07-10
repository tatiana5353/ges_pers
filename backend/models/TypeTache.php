<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "type_tache".
 *
 * @property int $id
 * @property string $libelle
 * @property string $key_typetache
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Tache[] $taches
 * @property User $createdBy
 * @property User $updatedBy
 */
class TypeTache extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_tache';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'key_typetache', 'statut', 'created_by', 'created_at'], 'required'],
            [['statut', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 50],
            [['key_typetache'], 'string', 'max' => 32],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'libelle' => 'Libelle',
            'key_typetache' => 'Key Typetache',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Taches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaches()
    {
        return $this->hasMany(Tache::className(), ['idtypetache' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
