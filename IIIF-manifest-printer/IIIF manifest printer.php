<?php
/**
 * Plugin Name: IIIF Manifest Printer
 * Description: Inserisce automaticamente il contenuto di un manifest IIIF nel post, includendo metadati e dettagli dei canvas.
 * Version: 1.5
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
 * @copyright 2026 Nicolò Serafino, Leandro Summo, Basilink Art srls, CSAC Parma, Università degli Studi di Parma.
 */

function custom_script_update_post_content($post_id) {
    // Evita aggiornamenti indesiderati
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (wp_is_post_autosave($post_id)) return;

    // Controlla se esiste il campo ACF 'manifest_id'
    $manifest_id = get_field('manifest_id', $post_id);
    if (!$manifest_id) return;

    // Recupera il contenuto originale del post
    $original_post = get_post($post_id);
    $original_content = $original_post ? $original_post->post_content : '';

    // Verifica se il contenuto inizia con [fwdemv id="..."]
    $has_fwdemv_shortcode = false;
    if (preg_match('/\[fwdemv\s+id="[^"]*"\]/', $original_content, $matches)) {
		$shortcode = $matches[0];
        $has_fwdemv_shortcode = true;
    }

    $response = wp_remote_get($manifest_id);
    if (is_wp_error($response)) {
        $new_content = '<p>Errore nella richiesta: ' . esc_html($response->get_error_message()) . '</p>';
    } else {
        $manifest_data = wp_remote_retrieve_body($response);
        $data = json_decode($manifest_data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $new_content = '<p>Errore nella decodifica del JSON.</p>';
        } else {
            // Estrai dati generali
            $title = $data['label']['it'][0] ?? 'Senza titolo';
            $summary = $data['summary']['it'][0] ?? 'Nessuna descrizione';
            $credit = $data['requiredStatement']['value']['it'][0] ?? 'N/A';
			$rights = $data['rights'] ?? 'N/A';

            // Metadati generali
            $metadata_html = '';
            if (!empty($data['metadata']) && is_array($data['metadata'])) {
                foreach ($data['metadata'] as $meta) {
                    $label = $meta['label']['it'][0] ?? 'N/A';
                    $value = $meta['value']['it'][0] ?? '';
                    if ($value !== '') {
                        $metadata_html .= '<p><strong>' . esc_html($label) . '</strong><br>' . esc_html($value) . '</p>';
                    }
                }
            }
            $metadata_html .= '<hr>';
			
			// Recupera l'autore e il label
			$author = '';
			if (!empty($data['metadata']) && is_array($data['metadata'])) {
    			foreach ($data['metadata'] as $meta) {
        			$label = $meta['label']['it'][0] ?? '';
        			if (strtolower($label) === 'autore') {
            			$author = $meta['value']['it'][0] ?? '';
        			}
					if (strtolower($label) === 'labels') {
            			$labels = $meta['value']['it'][0] ?? '';
        			}
    			}
			}

            // Canvas
            $canvas_html = '';
            $canvas_count = 0;
            $inventory_numbers = [];
            $canvas_summaries = [];

            if (!empty($data['items']) && is_array($data['items'])) {
                $canvas_count = count($data['items']);
                foreach ($data['items'] as $canvas) {
                    // Raccogli numeri d'inventario e summary
                    if (!empty($canvas['metadata']) && is_array($canvas['metadata'])) {
                        foreach ($canvas['metadata'] as $meta) {
                            $label = $meta['label']['it'][0] ?? 'N/A';
                            $value = $meta['value']['it'][0] ?? '';
                            if (strtolower($label) === 'numero d\'inventario' && $value !== '') {
                                $inventory_numbers[] = $value;
                            }
                        }
                    }
                    $canvas_summaries[] = $canvas['summary']['it'][0] ?? '';
                }

                // Verifica se tutti i numeri d'inventario sono uguali
                $all_inventory_equal = false;
                if (count($inventory_numbers) > 0) {
                    $all_inventory_equal = (count(array_unique($inventory_numbers)) === 1);
                }

                // Se tutti uguali, raccogli i metadati del primo canvas
                $first_canvas_metadata_html = '';
                if ($all_inventory_equal && !empty($data['items'][0]['metadata'])) {
                    foreach ($data['items'][0]['metadata'] as $meta) {
                        $label = $meta['label']['it'][0] ?? 'N/A';
                        $value = $meta['value']['it'][0] ?? '';
                        if ($value !== '') {
                            $first_canvas_metadata_html .= '<p><strong>' . esc_html($label) . '</strong><br>' . esc_html($value) . '</p>';
                        }
                    }
					$first_canvas_metadata_html .= '<hr>';
                }

                // Secondo ciclo: genera HTML
                foreach ($data['items'] as $idx => $canvas) {
                    // Se tutti uguali, salta i metadati dei canvas successivi
                    if (!$all_inventory_equal && !empty($canvas['metadata']) && is_array($canvas['metadata'])) {
                        // Mostra il titolo del canvas
                        $canvas_label = $canvas['label']['it'][0] ?? '';
                        if ($canvas_label !== '') {
                            $canvas_html .= '<h2>' . esc_html($canvas_label) . '</h2>';
                        }
                        foreach ($canvas['metadata'] as $meta) {
                            $label = $meta['label']['it'][0] ?? 'N/A';
                            $value = $meta['value']['it'][0] ?? '';
                            if ($value !== '') {
                                $canvas_html .= '<p><strong>' . esc_html($label) . '</strong><br>' . esc_html($value) . '</p>';
                            }
                        }
                    }
                    // Mostra la descrizione solo se i numeri d'inventario sono diversi
                    $canvas_summary = $canvas_summaries[$idx];
                    if ($canvas_summary && !$all_inventory_equal) {
                        $canvas_html .= '<p><strong>Descrizione</strong><br>' . esc_html($canvas_summary) . '</p><hr>';
                    }
                }
            }

            // Se tutti i numeri d'inventario sono uguali, mostra la descrizione e i metadati una sola volta in alto
            $all_canvas_summary = '';
            if ($all_inventory_equal && !empty($canvas_summaries[0])) {
                $all_canvas_summary = esc_html($canvas_summaries[0]) . '</p><hr>';
            }

            // HTML finale
            // Gestione labels: supporta "Fragile / Nascosto", "fragile, nascosto", ecc.
            $labels_html = '';
            if (!empty($labels)) {
                // Sostituisci '/' e ',' con ',' e dividi
                $labels_clean = str_replace(['/', '\\'], ',', $labels);
                $labels_array = array_map('trim', explode(',', strtolower($labels_clean)));
                foreach ($labels_array as $lbl) {
                    if ($lbl === 'fragile') {
                        $labels_html .= '<span class="label-catalogo fragile">Fragile</span>';
                    }
                    if ($lbl === 'nascosto') {
                        $labels_html .= '<span class="label-catalogo nascosto">Nascosto</span>';
                    }
                }
            }

            $new_content = '
			' . $labels_html . $shortcode;

            if (!$has_fwdemv_shortcode) {
                $new_content .= '
                <script src="https://unpkg.com/mirador@latest/dist/mirador.min.js"></script>
                <div id="mirador-container"></div>
                <div><script type="text/javascript">
                var mirador = Mirador.viewer({
                    id: "mirador-container",
                    language: "it",
                    windows: [{
                        loadedManifest: "' . esc_url($manifest_id) . '",
                        thumbnailNavigationPosition: "far-right",
                        sideBarPanel: "info",
                        sideBarOpen: true,
                        allowClose: false
                    }],
                    workspace: {
                        showZoomControls: false
                    }
                });
                </script></div>
                </br></br>';
            }

            $new_content .= '
            <div class="manifest-info">';
            $new_content .= $all_canvas_summary . $metadata_html . $first_canvas_metadata_html . $canvas_html . '
                <p><strong>Crediti</strong>
                ' . esc_html($credit) . '</p>
                <p><strong>Manifest ID</strong>
                ' . esc_html($manifest_id) . '</p>
				<p><strong>Licenza</strong>
                ' . esc_html($rights) . '</p>
            </div>';
        }
    }

    // Disattiva momentaneamente i trigger per evitare loop
    remove_action('save_post', 'custom_script_update_post_content');
    remove_action('acf/save_post', 'custom_script_update_post_content');
    remove_action('wp_insert_post', 'custom_script_update_post_content');

    // Aggiorna contenuto del post
    wp_update_post([
        'ID' => $post_id,
        'post_content' => $new_content
    ]);

    // Riattiva i trigger
    add_action('save_post', 'custom_script_update_post_content');
    add_action('acf/save_post', 'custom_script_update_post_content');
    add_action('wp_insert_post', 'custom_script_update_post_content');
}

// Hook sulle azioni di salvataggio
add_action('save_post', 'custom_script_update_post_content');
add_action('acf/save_post', 'custom_script_update_post_content');
add_action('wp_insert_post', 'custom_script_update_post_content');
