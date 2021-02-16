<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/admin/grpecompetences/competences' => [[['_route' => 'api_groupe_competences_get_grp_c_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_collection_operation_name' => 'get_grp_c'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/grpecompetences' => [
            [['_route' => 'api_groupe_competences_liste_grpe_competences_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_collection_operation_name' => 'liste_grpe_competences'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_groupe_competence', '_controller' => 'App\\Controller\\GroupeCompetenceController::createGroupeCompetence'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/users' => [
            [['_route' => 'api_users_get_users_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get_users'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_user', '_controller' => 'App\\Controller\\UserController::addUser'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'All_users_actif', '_controller' => 'App\\Controller\\UserController:UsersActif'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/admin/profilsorties' => [
            [['_route' => 'api_profil_sorties_get_profils_sortie_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\ProfilSortie', '_api_collection_operation_name' => 'get_profils_sortie'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_profil_sorties_create_profils_sortie_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\ProfilSortie', '_api_collection_operation_name' => 'create_profils_sortie'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/groupes' => [
            [['_route' => 'api_groupes_get_admin_groupes_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_collection_operation_name' => 'get_admin_groupes'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupes_Create_groupes_apprennant_formateur_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_collection_operation_name' => 'Create_groupes_apprennant_formateur'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/groupes/apprenants' => [[['_route' => 'api_groupes_get_admin_groupes_apprenants_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_collection_operation_name' => 'get_admin_groupes_apprenants'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/profils' => [
            [['_route' => 'api_profils_get_profils_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'get_profils'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_profils_create_profils_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_collection_operation_name' => 'create_profils'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/referentiels' => [
            [['_route' => 'api_referentiels_get_referentiels_grpecompetences_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_collection_operation_name' => 'get_referentiels_grpecompetences'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_referentiels_create_referentiels_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_collection_operation_name' => 'create_referentiels'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/referentiels/grpecompetences' => [[['_route' => 'api_referentiels_get_grpecompetences_competences_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_collection_operation_name' => 'get_grpecompetences_competences'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/tags' => [
            [['_route' => 'api_tags_get_tags_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_collection_operation_name' => 'get_tags'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_tags_create_tags_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_collection_operation_name' => 'create_tags'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/competences' => [
            [['_route' => 'api_competences_get_competences_and_niveaux_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_collection_operation_name' => 'get_competences_and_niveaux'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_competences_create_competences_and_niveaux_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_collection_operation_name' => 'create_competences_and_niveaux'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/grptags' => [
            [['_route' => 'api_groupe_tags_get_grpe_tags_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeTags', '_api_collection_operation_name' => 'get_grpe_tags'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupe_tags_create_grpe_tags_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeTags', '_api_collection_operation_name' => 'create_grpe_tags'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/login_check' => [[['_route' => 'authentication_token'], null, ['POST' => 0], null, false, false, null]],
        '/api/admin/users-deleted' => [[['_route' => 'get_users_deleted', '_controller' => 'App\\Controller\\UserController:UsersDeleted'], null, ['GET' => 0], null, false, false, null]],
        '/api/apprenants' => [[['_route' => 'list_apprenant', '_controller' => 'App\\Controller\\UserController::showApprenants'], null, ['GET' => 0], null, false, false, null]],
        '/api/admin/promo/principal' => [[['_route' => 'get_promo_principal', '_controller' => 'App\\Controller\\PromoController::getInfoPrincipal'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api(?'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:77)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:107)'
                        .'|contexts/(.+)(?:\\.([^/]++))?(*:143)'
                        .'|a(?'
                            .'|dmin/(?'
                                .'|gr(?'
                                    .'|p(?'
                                        .'|ecompetences/([^/]++)(?'
                                            .'|(*:196)'
                                            .'|/competences(*:216)'
                                            .'|(*:224)'
                                        .')'
                                        .'|tags/([^/]++)(?'
                                            .'|/tags(?'
                                                .'|(*:257)'
                                            .')'
                                            .'|(*:266)'
                                        .')'
                                    .')'
                                    .'|oupes/([^/]++)(?'
                                        .'|(*:293)'
                                        .'|/apprenants/([^/]++)(*:321)'
                                    .')'
                                .')'
                                .'|users(?'
                                    .'|/([^/]++)(?'
                                        .'|(*:351)'
                                    .')'
                                    .'|\\-integre/([^/]++)(*:378)'
                                .')'
                                .'|pro(?'
                                    .'|fils(?'
                                        .'|orti(?'
                                            .'|e(?'
                                                .'|s/([^/]++)(*:421)'
                                                .'|/([^/]++)(*:438)'
                                            .')'
                                            .'|/([^/]++)(*:456)'
                                        .')'
                                        .'|/([^/]++)(?'
                                            .'|/users(*:483)'
                                            .'|(*:491)'
                                        .')'
                                    .')'
                                    .'|mo/([^/]++)(?'
                                        .'|/profilsortie(?'
                                            .'|s\\(promo\\)(*:541)'
                                            .'|/([^/]+)\\(Promo\\)(*:566)'
                                        .')'
                                        .'|(*:575)'
                                    .')'
                                .')'
                                .'|referentiels/([^/]++)(?'
                                    .'|(*:609)'
                                    .'|/grpecompetences/([^/]++)(*:642)'
                                .')'
                                .'|tags/([^/]++)(?'
                                    .'|(*:667)'
                                .')'
                                .'|competences/([^/]++)(?'
                                    .'|(*:699)'
                                .')'
                            .')'
                            .'|pprenant(?'
                                .'|s/(?'
                                    .'|([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:753)'
                                    .')'
                                    .'|([^/]++)(*:770)'
                                .')'
                                .'|/([^/]++)(*:788)'
                            .')'
                        .')'
                        .'|groupe(?'
                            .'|_competences/([^/]++)/competences(?:\\.([^/]++))?(*:855)'
                            .'|s/([^/]++)/apprenants(?:\\.([^/]++))?(*:899)'
                        .')'
                        .'|formateur(?'
                            .'|s(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:942)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:980)'
                                .')'
                                .'|(*:989)'
                            .')'
                            .'|/([^/]++)(?'
                                .'|(*:1010)'
                            .')'
                        .')'
                        .'|pro(?'
                            .'|fils/([^/]++)/users(?:\\.([^/]++))?(*:1061)'
                            .'|mos(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1094)'
                                .')'
                                .'|/(?'
                                    .'|([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:1136)'
                                    .')'
                                    .'|([^/]++)/(?'
                                        .'|referentiels(?'
                                            .'|(?:\\.([^/]++))?(*:1188)'
                                            .'|/groupe_competences(?'
                                                .'|(?:\\.([^/]++))?(*:1234)'
                                                .'|/([^/]++)/competences(?:\\.([^/]++))?(*:1279)'
                                            .')'
                                        .')'
                                        .'|groupes(?'
                                            .'|(?:\\.([^/]++))?(*:1315)'
                                            .'|/([^/]++)/apprenants(?:\\.([^/]++))?(*:1359)'
                                        .')'
                                        .'|apprenants(?:\\.([^/]++))?(*:1394)'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|referentiels/([^/]++)/groupe_competences(?'
                            .'|(?:\\.([^/]++))?(*:1465)'
                            .'|/([^/]++)/competences(?:\\.([^/]++))?(*:1510)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        77 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        107 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        143 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        196 => [[['_route' => 'api_groupe_competences_get_one_grpe_competences_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_item_operation_name' => 'get_one_grpe_competences'], ['id'], ['GET' => 0], null, false, true, null]],
        216 => [[['_route' => 'api_groupe_competences_competences_get_subresource_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_item_operation_name' => 'competences_get_subresource'], ['id'], ['GET' => 0], null, false, false, null]],
        224 => [[['_route' => 'edit_grpe_competences', '_controller' => 'App\\Controller\\GroupeCompetenceController::EditGroupeCompetence'], ['id'], ['PUT' => 0], null, false, true, null]],
        257 => [
            [['_route' => 'api_groupe_tags_get_one_grpe_tags_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeTags', '_api_item_operation_name' => 'get_one_grpe_tags'], ['id'], ['GET' => 0], null, false, false, null],
            [['_route' => 'api_groupe_tags_tags_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_subresource_operation_name' => 'api_groupe_tags_tags_get_subresource', '_api_subresource_context' => ['property' => 'tags', 'identifiers' => [['id', 'App\\Entity\\GroupeTags', true]], 'collection' => true, 'operationId' => 'api_groupe_tags_tags_get_subresource']], ['id'], ['GET' => 0], null, false, false, null],
        ],
        266 => [
            [['_route' => 'api_groupe_tags_get_one_grpe_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeTags', '_api_item_operation_name' => 'get_one_grpe'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_groupe_tags_edit_tags_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeTags', '_api_item_operation_name' => 'edit_tags'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        293 => [
            [['_route' => 'api_groupes_get_admin_groupes_id_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_item_operation_name' => 'get_admin_groupes_id'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_groupes_Ajouter_apprenant_groupe_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_item_operation_name' => 'Ajouter_apprenant_groupe'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        321 => [[['_route' => 'delete_app_grp', '_controller' => 'App\\Controller\\UserController::deleteAppGrpe'], ['idg', 'id'], ['DELETE' => 0], null, false, true, null]],
        351 => [
            [['_route' => 'api_users_get_one_user_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'get_one_user'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'edit_user', '_controller' => 'App\\Controller\\UserController::EditUser'], ['id'], ['POST' => 0], null, false, true, null],
            [['_route' => 'delete_user', '_controller' => 'App\\Controller\\UserController::deleteUser'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        378 => [[['_route' => 'reintegrer_user', '_controller' => 'App\\Controller\\UserController::IntegrerUser'], ['id'], ['DELETE' => 0], null, false, true, null]],
        421 => [[['_route' => 'api_profil_sorties_get_one_profils_sortie_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\ProfilSortie', '_api_item_operation_name' => 'get_one_profils_sortie'], ['id'], ['GET' => 0], null, false, true, null]],
        438 => [[['_route' => 'api_profil_sorties_edit_profils_sortie_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\ProfilSortie', '_api_item_operation_name' => 'edit_profils_sortie'], ['id'], ['PUT' => 0], null, false, true, null]],
        456 => [[['_route' => 'delete_profil_sortie', '_controller' => 'App\\Controller\\UserController::deleteProfilSorti'], ['id'], ['DELETE' => 0], null, false, true, null]],
        483 => [[['_route' => 'api_profils_users_get_subresource_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'users_get_subresource'], ['id'], ['GET' => 0], null, false, false, null]],
        491 => [
            [['_route' => 'api_profils_get_one_profil_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'get_one_profil'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_profils_edit_profil_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Profil', '_api_item_operation_name' => 'edit_profil'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_profil', '_controller' => 'App\\Controller\\UserController::deleteProfil'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        541 => [[['_route' => 'apprenants_promo_profils_sortie', '_controller' => 'App\\Controller\\ProfilSortieController::getApprenantPromoProfilSortie'], ['id'], ['GET' => 0], null, false, false, null]],
        566 => [[['_route' => 'apprenant_promo_ps', '_controller' => 'App\\Controller\\ProfilSortieController::getApprenantDunProfilDunePromo'], ['idpromo', 'id'], ['GET' => 0], null, false, false, null]],
        575 => [[['_route' => 'edit_promo_ref', '_controller' => 'App\\Controller\\PromoController::editPromo'], ['id'], ['PUT' => 0], null, false, true, null]],
        609 => [
            [['_route' => 'api_referentiels_get_grpecompetences_referentiels_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_item_operation_name' => 'get_grpecompetences_referentiels'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_referentiels_edit_grpecompetences_referentiels_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_item_operation_name' => 'edit_grpecompetences_referentiels'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        642 => [[['_route' => 'get_comp_gc_ref', '_controller' => 'App\\Controller\\ReferentielController::getCompetences_gc_referentiels'], ['id', 'idgc'], ['GET' => 0], null, false, true, null]],
        667 => [
            [['_route' => 'api_tags_get_one_tags_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_item_operation_name' => 'get_one_tags'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_tags_edit_tags_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_item_operation_name' => 'edit_tags'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_tags_delete_tag_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tags', '_api_item_operation_name' => 'delete_tag'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        699 => [
            [['_route' => 'api_competences_get_levels_competences_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_item_operation_name' => 'get_levels_competences'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_competences_edit_levels_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_item_operation_name' => 'edit_levels'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'archivage_competence', '_controller' => 'App\\Controller\\GroupeCompetenceController::deleteComp'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        753 => [
            [['_route' => 'api_apprenants_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_apprenants_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_apprenants_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_apprenants_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        770 => [[['_route' => 'edit_apprenant', '_controller' => 'App\\Controller\\UserController::editApprenant'], ['id'], ['PUT' => 0], null, false, true, null]],
        788 => [[['_route' => 'show_apprenant', '_controller' => 'App\\Controller\\UserController::findApprenantsById'], ['id'], ['GET' => 0], null, false, true, null]],
        855 => [[['_route' => 'api_groupe_competences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_groupe_competences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competences', 'identifiers' => [['id', 'App\\Entity\\GroupeCompetences', true]], 'collection' => true, 'operationId' => 'api_groupe_competences_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        899 => [[['_route' => 'api_groupes_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_groupes_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Groupes', true]], 'collection' => true, 'operationId' => 'api_groupes_apprenants_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        942 => [
            [['_route' => 'api_formateurs_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        980 => [
            [['_route' => 'api_formateurs_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_formateurs_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Formateur', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        989 => [[['_route' => 'list_formateur_cm', '_controller' => 'App\\Controller\\UserController::showFormateurs'], [], ['GET' => 0], null, false, false, null]],
        1010 => [
            [['_route' => 'show_formateur', '_controller' => 'App\\Controller\\UserController::findFormateursById'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'edit_formateur', '_controller' => 'App\\Controller\\UserController::editFormateur'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        1061 => [[['_route' => 'api_profils_users_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_subresource_operation_name' => 'api_profils_users_get_subresource', '_api_subresource_context' => ['property' => 'users', 'identifiers' => [['id', 'App\\Entity\\Profil', true]], 'collection' => true, 'operationId' => 'api_profils_users_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1094 => [
            [['_route' => 'api_promos_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_promos_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1136 => [
            [['_route' => 'api_promos_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_promos_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_promos_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_promos_patch_item', '_controller' => 'api_platform.action.patch_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Promos', '_api_item_operation_name' => 'patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
        ],
        1188 => [[['_route' => 'api_promos_referentiels_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Referentiels', '_api_subresource_operation_name' => 'api_promos_referentiels_get_subresource', '_api_subresource_context' => ['property' => 'referentiels', 'identifiers' => [['id', 'App\\Entity\\Promos', true]], 'collection' => false, 'operationId' => 'api_promos_referentiels_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1234 => [[['_route' => 'api_promos_referentiels_groupe_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_subresource_operation_name' => 'api_promos_referentiels_groupe_competences_get_subresource', '_api_subresource_context' => ['property' => 'groupeCompetences', 'identifiers' => [['id', 'App\\Entity\\Promos', true], ['referentiels', 'App\\Entity\\Referentiels', false]], 'collection' => true, 'operationId' => 'api_promos_referentiels_groupe_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1279 => [[['_route' => 'api_promos_referentiels_groupe_competences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_promos_referentiels_groupe_competences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competences', 'identifiers' => [['id', 'App\\Entity\\Promos', true], ['referentiels', 'App\\Entity\\Referentiels', false], ['groupeCompetences', 'App\\Entity\\GroupeCompetences', true]], 'collection' => true, 'operationId' => 'api_promos_referentiels_groupe_competences_competences_get_subresource']], ['id', 'groupeCompetences', '_format'], ['GET' => 0], null, false, true, null]],
        1315 => [[['_route' => 'api_promos_groupes_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Groupes', '_api_subresource_operation_name' => 'api_promos_groupes_get_subresource', '_api_subresource_context' => ['property' => 'groupes', 'identifiers' => [['id', 'App\\Entity\\Promos', true]], 'collection' => true, 'operationId' => 'api_promos_groupes_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1359 => [[['_route' => 'api_promos_groupes_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_promos_groupes_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Promos', true], ['groupes', 'App\\Entity\\Groupes', true]], 'collection' => true, 'operationId' => 'api_promos_groupes_apprenants_get_subresource']], ['id', 'groupes', '_format'], ['GET' => 0], null, false, true, null]],
        1394 => [[['_route' => 'api_promos_apprenants_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Apprenant', '_api_subresource_operation_name' => 'api_promos_apprenants_get_subresource', '_api_subresource_context' => ['property' => 'apprenants', 'identifiers' => [['id', 'App\\Entity\\Promos', true]], 'collection' => true, 'operationId' => 'api_promos_apprenants_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1465 => [[['_route' => 'api_referentiels_groupe_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\GroupeCompetences', '_api_subresource_operation_name' => 'api_referentiels_groupe_competences_get_subresource', '_api_subresource_context' => ['property' => 'groupeCompetences', 'identifiers' => [['id', 'App\\Entity\\Referentiels', true]], 'collection' => true, 'operationId' => 'api_referentiels_groupe_competences_get_subresource']], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1510 => [
            [['_route' => 'api_referentiels_groupe_competences_competences_get_subresource', '_controller' => 'api_platform.action.get_subresource', '_format' => null, '_api_resource_class' => 'App\\Entity\\Competence', '_api_subresource_operation_name' => 'api_referentiels_groupe_competences_competences_get_subresource', '_api_subresource_context' => ['property' => 'competences', 'identifiers' => [['id', 'App\\Entity\\Referentiels', true], ['groupeCompetences', 'App\\Entity\\GroupeCompetences', true]], 'collection' => true, 'operationId' => 'api_referentiels_groupe_competences_competences_get_subresource']], ['id', 'groupeCompetences', '_format'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
