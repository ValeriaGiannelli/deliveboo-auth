# **Deliveboo**

Deliveboo è un'applicazione ispirata a Deliveroo, progettata per semplificare l'interazione tra ristoratori e clienti.  
- **Backend (Laravel):** Fornisce un gestionale per i ristoratori, inclusa la gestione del menu e il monitoraggio delle performance.  
- **Frontend (Vue.js):** Consente ai clienti di sfogliare i ristoranti, aggiungere piatti al carrello e completare gli acquisti tramite Braintree.

---

## Sommario
1. [Caratteristiche](#caratteristiche)
2. [Requisiti](#requisiti)
3. [Struttura del Progetto](#struttura-del-progetto)
4. [Installazione](#installazione)
   - [Backend (Laravel)](#backend-laravel)
   - [Frontend (Vue.js)](#frontend-vuejs)
5. [Utilizzo](#utilizzo)
6. [Tecnologie Usate](#tecnologie-usate)

---


## Caratteristiche

- **Backend (Laravel):**
  - Gestione dei ristoranti e del menu.
  - Monitoraggio delle entrate tramite statistiche (Chart.js).

- **Frontend (Vue.js):**
  - Visualizzazione dei ristoranti e dei piatti disponibili.
  - Carrello interattivo con salvataggio in `localStorage`.
  - Integrazione con Braintree per pagamenti sicuri.
  - Integrazione con Mailtrap per notifiche email.

---

## Requisiti

### Requisiti Generali
- **PHP:** >= 8.1  
- **Composer:** >= 2.x  
- **Node.js:** >= 16.x  
- **NPM/Yarn:** >= 6.x  
- **Database:** MySQL o SQLite  
- **Chiavi API:**  
  - **Braintree** (pagamenti)  
  - **Mailtrap** (email testing)

### Dipendenze Specifiche

#### **Backend (Laravel)**

- **Framework Laravel:** ^10.0
- **Braintree SDK:** 6.20.0
- **Guzzle HTTP:** ^7.9
- **Sanctum:** ^3.2
- **Tinker:** ^2.8

#### **Frontend (Vue.js)**

- **Vue:** ^3.5.10
- **Vue Router:** ^4.4.5
- **Braintree Drop-In:** ^1.43.0
- **Axios:** ^1.7.7

---

## Struttura del Progetto

Il progetto è organizzato in due repository separati:  

1. **Backend (Laravel):**
   ```plaintext
   /app
     ├── Models            # Modelli Eloquent
     ├── Http/Controllers  # Logica delle API
   /resources/views         # Template Blade
   /database                # Migrazioni e Seeder

2. **Frontend(Vue.js):**
   ```plaintext
    /src
      ├── components    # Componenti Vue
      ├── views         # Pagine principali
      ├── router        # Configurazione delle rotte

---

## Installazione

### Backend (Laravel)

1. Clona il repository:
   ```bash
   git clone https://github.com/ValeriaGiannelli/deliveboo-auth
   cd deliveboo-auth

2. Installa le dipendenze con Composer:
   ```bash
   composer install
3. Configura il file .env:
   cp .env.example .env

   Configura le seguenti variabili:
   - Database: MySQL
   - Braintree: Crea un account e importa le tue credenziali API per i pagamenti e inseriscile nel file env:
      ```bash
      BRAINTREE_ENVIRONMENT=sandbox
      BRAINTREE_MERCHANT_ID=il_tuo_merchant_id
      BRAINTREE_PUBLIC_KEY=la_tua_public_key
      BRAINTREE_PRIVATE_KEY=la_tua_private_key
   
   - Mailtrap: Crea un account su Mailtrap e prendi le credenziali SMTP dalla tua inbox di Mailtrap. Aggiungi queste configurazioni nel file .env:
      ```bash
      MAIL_MAILER=smtp
      MAIL_HOST=smtp.mailtrap.io
      MAIL_PORT=2525
      MAIL_USERNAME=il_tuo_username
      MAIL_PASSWORD=la_tua_password
      MAIL_ENCRYPTION=null
      MAIL_FROM_ADDRESS=info@deliveboo.com
      MAIL_FROM_NAME="Deliveboo"
5. Genera a chiave dell’applicazione e prepara il database:
   php artisan key:generate 
   php artisan migrate –seed
6. Avvia il server di sviluppo:
   php artisan serve

### Frontend (Vue.js)

1. Clona il repository:
   ```bash
   git clone https://github.com/ValeriaGiannelli/deliveboo-front
   cd deliveboo-front

2. Installa le dipendenze con NPM:
   ```bash
   npm install
3. Avvia il server di sviluppo:
   npm run dev	

---

## Utilizzo

### Backend (Laravel)
-	Accedi all'area amministrativa per gestire ristoranti, piatti e statistiche.

### Frontend (Vue.js)
-	Usa l'interfaccia cliente per esplorare i ristoranti, aggiungere piatti al carrello e completare gli acquisti con Braintree.
-	Visualizza le email inviate tramite Mailtrap.

## Tecnologie usate

### Backend (Laravel)
-	Laravel 10.x
-	Braintree SDK
-	Guzzle
-	Sanctum
-	Chart.js
-	Mailtrap
### Frontend (Vue.js)
-	Vue 3.x
-	Vue Router
-	Axios
-	Braintree Drop-In
-	Sass

