<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nom
 * @property string $prenoms
 * @property string $sexe
 * @property string $date_naiss
 * @property string $username
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $telephone
 * @property string $email
 * @property int $role
 * @property string $auth_key
 * @property int $status
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $idprofil
 *
 * @property Affectation[] $affectations
 * @property Affectation[] $affectations0
 * @property Affectation[] $affectations1
 * @property Demande[] $demandes
 * @property Demande[] $demandes0
 * @property Fonctionnalite[] $fonctionnalites
 * @property Fonctionnalite[] $fonctionnalites0
 * @property Horaire[] $horaires
 * @property Horaire[] $horaires0
 * @property Presence[] $presences
 * @property Presence[] $presences0
 * @property Profil[] $profils
 * @property Profil[] $profils0
 * @property Projet[] $projets
 * @property Projet[] $projets0
 * @property Tache[] $taches
 * @property Tache[] $taches0
 * @property TypeConge[] $typeConges
 * @property TypeConge[] $typeConges0
 * @property TypeTache[] $typeTaches
 * @property TypeTache[] $typeTaches0
 * @property Profil $idprofil0
 * @property User $createdBy
 * @property User[] $users
 * @property User $updatedBy
 * @property User[] $users0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom', 'prenoms', 'sexe', 'date_naiss', 'username', 'password_hash', 'telephone', 'email', 'role', 'auth_key', 'status', 'created_by', 'created_at', 'idprofil'], 'required'],
            [['date_naiss', 'created_at', 'updated_at'], 'safe'],
            [['role', 'status', 'created_by', 'updated_by', 'idprofil'], 'integer'],
            [['nom', 'prenoms', 'username'], 'string', 'max' => 50],
            [['sexe'], 'string', 'max' => 1],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['telephone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['idprofil'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['idprofil' => 'id']],
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
            'nom' => 'Nom',
            'prenoms' => 'Prenoms',
            'sexe' => 'Sexe',
            'date_naiss' => 'Date Naiss',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'idprofil' => 'Idprofil',
        ];
    }

    /**
     * Gets query for [[Affectations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAffectations()
    {
        return $this->hasMany(Affectation::className(), ['iduser' => 'id']);
    }

    /**
     * Gets query for [[Affectations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAffectations0()
    {
        return $this->hasMany(Affectation::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Affectations1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAffectations1()
    {
        return $this->hasMany(Affectation::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Demandes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemandes()
    {
        return $this->hasMany(Demande::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Demandes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemandes0()
    {
        return $this->hasMany(Demande::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Fonctionnalites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites()
    {
        return $this->hasMany(Fonctionnalite::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Fonctionnalites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites0()
    {
        return $this->hasMany(Fonctionnalite::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Horaires]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHoraires()
    {
        return $this->hasMany(Horaire::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Horaires0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHoraires0()
    {
        return $this->hasMany(Horaire::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Presences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresences()
    {
        return $this->hasMany(Presence::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Presences0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresences0()
    {
        return $this->hasMany(Presence::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Profils]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfils()
    {
        return $this->hasMany(Profil::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Profils0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfils0()
    {
        return $this->hasMany(Profil::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Projets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjets()
    {
        return $this->hasMany(Projet::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Projets0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjets0()
    {
        return $this->hasMany(Projet::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Taches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaches()
    {
        return $this->hasMany(Tache::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Taches0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaches0()
    {
        return $this->hasMany(Tache::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[TypeConges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeConges()
    {
        return $this->hasMany(TypeConge::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[TypeConges0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeConges0()
    {
        return $this->hasMany(TypeConge::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[TypeTaches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTaches()
    {
        return $this->hasMany(TypeTache::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[TypeTaches0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTaches0()
    {
        return $this->hasMany(TypeTache::className(), ['updated_by' => 'id']);
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
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['created_by' => 'id']);
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
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['updated_by' => 'id']);
    }
}
