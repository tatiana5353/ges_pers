<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tache".
 *
 * @property int $id
 * @property string $designation
 * @property string|null $description
 * @property string|null $heure_debut
 * @property string|null $heure_finprobable
 * @property string|null $heure_fin
 * @property string $key_tache
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $idaffectation
 * @property int|null $idprojet
 * @property int $idtypetache
 *
 * @property Affectation $idaffectation0
 * @property Projet $idprojet0
 * @property TypeTache $idtypetache0
 * @property User $createdBy
 * @property User $updatedBy
 */
class Tache extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tache';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designation', 'key_tache', 'statut', 'created_by', 'created_at', 'idtypetache'], 'required'],
            [['description'], 'string'],
            [['heure_debut', 'heure_finprobable', 'heure_fin', 'created_at', 'updated_at'], 'safe'],
            [['statut', 'created_by', 'updated_by', 'idaffectation', 'idprojet', 'idtypetache'], 'integer'],
            [['designation'], 'string', 'max' => 50],
            [['key_tache'], 'string', 'max' => 32],
            [['idaffectation'], 'exist', 'skipOnError' => true, 'targetClass' => Affectation::className(), 'targetAttribute' => ['idaffectation' => 'id']],
            [['idprojet'], 'exist', 'skipOnError' => true, 'targetClass' => Projet::className(), 'targetAttribute' => ['idprojet' => 'id']],
            [['idtypetache'], 'exist', 'skipOnError' => true, 'targetClass' => TypeTache::className(), 'targetAttribute' => ['idtypetache' => 'id']],
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
            'designation' => 'Designation',
            'description' => 'Description',
            'heure_debut' => 'Heure Debut',
            'heure_finprobable' => 'Heure Finprobable',
            'heure_fin' => 'Heure Fin',
            'key_tache' => 'Key Tache',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'idaffectation' => 'Idaffectation',
            'idprojet' => 'Idprojet',
            'idtypetache' => 'Idtypetache',
        ];
    }

    /**
     * Gets query for [[Idaffectation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdaffectation0()
    {
        return $this->hasOne(Affectation::className(), ['id' => 'idaffectation']);
    }

    /**
     * Gets query for [[Idprojet0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdprojet0()
    {
        return $this->hasOne(Projet::className(), ['id' => 'idprojet']);
    }

    /**
     * Gets query for [[Idtypetache0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtypetache0()
    {
        return $this->hasOne(TypeTache::className(), ['id' => 'idtypetache']);
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
