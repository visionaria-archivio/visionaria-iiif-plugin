# Guida al Contributo

Grazie per l'interesse nel contribuire a Visionaria IIIF Plugin Collection! Questo documento fornisce linee guida e istruzioni per contribuire al progetto.

## 📋 Codice di Condotta

Questo progetto aderisce a un codice di condotta di inclusione e rispetto. Si aspetta che tutti i contributori mantengano un ambiente accogliente e professionale.

Comportamenti non tollerati:
- Linguaggio offensivo o discriminatorio
- Molestie di qualsiasi tipo
- Attacchi personali
- Contenuti esplicitamente inappropriati

## 🐛 Segnalazione di Bug

### Prima di Segnalare
- Controlla se il bug è già stato segnalato
- Leggi la documentazione del plugin
- Verifica la compatibilità con i requisiti

### Come Segnalare
Quando segnali un bug, includi:

1. **Titolo chiaro e descrittivo**
2. **Descrizione dettagliata del problema**
   - Cosa stavi facendo quando il bug si è verificato?
   - Qual era il comportamento atteso?
   - Qual è stato il comportamento effettivo?
3. **Passi per riprodurre**
   - Istruzioni passo-passo precise
   - Esempi specifici per fare la dimostrazione
4. **Ambiente**
   - Versione WordPress
   - Versione PHP
   - Browser e versione
   - Versione del plugin
5. **Screenshot o Log**
   - Se applicabile, allega screenshot
   - Includi error logs se disponibili

### Formato Consigliato
```
Titolo: [Plugin Name] Breve descrizione del bug

Ambiente:
- WordPress: X.X.X
- PHP: X.X.X
- Browser: XXX X.X.X

Descrizione:
[Descrizione dettagliata del problema]

Passi per riprodurre:
1. [Primo passo]
2. [Secondo passo]
3. [...]

Comportamento atteso:
[Cosa dovrebbe succedere]

Comportamento effettivo:
[Cosa succede invece]

Error Log (se disponibile):
[Incolla il log]
```

## 💡 Suggerimento di Nuove Funzionalità

### Prima di Suggerire
- Verifica che non sia già stato suggerito
- Considera se è in linea con gli obiettivi del progetto
- Valuta la compatibilità con i plugin esistenti

### Come Suggerire
1. **Titolo descrittivo**
2. **Descrizione dettagliata**
   - Caso d'uso che risolve
   - Benefici potenziali
   - Possibili implementazioni
3. **Contesto aggiuntivo**
   - Screenshot o mockup se utili
   - Esempi di utilizzo

## 🔧 Processo di Sviluppo

### Fork e Branch
```bash
# 1. Fork il repository su GitHub
# 2. Clone il fork localmente
git clone https://github.com/TUO-USERNAME/visionaria-iiif-plugin.git
cd visionaria-iiif-plugin

# 3. Crea un branch feature
git checkout -b feature/descrizione-feature
```

### Naming Convention per Branch
- `feature/descrizione` - Nuove funzionalità
- `bugfix/descrizione` - Correzioni di bug
- `docs/descrizione` - Aggiornamenti documentazione
- `refactor/descrizione` - Refactoring del codice

### Commit Message
Usa messaggi chiari e descrittivi:

```
[TIPO] Descrizione breve

Descrizione più dettagliata se necessaria
- Punto 1
- Punto 2

Fix #123 (se risolve un issue)
```

Tipi di commit:
- `feat:` Nuova funzionalità
- `fix:` Correzione di bug
- `docs:` Documentazione
- `style:` Formattazione codice
- `refactor:` Refactoring
- `test:` Aggiungi/modifica test

### Esempio
```
feat: Aggiungi supporto per IIIF Presentation API v4

- Implementa nuovo parser per manifest v4
- Aggiorna validazione schema
- Aggiungi test di compatibilità
- Aggiorna documentazione

Fix #245
```

