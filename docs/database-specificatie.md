# Database Specificatie Tabel

Bron: `database/migrations/Database_jamin.sql` (createscript Jamin Magazijnbeheer).
De tabellen worden aangemaakt en gevuld door de migration
`2026_09_25_133008_import_database_jamin.php`.

## Relaties

| Relatie | Type | Via koppeltabel |
| --- | --- | --- |
| `Magazijn` → `Product` | many-to-one (FK `ProductId`) | – |
| `ProductPerAllergeen` → `Product` | many-to-one (FK `ProductId`) | `ProductPerAllergeen` |
| `ProductPerAllergeen` → `Allergeen` | many-to-one (FK `AllergeenId`) | `ProductPerAllergeen` |
| `ProductPerLeverancier` → `Product` | many-to-one (FK `ProductId`) | `ProductPerLeverancier` |
| `ProductPerLeverancier` → `Leverancier` | many-to-one (FK `LeverancierId`) | `ProductPerLeverancier` |
| `Product` ↔ `Allergeen` | many-to-many | `ProductPerAllergeen` |
| `Product` ↔ `Leverancier` | many-to-many | `ProductPerLeverancier` |

## 1. Tabel `Product`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `Naam` | `VARCHAR(50)` | Nee | – | |
| `Barcode` | `VARCHAR(13)` | Nee | **Uniek** (`UQ_Product_Barcode`) | sorteersleutel overzicht |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 2. Tabel `Allergeen`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `Naam` | `VARCHAR(50)` | Nee | – | sorteersleutel allergenenoverzicht |
| `Omschrijving` | `VARCHAR(250)` | Nee | – | |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 3. Tabel `Leverancier`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `Naam` | `VARCHAR(50)` | Nee | – | |
| `ContactPersoon` | `VARCHAR(50)` | Nee | – | |
| `LeverancierNummer` | `VARCHAR(15)` | Nee | **Uniek** (`UQ_Leverancier_LeverancierNummer`) | |
| `Mobiel` | `VARCHAR(12)` | Nee | – | |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 4. Tabel `Magazijn`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `ProductId` | `TINYINT UNSIGNED` | Nee | **FK** → `Product(Id)` | `FK_Magazijn_ProductId_Product_Id` |
| `VerpakkingsEenheid` | `DECIMAL(5,2) UNSIGNED` | Nee | – | in kilogram |
| `AantalAanwezig` | `SMALLINT UNSIGNED` | **Ja** | – | `NULL` = geen voorraad (scenario 2 user story 1) |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 5. Tabel `ProductPerAllergeen`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `ProductId` | `TINYINT UNSIGNED` | Nee | **FK** → `Product(Id)` | `FK_ProductPerAllergeen_ProductId_Product_Id` |
| `AllergeenId` | `TINYINT UNSIGNED` | Nee | **FK** → `Allergeen(Id)` | `FK_ProductPerAllergeen_AllergeenId_Allergeen_Id` |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 6. Tabel `ProductPerLeverancier`

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `Id` | `TINYINT UNSIGNED` | Nee | **PK**, auto increment | |
| `LeverancierId` | `TINYINT UNSIGNED` | Nee | **FK** → `Leverancier(Id)` | `FK_ProductPerLeverancier_LeverancierId_Leverancier_Id` |
| `ProductId` | `TINYINT UNSIGNED` | Nee | **FK** → `Product(Id)` | `FK_ProductPerLeverancier_ProductId_Product_Id` |
| `DatumLevering` | `DATE` | Nee | – | sorteersleutel leveringsscherm |
| `Aantal` | `SMALLINT UNSIGNED` | Nee | – | |
| `DatumEerstVolgendeLevering` | `DATE` | **Ja** | – | standaard `NULL` |
| `IsActief` | `BIT` | Nee | – | standaard `1` |
| `Opmerkingen` | `VARCHAR(250)` | Ja | – | standaard `NULL` |
| `DatumAangemaakt` | `DATETIME(6)` | Nee | – | |
| `DatumGewijzigd` | `DATETIME(6)` | Nee | – | |

## 7. Tabel `users` (Laravel / Breeze)

| Kolom | Type | Null | PK/FK/Uniek | Opmerking |
| --- | --- | --- | --- | --- |
| `id` | `BIGINT UNSIGNED` | Nee | **PK**, auto increment | |
| `name` | `VARCHAR(255)` | Nee | – | |
| `email` | `VARCHAR(255)` | Nee | **Uniek** | |
| `password` | `VARCHAR(255)` | Nee | – | bcrypt |
| `rolename` | `VARCHAR(50)` | Nee | – | toegevoegd in `add_rolename_to_users_table`, standaard `Magazijnmedewerker` |
| `remember_token` | `VARCHAR(100)` | Ja | – | |
| `created_at` / `updated_at` | `TIMESTAMP` | Ja | – | Laravel-timestamps |

## Bewuste "lege" scenario-gevallen

| Geval | Waarom |
| --- | --- |
| `Magazijn.AantalAanwezig` is `NULL` voor product 10 (**Winegums**) | Scenario 2 user story 1: geen voorraad → exacte melding + redirect na 4 seconden |
| Geen rijen in `ProductPerAllergeen` voor product 5 (**Cola Flesjes**) | Scenario 2 user story 2: geen allergenen → exacte melding + redirect na 4 seconden |
