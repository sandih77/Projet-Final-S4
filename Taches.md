* [X] Initialisation git : Sandih (5 min)
* [X] Creation base : Sandih - Finiavana (20 min)
* [ ] V1
  * [X] Operateur : Finiavana
    * [X] Gestion des Prefixes
      * [X] Base de donnees

        * [X] Tables :
          * [X] operateur :
            * id integer
            * nom text unique
          * [X] prefixes :
            * id integer
            * prefixes text unique
            * operateur integer fk
        * [ ] Vues :
      * [X] Modeles : (15 min)

        * [X] OperateurModel
        * [X] PrefixesModel
          * [X] Fonctions :
            * [X] FindAllByOperateurId
      * [X] Controller :

        * [X] OperateurController
          * [X] Fonctions :
            * [X] CRUD
        * [X] PrefixesController
          * [X] Fonctions :
            * [X] CRUD
      * [X] View :

        * [X] operateurs
        * [X] prefixes
          [X] Gestion des types d'operation
      * [X] Modeles :

        * [X] TypesOperationModel
      * [X] Controller :

        * [X] TypesOperationController
      * [X] Vues :

        * [X] types_operation
    * [X] Finance
      * [X] Modeles :
        * [X] BaremesModel
        * [X] OperationsModel
          * [X] Fonctions :
            * [X] getGainTotal
            * [X] getGainParTypeOperation
            * [X] getGainParOperateur
            * [X] getSoldeClient
      * [X] Controller :
        * [X] GainController
        * [X] BaremesController
      * [X] Vues :
        * [X] baremes
    * [X] Compte client
      * [X] Integration dans le dashboard
      * [X] Calcul dynamique du solde via l'historique
  * [ ] Client : Sandih
    * [ ] Login
      * [X] Base de donnees
        * [X] Tables
          * [X] Clients
            - id
            - nom
            - prenom
            - téléphone
            - code secret
            - solde
      * [ ] Modèle
        * [X] ClientModel
      * [X] HTML
        * [X] input telephone
        * [X] input code secret
      * [ ] CSS / Bootstrap
      * [ ] Intégration php
        * [ ] Règle d'authentification
          * [X] vérification du numéro de téléphone et du code secret
        * [ ] Validation du formulaire
          * [X] Code serveur
            * [X] Format de numéro de téléphone à Madagascar
            * [X] Code secret 4 chiffres
          * [ ] Ajax (javascript)
          * [X] HTML
    * [X] Operation :
      * [X] Solde
        * [X] fonction getSoldeClient
      * [X] Depot
        * [X] fonction faireDepot
          * [X] enregistrement d une ligne d operations
      * [X] Retrait
        * [X] fonction faireRetrait
          * [X] verification du solde
          * [X] enregistrement d une ligne d operations
      * [X] Transfert
        * [X] fonction faireTransfert
          * [X] verification du solde
          * [X] verification operateur emetteur et destinataire
          * [X] enregistrement d une ligne d operations
    * [X] Historique
* [ ] V2
  * [ ] Operateur : Finiavana - Sandih
    * [X] Configuration des prefixes des autres operateur - Finiavana (deja present dans v1) : 1 min
    * [ ] Configuration % commission vers les autres operateurs - Sandih
    * [X] Separation des gain dans le dashboard - Finiavana
      * [X] Models :
        * [X] OperationModel
          * [X] Fonctions :
            * [X] getGainTotal : 3 min
            * [X] getGainAutreOperateur : 20 min
      * [X] Controller :
        * [X] GainController : 5 min
        * [X] OperateursController : 5 min
      * [X] Vues :
        * [X] dashboard : 5 min
    * [X] Situation des montant a envoyer aux autres operateur - Finiavana
      * [X] Models :
        * [X] OperationModel
          * [X] Fonctions :
            * [X] getMontantsAEnvoyerParOperateur : 20 min
      * [X] Controller :
        * [X] OperateursController : 5 min
      * [X] Vues :
        * [X] dashboard : 5 min
  * [X] Client
    * [X] Fonctionnalite : ajouter frais de retrait(meme operateur) - Sandih
    * [X] Envoye multiple - Sandih


Notion epargne
Pour chaque client
Choisir le pourcentage 
Exemple 
Client 1 = epargne 20%
Quand il y a une transfert
20% montant -> epargne