## ✅ Checklist Prima della Pull Request

- [ ] Codice segue le convenzioni del progetto
- [ ] Documentazione aggiornata
- [ ] README aggiornato se necessario
- [ ] CHANGELOG.md aggiornato
- [ ] Nessun errore di sintassi PHP
- [ ] Nessun file di debug lasciato
- [ ] Testato su più versioni di WordPress (se applicabile)

## 📝 Processo di Pull Request

### 1. Push del Branch
```bash
git push origin feature/descrizione-feature
```

### 2. Crea Pull Request
- Titolo chiaro e descrittivo
- Descrizione dettagliata delle modifiche
- Riferimento a issue correlati (#123)
- Spiegazione del "perché" non solo del "cosa"

### Template PR
```markdown
## Descrizione
[Breve descrizione delle modifiche]

## Tipo di Cambio
- [ ] Bugfix
- [ ] Nuova Funzionalità
- [ ] Breaking Change
- [ ] Documentazione

## Changelog
- Modifica 1
- Modifica 2

## Testing
Descritto il testing eseguito:
- [ ] Test locale completato
- [ ] Testato su WordPress X.X
- [ ] Testato su PHP X.X

## Checklist
- [ ] Codice segue le convenzioni
- [ ] Documentazione aggiornata
- [ ] Nessun file debug lasciato

Fix #[issue number]
```

### 3. Review Process
- Attendi feedback dai maintainer
- Rispondi ai commenti costruttivamente
- Apporta modifiche se richiesto
- Rebasa il branch se necessario

## 📚 Linee Guida per il Codice

### PHP
- PSR-12 Coding Standards
- Nomenclatura chiarezza: `$this->get_manifest_data()`
- Commenti per logica complessa
- Validazione input, sanitizzazione output
- Uso di WordPress hooks quando possibile

### Esempio PHP
```php
/**
 * Recupera i dati del manifest IIIF
 *
 * @param string $manifest_url URL del manifest IIIF
 * @return array|WP_Error Array di dati o errore
 */
public function get_manifest_data( $manifest_url ) {
    // Validazione input
    if ( empty( $manifest_url ) ) {
        return new WP_Error( 'empty_url', 'URL manifest non fornito' );
    }
    
    // Recupera dati
    $response = wp_remote_get( $manifest_url );
    
    if ( is_wp_error( $response ) ) {
        return $response;
    }
    
    // Processa dati
    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    
    return $data;
}
```

### JavaScript
- Nomi variabili descrittivi
- Usa `const` e `let` (mai `var`)
- Commenti per sezioni complesse
- Evita variabili globali

### Documentazione
- README chiaro e conciso
- Esempi di utilizzo
- Requisiti specifici
- Troubleshooting se necessario

## 🎯 Aree di Contributo

### Accettate
- Correzioni di bug
- Miglioramenti di performance
- Aggiornamenti documentazione
- Refactoring di codice
- Supporto per nuove versioni WordPress/PHP
- Test coverage

### Non Accettate Senza Discussione
- Breaking changes
- Nuove dipendenze
- Cambiamenti architettura
- Modifiche alle API pubbliche

Per questi, aprire un issue prima della pull request.

## 🤝 Processo di Merge

1. Almeno una approvazione dal team
2. Tutti i test passano
3. Nessun conflitto con main/master
4. Documentazione completa

## 📬 Contatti

Per domande o discussioni:
- CSAC: www.csacparma.it
- Visionaria: www.visionaria-archivio.it
- Università degli Studi di Parma: www.unipr.it

## ⚖️ Licenza

Contribuendo a questo progetto, accetti che i tuoi contributi siano licenziati sotto AGPLv3.

## 🙏 Ringraziamenti

Apprezziamo enormemente tutti i contributi, indipendentemente dalla loro dimensione!

---

Grazie per aver contribuito a Visionaria IIIF Plugin Collection!
