# IIIF JSON Manifest Directory

## Descrizione
Carica automaticamente i file JSON nel cartelle `/manifest` all'interno della directory di upload di WordPress.

## Versione
1.0

## Autore
Nicolò Serafino, Leandro Summo, Basilink Art srls, CSAC Parma, Università degli Studi di Parma.

## Funzionalità
- Intercetta il caricamento dei file JSON
- Crea automaticamente la cartella `/manifest` se non esiste
- Sposta i file JSON nella cartella `/manifest` mantenendo l'integrità dei dati
- Aggiorna automaticamente l'URL del file per riflettere la nuova posizione

## Installazione
1. Copia la cartella nel directory `/wp-content/plugins/`
2. Attiva il plugin dal pannello di amministrazione di WordPress

## Utilizzo
Il plugin funziona automaticamente quando carichi file JSON tramite il media uploader di WordPress.

### Comportamento
- Quando carichi un file `.json`, verrà automaticamente spostato in `/wp-content/uploads/manifest/`
- L'URL del file sarà aggiornato automaticamente per puntare alla nuova posizione
- I file non-JSON non saranno affetti da questo plugin

## Requisiti
- WordPress con permessi di scrittura nella directory `/wp-content/uploads/`
- File system accessibile per la creazione di cartelle

## Struttura delle cartelle
```
/wp-content/uploads/
└── manifest/
    ├── file1.json
    ├── file2.json
    └── ...
```

## Note
- La cartella `/manifest` viene creata con permessi 0755 se non esiste già
- Il plugin utilizza il filtro `wp_handle_upload` di WordPress

## 📝 Licenza
AGPLv3 (dettagli https://www.gnu.org/licenses/agpl-3.0.html)

## 👥 Team
CSAC (www.csacparma.it)
Visionaria (www.visionaria-archivio.it)
Università degli Studi di Parma (www.unipr.it)
Basilink Art srls (www.basilinkart.it)
