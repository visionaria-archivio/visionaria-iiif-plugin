<?php
/**
 * Plugin Name: IIIF Formattazione Automatica
 * Description: Converte automaticamente i testi con asterischi in <em> e gli URL in link cliccabili nel viewer Mirador.
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

add_action('wp_footer', 'iiif_formattazione_script', 100);

function iiif_formattazione_script() {
  ?>
  <script>
    function formatText(element) {
      if (!element || !element.innerHTML) return;

      // Sostituisce *testo* con <em>testo</em>
      element.innerHTML = element.innerHTML.replace(/\*(.*?)\*/g, '<em>$1</em>');

      // Applica la trasformazione URL solo ai tag <p> e <span> figli di element
      element.querySelectorAll('p, span').forEach(function(node) {
        node.innerHTML = node.innerHTML.replace(
          /\bhttps?:\/\/[^\s<]+/g,
          '<a href="$&" target="_blank">$&</a>'
        );
      });
    }

    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType === 1) {
            node.querySelectorAll('.MuiTypography-root, .title').forEach(formatText);
            if (node.classList.contains('MuiTypography-root, title')) {
              formatText(node);
            }
          }
        });
      });
    });

    observer.observe(document.body, { childList: true, subtree: true });

    window.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.MuiTypography-root, .manifest-info, h1, h2, .title').forEach(formatText);
    });
  </script>
  <?php
}

