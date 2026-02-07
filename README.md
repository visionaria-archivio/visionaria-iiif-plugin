# Visionaria IIIF Plugin Collection
Sistema completo di plugin WordPress per l'integrazione di IIIF (International Image Interoperability Framework) e fruizione di contenuti digitali con Mirador viewer.

## 📋 Indice
- [Panoramica](#-panoramica)
- [Architettura](#-architettura)
- [Funzionalità Principali](#-funzionalità-principali)
- [Tecnologie](#-tecnologie)
- [Requisiti](#-requisiti)
- [Installazione](#-installazione)
- [Configurazione](#-configurazione)
- [Licenza](#-licenza)

## 🎯 Panoramica
La Visionaria IIIF Plugin Collection è una suite di plugin WordPress che facilita l'integrazione di risorse digitali conformi allo standard IIIF, fornendo:

- **Gestione Automatica di Contenuti** - Catalogazione e organizzazione intelligente di risorse digitali
- **Visualizzazione IIIF** - Integrazione completa con Mirador viewer per la fruizione
- **Formattazione Avanzata** - Trasformazione automatica di contenuti con supporto multi-formato
- **Gestione Manifest** - Organizzazione automatica di file JSON manifest IIIF
- **Categorizzazione Intelligente** - Creazione dinamica di categorie basata su contenuti

### Casi d'Uso
- **Musei e Archivi Digitali** - Fruizione di collezioni digitali conformi IIIF
- **Biblioteche Digitali** - Gestione di manoscritti e documenti storici
- **Archivi Digitali** - Organizzazione di risorse culturali
- **Esposizioni Digitali** - Presentazione di contenuti multimediali interattivi
- **Progetti di Ricerca** - Accesso e annotazione di materiali scientifici

## 🏗️ Architettura

### Stack Tecnologico
```
┌─────────────────────────────────────────────────────┐
│        Frontend Layer - WordPress Admin             │
├─────────────────────────────────────────────────────┤
│ • Backoffice (WordPress Dashboard)                  │
│ • ACF (Advanced Custom Fields) - Metadata Form      │
│ • Media Uploader - File Management                  │
└─────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────┐
│      Backend Layer - WordPress & Plugins            │
├─────────────────────────────────────────────────────┤
│ • Hooks & Filters System                            │
│ • Custom Post Types & Taxonomies                    │
│ • Custom Fields (ACF Integration)                   │
│ • File Processing & Validation                      │
│ • Database Management (MySQL)                       │
└─────────────────────────────────────────────────────┘
                        ↓
┌────────────┬────────────┬────────────────────────┐
│  MySQL DB  │  WP Media  │   Mirador Viewer       │
│  (Posts,   │  (Uploads) │   (JSON Manifest)      │
│  Metadata) │            │                        │
└────────────┴────────────┴────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────┐
│         Frontend Viewer Layer                       │
├─────────────────────────────────────────────────────┤
│ • Mirador Web Viewer                                │
│ • Responsive Interface                              │
│ • IIIF Manifest Processing                          │
└─────────────────────────────────────────────────────┘
```

### Componenti Principali

**IIIF Autore Category Generator**
- Monitora gli hook di pubblicazione di WordPress
- Gestisce la tassonomia personalizzata delle categorie
- Crea relazioni gerarchiche automatiche

**IIIF Formattazione Automatica**
- Utilizza l'hook `wp_footer` per l'inserimento di script
- Implementa MutationObserver per il monitoraggio DOM
- Processa contenuti sia al caricamento che dinamicamente

**IIIF JSON Manifest Directory**
- Intercetta l'hook `wp_handle_upload`
- Gestisce il file system per l'organizzazione manifest
- Mantiene l'integrità degli URL

**IIIF Manifest Printer**
- Integrazione con ACF per i metadati
- Recupero remoto di manifest IIIF
- Parsing e rendering di dati IIIF

## ✨ Funzionalità Principali

### 🔄 Gestione Automatica dei Contenuti
- Catalogazione intelligente di risorse digitali
- Creazione automatica di categorie basate su contenuti
- Organizzazione gerarchica delle tassonomie
- Supporto per Custom Post Types

### 🎬 Visualizzazione Mirador
- Integrazione completa con Mirador viewer
- Supporto per IIIF Manifest v3
- Rendering responsivo su multi-device
- Visualizzazione di canvas e metadata

### 📝 Formattazione Avanzata
- Trasformazione automatica di testo con asterischi in corsivo
- Conversione di URL in link cliccabili
- Monitoraggio in tempo reale dei cambiamenti DOM
- Supporto per elementi dinamici

### 📦 Gestione Manifest IIIF
- Caricamento e organizzazione automatica di file JSON
- Creazione gerarchica di directory manifest
- Aggiornamento automatico degli URL
- Validazione dei file IIIF

### 🌐 Supporto Multilingue
- Metadati in multiple lingue
- Supporto per etichette localizzate
- Descrizioni in diversi idiomi
- Testi target audience (standard, bambini)

### 📊 Metadati Avanzati
- Estrazione automatica di metadati IIIF
- Supporto per tassonomia scientifica
- Informazioni su provenienza e datazione
- Gestione di crediti e diritti d'autore

## 🛠️ Tecnologie

### Stack Backend
- **CMS:** WordPress 5.0+
- **Linguaggio:** PHP 7.2+
- **Database:** MySQL/MariaDB
- **Plugin Framework:** ACF (Advanced Custom Fields)
- **Librerie:** Composer per la gestione dipendenze

### Stack Frontend
- **JavaScript:** ES6+
- **jQuery:** Utility DOM manipulation
- **API:** REST API di WordPress
- **Viewer:** Mirador (Universal Viewer compatible)

### Librerie JavaScript
- **MutationObserver** - Monitoraggio DOM
- **Web APIs** - Fetch, FileSystem, WebStorage
- **RegEx** - Pattern matching avanzato

### Formati Supportati
- **Manifest:** JSON (IIIF v3)
- **Metadati:** JSON, XML
- **Contenuti:** HTML, Text, Rich Text

## 📋 Requisiti

### Sviluppo
- WordPress >= 5.0
- PHP >= 7.2
- MySQL >= 5.7 o MariaDB >= 10.2
- ACF (Advanced Custom Fields) Pro o Free
- Browser moderno con JavaScript abilitato

### Produzione
- Server Linux (Ubuntu 20.04+ raccomandato)
- WordPress in configurazione stabile
- Certificato SSL (HTTPS)
- Spazio disco per media storage (variabile)
- RAM minimo 2GB

### Per Specifici Plugin
- **IIIF Manifest Printer:** ACF con campi personalizzati
- **IIIF Formattazione:** JavaScript abilitato su browser client
- **JSON Manifest Directory:** Permessi di scrittura su `/wp-content/uploads/`

## 🚀 Installazione

### Installazione manuale
1. Copia la cartella dei singoli plugin nella directory `/wp-content/plugins/` oppure carica il file .zip dal pannello di amministrazione di Wordpress
2. Attiva i plugin dal pannello di amministrazione di WordPress

### Attiva i Plugin
- Accedi al Dashboard WordPress
- Vai su **Plugin > Plugin Installati**
- Attiva i seguenti plugin:
  - IIIF Autore Category Generator
  - IIIF Formattazione Automatica
  - IIIF JSON Manifest Directory
  - IIIF Manifest Printer

## ⚙️ Configurazione
### Configurazione Base
I plugin funzionano out-of-the-box senza configurazione aggiuntiva.

### Configurazione ACF (per IIIF Manifest Printer)
- Vai su **ACF > Field Groups**
- Crea un nuovo field group o utilizza uno esistente
- Aggiungi un campo `manifest_id` di tipo Text
- Assegna il group al Custom Post Type desiderato

### Personalizzazioni
Per modifiche avanzate, consultare i file README individuali di ogni plugin.

### 📝 Licenza
AGPLv3 (dettagli https://www.gnu.org/licenses/agpl-3.0.html)

### 👥 Team
- **CSAC** (www.csacparma.it)
- **Visionaria** (www.visionaria-archivio.it)
- **Università degli Studi di Parma** (www.unipr.it)
- **Basilink Art srls** (www.basilinkart.it)

## 💬 Supporto e Segnalazione di Bug

Per segnalare problemi o suggerire miglioramenti, si prega di contattare il team di sviluppo tramite questa repository

## 📝 Cronologia delle Versioni

- **v1.0** (7 febbraio 2026) - Release iniziale della collezione di plugin
