<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "presence".
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $justification
 * @property string|null $heure_arrivee
 * @property string|null $heure_depart
 * @property string $key_presence
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int $idhoraire
 *
 * @property Horaire $idhoraire0
 * @property User $createdBy
 * @property User $updatedBy
 */
class Presence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'key_presence', 'statut', 'created_by', 'created_at', 'idhoraire'], 'required'],
            [['justification'], 'string'],
            [['heure_arrivee', 'heure_depart', 'created_at', 'updated_at'], 'safe'],
            [['statut', 'created_by', 'updated_by', 'idhoraire'], 'integer'],
            [['libelle'], 'string', 'max' => 50],
            [['key_presence'], 'string', 'max' => 32],
            [['idhoraire'], 'exist', 'skipOnError' => true, 'targetClass' => Horaire::className(), 'targetAttribute' => ['idhoraire' => 'id']],
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
            'justification' => 'Justification',
            'heure_arrivee' => 'Heure Arrivee',
            'heure_depart' => 'Heure Depart',
            'key_presence' => 'Key Presence',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'idhoraire' => 'Idhoraire',
        ];
    }

    /**
     * Gets query for [[Idhoraire0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdhoraire0()
    {
        return $this->hasOne(Horaire::className(), ['id' => 'idhoraire']);
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
