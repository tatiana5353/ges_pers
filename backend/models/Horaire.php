<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "horaire".
 *
 * @property int $id
 * @property string $heure_arrivee
 * @property string $heure_depart
 * @property string $key_horaire
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Presence[] $presences
 */
class Horaire extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horaire';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['heure_arrivee', 'heure_depart', 'key_horaire', 'statut', 'created_by', 'created_at'], 'required'],
            [['heure_arrivee', 'heure_depart', 'created_at', 'updated_at'], 'safe'],
            [['statut', 'created_by', 'updated_by'], 'integer'],
            [['key_horaire'], 'string', 'max' => 32],
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
            'heure_arrivee' => 'Heure Arrivee',
            'heure_depart' => 'Heure Depart',
            'key_horaire' => 'Key Horaire',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Presences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresences()
    {
        return $this->hasMany(Presence::className(), ['idhoraire' => 'id']);
    }
}
