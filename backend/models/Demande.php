<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "demande".
 *
 * @property int $id
 * @property string $motif
 * @property string $numero
 * @property string|null $motif_refus
 * @property string $debutconge
 * @property string $finconge
 * @property string $key_demande
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int $idtypeconge
 * @property int|null $iduser
 *
 * @property TypeConge $idtypeconge0
 * @property User $createdBy
 * @property User $iduser0
 * @property User $updatedBy
 */
class Demande extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demande';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motif', 'numero', 'finconge', 'key_demande', 'statut', 'created_by', 'created_at', 'idtypeconge'], 'required'],
            [['motif', 'motif_refus'], 'string'],
            [['debutconge', 'finconge', 'created_at', 'updated_at'], 'safe'],
            [['statut', 'created_by', 'updated_by', 'idtypeconge', 'iduser'], 'integer'],
            [['numero'], 'string', 'max' => 10],
            [['key_demande'], 'string', 'max' => 32],
            [['idtypeconge'], 'exist', 'skipOnError' => true, 'targetClass' => TypeConge::className(), 'targetAttribute' => ['idtypeconge' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['iduser' => 'id']],
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
            'motif' => 'Motif',
            'numero' => 'Numero',
            'motif_refus' => 'Motif Refus',
            'debutconge' => 'Debutconge',
            'finconge' => 'Finconge',
            'key_demande' => 'Key Demande',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'idtypeconge' => 'Idtypeconge',
            'iduser' => 'Iduser',
        ];
    }

    /**
     * Gets query for [[Idtypeconge0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtypeconge0()
    {
        return $this->hasOne(TypeConge::className(), ['id' => 'idtypeconge']);
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
     * Gets query for [[Iduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduser0()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
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
