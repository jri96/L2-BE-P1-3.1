# Jamin Magazijnbeheer

BE-opdracht 1 — Magazijnbeheer voor Jamin, gebouwd met Laravel, Breeze (Blade) en MySQL.

## Schermen

| Route | Naam | Omschrijving |
| --- | --- | --- |
| `GET /magazijn` | `magazijn.index` | Overzicht Magazijn Jamin, gesorteerd op **Barcode oplopend** |
| `GET /magazijn/product/{product}/levering` | `magazijn.levering` | Levering Informatie, gesorteerd op **Datum laatste levering oplopend** |
| `GET /magazijn/product/{product}/allergenen` | `magazijn.allergenen` | Overzicht Allergenen, gesorteerd op **Naam oplopend** |

Alle routes staan achter de `auth` middleware.

## User stories

**US1 — Leveringsinformatie product**

1. *Scenario 1:* klik op het vraagteken-icoon → leveranciersgegevens boven de tabel en
   alle leverdata eronder.
2. *Scenario 2:* product zonder voorraad (Winegums) → exacte melding
   `Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-04-2023`
   en na 4 seconden automatisch terug naar **Overzicht Magazijn Jamin**.

**US2 — Allergeneninformatie product**

1. *Scenario 1:* klik op het rode-kruis-icoon → Naam Product en Barcode boven de tabel,
   alle allergenen eronder.
2. *Scenario 2:* product zonder allergenen (Cola Flesjes) → exacte melding
   `In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken`
   en na 4 seconden automatisch terug naar **Overzicht Magazijn Jamin**.

## Rollen en rechten

Het systeem kent twee rollen (`users.rolename`):

| Recht | Magazijnmedewerker | Administrator |
| --- | --- | --- |
| Overzicht Magazijn Jamin bekijken | ✅ | ✅ |
| Levering Informatie bekijken | ✅ | ✅ |
| Overzicht Allergenen bekijken | ✅ | ✅ |
| Voorraad bijwerken (`/magazijn/voorraad`) | ❌ 403 | ✅ |
| Rollen van gebruikers wijzigen (`/gebruikers`) | ❌ 403 | ✅ |

Beide rollen kunnen dus gewoon inloggen en het magazijn gebruiken; alleen de
Administrator mag schrijven. De rechten zitten in Gates
(`magazijn.voorraad-bijwerken` en `gebruiker.beheren`, zie `AppServiceProvider`)
en worden via de `can`-middleware op de routes afgedwongen — niet alleen in de UI.

Inlogaccounts (wachtwoord overal `password`):

| E-mail | Rol |
| --- | --- |
| `magazijn@jamin.nl` | Magazijnmedewerker |
| `admin@jamin.nl` | Administrator |
| `test@example.com` | Magazijnmedewerker |

## Installatie

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate        # voert Database_jamin.sql uit via de import-migration
php artisan db:seed        # maakt magazijn@jamin.nl / password aan
php artisan serve --port=8080
```

Vereist MySQL (getest met MySQL 9.1 op WAMP). Pas `DB_*` in `.env` aan naar jouw instellingen.

De createscript-data staat in `database/migrations/Database_jamin.sql` en wordt door de
migration `2026_09_25_133008_import_database_jamin.php` geïmporteerd.

## Tests

```bash
php artisan test
```

De tests draaien tegen een aparte MySQL-database (`jamin_magazijn_test`, zie `phpunit.xml`).

## Repository-structuur

- `app/Models/` — Eloquent-modellen met relaties (`Product`, `Magazijn`, `Allergeen`, `Leverancier`, `ProductPerAllergeen`, `ProductPerLeverancier`)
- `app/Http/Controllers/` — controllers per scherm
- `resources/views/magazijn/` — de drie Blade-weergaven
- `docs/database-specificatie.md` — Database Specificatie Tabel
- `db/jamin_magazijn.sql` — SQL-export van de database
- `vids/` — hier komen de opnames van de user stories

## Git

Takken: `feature_leveringsinformatie_product` en `feature_allergeneninformatie_product`,
beide samengevoegd in `main`.

## Laravel

Standaard Laravel-informatie: <https://laravel.com/docs>.
