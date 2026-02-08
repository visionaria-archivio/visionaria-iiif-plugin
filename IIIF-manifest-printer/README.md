# IIIF Manifest Printer

## Descrizione
Inserisce automaticamente il contenuto di un manifest IIIF nel post, includendo metadati e dettagli dei canvas.

## Versione
1.5

## Autore
Nicolò Serafino, Leandro Summo, Basilink Art srls, CSAC Parma, Università degli Studi di Parma.

## Funzionalità
- Recupera automaticamente il contenuto di un manifest IIIF tramite URL
- Estrae i metadati principali (titolo, descrizione, crediti, diritti)
- Genera automaticamente il contenuto HTML del post con i dati del manifest
- Supporta shortcode `[fwdemv id="..."]` per l'integrazione con Mirador
- Processa i canvas e i relativi dettagli
- Supporta metadati multilingue (italiano e altre lingue)
- Gestisce gli errori di recupero e decodifica JSON

## Installazione
1. Copia la cartella nel directory `/wp-content/plugins/`
2. Attiva il plugin dal pannello di amministrazione di WordPress

## Utilizzo
Il plugin richiede il campo ACF `manifest_id` configurato nel post:

1. Configura un campo ACF denominato `manifest_id` nel tuo Custom Post Type
2. Inserisci l'URL del manifest IIIF in questo campo
3. Quando salvi/pubblichi il post, il plugin popola automaticamente il contenuto

### Struttura del Manifest IIIF
Il plugin supporta manifest IIIF standard con la seguente struttura:
```json
{
  "label": { "it": ["Titolo del Manifest"] },
  "summary": { "it": ["Descrizione"] },
  "requiredStatement": { "value": { "it": ["Crediti"] } },
  "rights": "URL ai diritti",
  "metadata": [
    { "label": { "it": ["Campo"] }, "value": { "it": ["Valore"] } }
  ],
  "items": [ /* Canvas array */ ]
}
```

## Requisiti
- WordPress con ACF (Advanced Custom Fields) installato
- Campo ACF `manifest_id` configurato
- Accesso a internet per recuperare il manifest IIIF
- Permessi di modifica dei post

## Campi estratti dal Manifest
- **Titolo**: dal campo `label` (priorità italiano)
- **Descrizione**: dal campo `summary` (priorità italiano)
- **Crediti**: dal campo `requiredStatement.value` (priorità italiano)
- **Diritti**: dal campo `rights`
- **Metadati**: array di coppie etichetta-valore multilingue
- **Canvas**: dettagli dei singoli canvas del manifest

## Gestione degli Errori
Il plugin gestisce automaticamente:
- Errori di connessione nel recupero del manifest
- Errori di decodifica JSON
- Campi mancanti o vuoti nei dati

## Note
- Il plugin evita l'esecuzione durante autosave e post revision
- Preserva gli shortcode `[fwdemv]` se presenti nel contenuto originale
- La formattazione HTML viene generata automaticamente
- Il plugin rispetta le impostazioni di pubblicazione di WordPress

## 📝 Licenza
AGPLv3 (dettagli https://www.gnu.org/licenses/agpl-3.0.html)

## 👥 Team
CSAC (www.csacparma.it)
Visionaria (www.visionaria-archivio.it)
Università degli Studi di Parma (www.unipr.it)
Basilink Art srls (www.basilinkart.it)
