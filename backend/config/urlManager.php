<?php

use backend\models\Affectation;

$tab_url = array(

	'login' => 'site/login',
	'logout' => 'site/logout',
	'accueil' => 'site/index',
	/* 'sortiemouvement' => 'site/indexsortiemouvement',
	'entreemouvement' => 'site/indexentreemouvement', */
	'forget_password' => 'site/forget_password',
	'reset_password' => 'site/reset_password',
	'indexetat1' => 'site/indexetat1',


	'all_user' => 'user/index',
	'add_user' => 'user/create',
	'delete_user' => 'user/delete',
	'update_user' => 'user/update',
	'view_user' => 'user/view',
	'get_user_infos' => 'user/get_user_infos',

	//Typeconge
	'all_typeconge' => 'typeconge/index',
	'add_typeconge' => 'typeconge/create',
	'delete_typeconge' => 'typeconge/delete',
	'update_typeconge' => 'typeconge/update',
	'view_typeconge' => 'typeconge/view',


	'all_horaire' => 'horaire/index',
	'add_horaire' => 'horaire/create',
	'delete_horaire' => 'horaire/delete',
	'update_horaire' => 'horaire/update',
	'view_horaire' => 'horaire/view',
	'on_horaire' => 'horaire/on',
	'off_horaire' => 'horaire/off',

	//Demande
	'all_demande' => 'demande/index',
	'all_demandes' => 'demande/indexe',
	'add_demande' => 'demande/create',
	'delete_demande' => 'demande/delete',
	'update_demande' => 'demande/update',
	'view_demande' => 'demande/view',
	'sup_demande' => 'demande/sup',
	'valider_demande' => 'demande/valider',
	'refuser_demande' => 'demande/refuser',
	'refus_demande' => 'demande/refus',
	'affiche_motif' => 'demande/get_motif_refus',
	'faire_demande' => 'demande/faire',

	'all_presence' => 'presence/index',
	'add_presence' => 'presence/create',
	'delete_presence' => 'presence/delete',
	'update_presence' => 'presence/update',
	'view_presence' => 'presence/view',

	//Projet
	'all_projet' => 'projet/index',
	'add_projet' => 'projet/create',
	'add_tacheprojet'  => 'projet/creates',
	'delete_projet' => 'projet/delete',
	'update_projet' => 'projet/update',
	'view_projet' => 'projet/view',
	'save_projet' => 'projet/save_projet',
	'delete_tacheprojet' => 'projet/deletetache',
	'update_tacheprojet' => 'projet/updatetache',
	'create_tacheprojet' => 'projet/createtache',


	'all_affectation' => 'affectation/index',
	'add_affectation' => 'affectation/create',
	'delete_affectation' => 'affectation/delete',
	'update_affectation' => 'affectation/update',
	'view_affectation' => 'affectation/view',
	'save_affectation' => 'affectation/save_affectation',
	'tache_affectation' => 'affectation/tache_affectation',
	'faire_tache' => 'affectation/faire_tache',
	'vue_realisation' => 'affectation/vue_realisation',
	'create_tacheaffectation' => 'affectation/createtache',
	'cocher_taches' => 'affectation/cochertache',
	'delete_tacheaffectation' => 'affectation/deletetache',

	
	/* 'add_projettache' => 'projet/createtache',
	'update_projettache' => 'projet/updatetache',
	'delete_projettache' => 'projet/deletetache',
 */
	'finir_projettache' => 'projet/finirtache',

	//Type de taches
	'all_typetache' => 'typetache/index',
	'add_typetache' => 'typetache/create',
	'delete_typetache' => 'typetache/delete',
	'update_typetache' => 'typetache/update',
	'view_typetache' => 'typetache/view',
	
	'all_tache' => 'tache/index',
	'add_tache' => 'tache/create',
	'delete_tache' => 'tache/deletes',
	'update_tache' => 'tache/update',
	'view_tache' => 'tache/view',
	'valider_tache' => 'tache/valider',
	'refus_tache' => 'tache/createsuivie',

	'all_fonctionnalite' => 'fonctionnalite/index',
	'add_fonctionnalite' => 'fonctionnalite/create',
	'delete_fonctionnalite' => 'fonctionnalite/delete',
	'update_fonctionnalite' => 'fonctionnalite/update',
	'view_fonctionnalite' => 'fonctionnalite/view',


);
