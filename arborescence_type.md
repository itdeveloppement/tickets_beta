/mon_projet
    /app 
    logique de l'application

        /controllers
        Contient les classes de contrôleurs qui gèrent les requêtes HTTP, traitent les données et renvoient les réponses appropriées, souvent en interaction avec les modèles et les vues.
        
        /models
        Contient les classes de modèles qui représentent les données de l'application et interagissent avec la base de données, gérant les opérations CRUD (Create, Read, Update, Delete).
        
        /views
        Contient les fichiers de vues qui définissent la présentation des données. Ces fichiers génèrent l'HTML qui sera envoyé au navigateur de l'utilisateur.
            /error
            les vues pour les pages d'erreur personnalisées
            /layout
            éléments HTML réutilisables tels que l'en-tête, le pied de page, la barre de navigation, etc.,
            /main
            les vues principales de l'application. Cela pourrait inclure les vues pour les pages principales de l'application, telles que la page d'accueil, le tableau de bord, les pages de contenu principal, etc
        
        /utils
        Contient des classes ou fonctions utilitaires réutilisables qui fournissent des fonctionnalités auxiliaires telles que la manipulation de chaînes de caractères, la gestion des dates, etc.
        
        /services
        Contient les classes de services qui encapsulent des logiques métiers spécifiques ou des fonctionnalités de l'application, telles que la gestion des sessions, l'authentification, la construction de formulaires, etc.
    
    /config
    Contient les fichiers de configuration de l'application, définissant des paramètres et des constantes nécessaires pour le fonctionnement de l'application.
    
    /public
    Contient les fichiers accessibles publiquement, y compris le point d'entrée principal de l'application (index.php), ainsi que les assets (CSS, JavaScript,, images).
        /css
        /fonts
        /images
        /js
        index.php
   
    /vendor
    Contient les dépendances de l'application installées via Composer, le gestionnaire de paquets PHP. Ce dossier ne doit pas être modifié manuellement.
    
    /tests
    
    /storage
    Contient les fichiers générés par l'application qui doivent être persistés, tels que les logs, les uploads de fichiers, les caches, etc.

    composer.json
    Fichier de configuration pour Composer, définissant les dépendances de l'application et les scripts de gestion de projet.

    .env
    Fichier de configuration des variables d'environnement, contenant des informations sensibles et spécifiques à l'environnement comme les identifiants de base de données, les clés API, etc.