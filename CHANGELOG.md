# Changelog

Tutte le modifiche importanti a questo progetto saranno documentate in questo file.

Il formato è basato su [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
e questo progetto aderisce al [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned
- Supporto per IIIF Presentation API v4
- Integrazione con Web Annotations
- Supporto per manifesti multilayer
- Dashboard analytics avanzato

---

## [1.0.0] - 2026-02-07

### Added
- **IIIF Autore Category Generator** v1.1
  - Creazione automatica di categorie per Custom Post Type "autore"
  - Generazione gerarchica di tassonomie
  - Prevenzione di duplicati

- **IIIF Formattazione Automatica** v1.1
  - Trasformazione testo con asterischi in corsivo
  - Conversione automatica di URL in link
  - Monitoraggio DOM in tempo reale
  - Integrazione Mirador viewer

- **IIIF JSON Manifest Directory** v1.0
  - Organizzazione automatica file JSON manifest
  - Creazione gerarchica di directory `/manifest`
  - Aggiornamento automatico degli URL
  - Validazione file IIIF

- **IIIF Manifest Printer** v1.5
  - Recupero automatico manifest IIIF
  - Estrazione metadati IIIF
  - Generazione contenuto HTML automatica
  - Supporto shortcode Mirador
  - Metadati multilingue (italiano, inglese)
  - Integrazione ACF (Advanced Custom Fields)

### Features
- Documentazione completa per ogni plugin
- README dettagliati con esempi di utilizzo
- Architettura modulare e facilmente estensibile
- Supporto per Custom Post Types di WordPress
- Compatibilità con IIIF Presentation API v3
- Gestione intelligente di risorse digitali

### Security
- Validazione input file
- Sanitizzazione output HTML
- Protezione contro accesso diretto ai file plugin
- Gestione sicura dei percorsi file system

### Documentation
- README principale con architettura completa
- README individuali per ogni plugin
- Esempi di configurazione ACF
- Guida all'installazione step-by-step

---

## Standard di Versionamento

Questo progetto segue [Semantic Versioning](https://semver.org/):

- **MAJOR** - Cambiamenti non retrocompatibili
- **MINOR** - Nuove funzionalità retrocompatibili
- **PATCH** - Bugfix retrocompatibili

### Tag di Release

I tag di release seguono il formato: `v{MAJOR}.{MINOR}.{PATCH}`

Esempio: `v1.0.0`, `v1.1.0`, `v1.0.1`

---

## Come Contribuire

Per una lista di cambiamenti proposti e futuri, vedi [CONTRIBUTING.md](CONTRIBUTING.md).

Per segnalare bug o richiedere nuove funzionalità, contatta il team attraverso i contatti ufficiali.
