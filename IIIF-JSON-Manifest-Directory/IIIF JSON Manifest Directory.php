<?php
/**
 * Plugin Name: IIIF JSON manifest directory
 * Description: Automatically upload JSON files to the /manifest folder.
 * Version: 1.0
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

if (!defined('ABSPATH')) {
    exit; // Evita accessi diretti
}

function json_manifest_move_file($file)
{
    $upload_dir = wp_upload_dir();
    $target_dir = $upload_dir['basedir'] . '/manifest/';

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_path = $file['file'];
    $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);

    if ($file_ext === 'json') {
        $new_path = $target_dir . basename($file_path);
        if (rename($file_path, $new_path)) {
            $file['file'] = $new_path;
            $file['url'] = $upload_dir['baseurl'] . '/manifest/' . basename($file_path);
        }
    }

    return $file;
}

add_filter('wp_handle_upload', 'json_manifest_move_file');
