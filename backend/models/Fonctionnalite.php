<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonctionnalite".
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $code
 * @property string $key_fonctionnalite
 * @property int $statut
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property ProfilFonctionnalite[] $profilFonctionnalites
 */
class Fonctionnalite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fonctionnalite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'key_fonctionnalite', 'statut', 'created_by', 'created_at'], 'required'],
            [['statut', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 50],
            [['code', 'key_fonctionnalite'], 'string', 'max' => 32],
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
            'code' => 'Code',
            'key_fonctionnalite' => 'Key Fonctionnalite',
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
     * Gets query for [[ProfilFonctionnalites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfilFonctionnalites()
    {
        return $this->hasMany(ProfilFonctionnalite::className(), ['idfonctionnalite' => 'id']);
    }
}
