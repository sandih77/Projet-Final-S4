* [X] Initialisation git : Sandih (5 min)
* [X] Creation base : Sandih - Finiavana (20 min)
* [ ] V1
  * [ ] Operateur : Finiavana
    * [ ] Gestion des Prefixes
      * [ ] Base de donnees

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
    * [ ] Gestion des types d'operation
    * [ ] Finance
    * [ ] Compte client
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
        * [ ] ClientModel
      * [X] HTML
        * [X] input telephone
        * [X] input code secret
      * [ ] CSS / Bootstrap
      * [ ] Intégration php
        * [ ] Règle d'authentification
          * [ ] vérification du numéro de téléphone et du code secret
        * [ ] Validation du formulaire
          * [X] Code serveur
            * [X] Format de numéro de téléphone à Madagascar
            * [X] Code secret 4 chiffres
          * [ ] Ajax (javascript)
          * [X] HTML
    * [ ] Operation :
      * [ ] Solde
      * [ ] Depot
      * [ ] Retrait
      * [ ] Transfert
      * [ ] Historique
