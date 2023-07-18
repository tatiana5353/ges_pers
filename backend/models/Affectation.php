<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "affectation".
 *
 * @property int $id
 * @property string|null $numero
 * @property string $key_affectation
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int $iduser
 *
 * @property User $iduser0
 * @property User $createdBy
 * @property User $updatedBy
 * @property Tache[] $taches
 */
class Affectation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'affectation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_affectation', 'statut', 'created_by', 'created_at', 'iduser'], 'required'],
            [['statut', 'created_by', 'updated_by', 'iduser'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['numero'], 'string', 'max' => 10],
            [['key_affectation'], 'string', 'max' => 32],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['iduser' => 'id']],
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
            'numero' => 'Numero',
            'key_affectation' => 'Key Affectation',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'iduser' => 'Iduser',
        ];
    }

    /**
     * Gets query for [[Iduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduser0()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
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

    /**
     * Gets query for [[Taches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaches()
    {
        return $this->hasMany(Tache::className(), ['idaffectation' => 'id']);
    }
}
