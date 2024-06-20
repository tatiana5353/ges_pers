<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "suivie".
 *
 * @property int $id
 * @property string|null $date_debut
 * @property string|null $date_fin
 * @property string|null $date_prob
 * @property string|null $commentaire_assigant
 * @property string|null $commentaire_effectuant
 * @property string $key_suivie
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $idtache
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Tache $idtache0
 */
class Suivie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suivie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_debut', 'date_fin', 'date_prob', 'created_at', 'updated_at'], 'safe'],
            [['commentaire_assigant', 'commentaire_effectuant'], 'string'],
            [['key_suivie', 'statut', 'created_by', 'created_at'], 'required'],
            [['statut', 'created_by', 'updated_by', 'idtache'], 'integer'],
            [['key_suivie'], 'string', 'max' => 32],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['idtache'], 'exist', 'skipOnError' => true, 'targetClass' => Tache::className(), 'targetAttribute' => ['idtache' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_debut' => 'Date Debut',
            'date_fin' => 'Date Fin',
            'date_prob' => 'Date Prob',
            'commentaire_assigant' => 'Commentaire Assigant',
            'commentaire_effectuant' => 'Commentaire Effectuant',
            'key_suivie' => 'Key Suivie',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'idtache' => 'Idtache',
        ];
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
     * Gets query for [[Idtache0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtache0()
    {
        return $this->hasOne(Tache::className(), ['id' => 'idtache']);
    }
}
