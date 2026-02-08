# IIIF Formattazione Automatica

## Descrizione
Converte automaticamente i testi con asterischi in `<em>` e gli URL in link cliccabili nel viewer Mirador.

## Versione
1.1

## Autore
Nicolò Serafino, Leandro Summo, Basilink Art srls, CSAC Parma, Università degli Studi di Parma.

## Funzionalità
- Trasforma automaticamente il testo racchiuso tra asterischi (`*testo*`) in formato corsivo (`<em>`)
- Converte gli URL (http/https) in link cliccabili con apertura in nuova finestra
- Monitora i cambiamenti nel DOM e applica la formattazione ai nuovi elementi aggiunti
- Funziona con il viewer Mirador e gli elementi MuiTypography

## Installazione
1. Copia la cartella nel directory `/wp-content/plugins/`
2. Attiva il plugin dal pannello di amministrazione di WordPress

## Utilizzo
Il plugin funziona automaticamente quando il sito carica. Non richiede configurazione manuale.

### Esempi di formattazione
- `*questo testo*` → `<em>questo testo</em>`
- `https://example.com` → `<a href="https://example.com" target="_blank">https://example.com</a>`

## Requisiti
- WordPress con Mirador viewer integrato
- JavaScript abilitato nel browser

## Note
- Il plugin applica la formattazione agli elementi con classi: `.MuiTypography-root`, `.title`, `.manifest-info`, `h1`, `h2`
- I link si aprono sempre in una nuova finestra
- La formattazione viene applicata anche ai nuovi elementi aggiunti dinamicamente al DOM

## 📝 Licenza
AGPLv3 (dettagli https://www.gnu.org/licenses/agpl-3.0.html)

## 👥 Team
CSAC (www.csacparma.it)
Visionaria (www.visionaria-archivio.it)
Università degli Studi di Parma (www.unipr.it)
Basilink Art srls (www.basilinkart.it)
