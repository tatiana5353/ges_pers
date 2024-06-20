<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "profil_fonctionnalite".
 *
 * @property int $id
 * @property string $key_profilfonctionnalite
 * @property int $statut
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $idprofil
 * @property int $idfonctionnalite
 *
 * @property Fonctionnalite $idfonctionnalite0
 * @property Profil $idprofil0
 */
class ProfilFonctionnalite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil_fonctionnalite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_profilfonctionnalite', 'statut', 'created_by', 'created_at', 'idprofil', 'idfonctionnalite'], 'required'],
            [['statut', 'created_by', 'updated_by', 'idprofil', 'idfonctionnalite'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_profilfonctionnalite'], 'string', 'max' => 32],
            [['idfonctionnalite'], 'exist', 'skipOnError' => true, 'targetClass' => Fonctionnalite::className(), 'targetAttribute' => ['idfonctionnalite' => 'id']],
            [['idprofil'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['idprofil' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_profilfonctionnalite' => 'Key Profilfonctionnalite',
            'statut' => 'Statut',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'idprofil' => 'Idprofil',
            'idfonctionnalite' => 'Idfonctionnalite',
        ];
    }

    /**
     * Gets query for [[Idfonctionnalite0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfonctionnalite0()
    {
        return $this->hasOne(Fonctionnalite::className(), ['id' => 'idfonctionnalite']);
    }

    /**
     * Gets query for [[Idprofil0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdprofil0()
    {
        return $this->hasOne(Profil::className(), ['id' => 'idprofil']);
    }
}
