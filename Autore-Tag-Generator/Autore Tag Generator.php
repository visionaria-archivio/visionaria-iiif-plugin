<?php
/**
 * Plugin Name: IIIF Autore Category Generator
 * Description: Crea automaticamente una categoria figlia con il titolo del post per il Custom Post Type "autore" sotto la categoria genitore "Autori", solo quando il post è pubblicato.
 * Version: 1.1
 * Author: Nicolò Serafino (www.nicoloserafino.it)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license GNU Affero General Public License v3.0
 * @copyright 2026 Nicolò Serafino, Visionaria, CSAC, Università degli Studi di Parma, Basilink Art srls
 */

function create_category_for_autore_on_publish($post_id) {
    // Recupera il titolo del post
    $post_title = get_the_title($post_id);

    // Controlla se il titolo esiste ed è valido
    if (!empty($post_title)) {
        // Controlla se la categoria genitore "Autori" esiste, altrimenti creala
        $parent_category = get_term_by('name', 'Autori', 'category');
        if (!$parent_category) {
            $parent_category = wp_insert_term('Autori', 'category');
            if (is_wp_error($parent_category)) {
                return; // Esci se c'è un errore nella creazione della categoria
            }
            $parent_category_id = $parent_category['term_id'];
        } else {
            $parent_category_id = $parent_category->term_id;
        }

        // Controlla se esiste già una categoria figlia con lo stesso titolo
        $existing_category = get_term_by('name', $post_title, 'category');
        if (!$existing_category) {
            // Crea una nuova categoria figlia sotto "Autori"
            wp_insert_term($post_title, 'category', [
                'parent' => $parent_category_id,
            ]);
        }
    }
}

// Esegui la funzione solo quando un post "autore" viene pubblicato
add_action('publish_autore', 'create_category_for_autore_on_publish');
