<?php
/**
 * Role : permet de selectionner, inserer, modifier et supprimer un object
 * Attributs :
 *      # cibler une table
 *          $table : nom de la table
 *          $field (tableau) : liste des champs de la table
 *      # stocket l'objet
 *          $id : l'id de l'objet : 
 *          $values (tableau): les valeurs de l'objet 
 * 
 * Methodes :
 *      selectId() : selectionner un objet par son id
 *      selectList() : selectionner une liste d'objet
 *      update() : modifier un objet
 *      insert(): inserer un opbjet
 *      deletste() : supprimer un objet
 * 
 * Methodes : recuperation ou initialisation des valeurs de l'objet à l'exterieur de la classe
 *      get($champ) : recupere la valeur d'un champ de l'objet courent
 *      getId(): recupere l'id de l'objet courent
 *      set($champ, $value) : modifier ou charger la valeur d'un champs de l'objet courent
 *      setFromTable($tab) : charge les valeurs de l'objet à partir d'un tableau de valeur
 *      
 * Autre Metodes : 
 *      isLoad : verfifier si l'objet courent est chargé 
 *      
 * Construct
 *      charger un objet selon son id à l'initialisation de la classe
 */