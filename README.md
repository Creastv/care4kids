# Care4Kids WordPress Theme

Custom starter theme built for Care4Kids. Projekt zawiera strukturę plików WordPressa, modularne części szablonu oraz pipeline SCSS z Gulpem i BrowserSync.

## Wymagania

- Node.js 18+ (zalecany LTS)
- npm 8+ lub kompatybilny menedżer pakietów
- Środowisko WordPress (np. lokalny XAMPP) z motywem osadzonym w `wp-content/themes/care4kids`

## Instalacja

1. Przejdź do katalogu motywu:
   ```bash
   cd /Applications/XAMPP/xamppfiles/htdocs/care4kids/wp-content/themes/care4kids
   ```
2. Zainstaluj zależności Node:
   ```bash
   npm install
   ```

## Skrypty npm

- `npm run watch` – uruchamia Gulp, kompiluje SCSS → CSS, odpala BrowserSync (proxy: `http://localhost/care4kids`) i odświeża przeglądarkę po każdej zmianie w SCSS/JS/PHP.
- `npm run build` – jednorazowa kompilacja w trybie produkcyjnym (minifikacja CSS, bez sourcemap).
- `npm run scss` – ręczne wywołanie taska kompilującego style (bez BrowserSync).

> **Uwaga:** upewnij się, że adres proxy w `gulpfile.js` odpowiada Twojej lokalnej domenie WordPressa. W razie potrzeby zmień `http://localhost/care4kids`.

## Struktura katalogów

```
assets/
├── css/
│   ├── main.scss      # główny plik importujący partiale SCSS
│   └── main.css       # wynik kompilacji (wraz z mapą sourcemap)
├── scss/
│   ├── _variable.scss
│   ├── _global.scss
│   ├── _typo.scss
│   ├── _header.scss
│   ├── _footer.scss
│   ├── _buttons.scss
│   └── _form.scss
└── js/
```

```
templates-parts/
├── header/
│   ├── h-brand.php
│   ├── h-nav.php
│   └── h-buttons.php
└── content/
└── footer/
```

## Funkcje motywu

- `functions.php` rejestruje wsparcie dla `custom-logo`, `title-tag`, menu `primary` oraz ładuje `assets/css/main.css`, gdy istnieje.
- `functions/wp-customization.php` dodaje sekcję w Customizerze do edycji: 
  - logo nagłówka,
  - etykiet i linków dwóch przycisków CTA.
- Główne pliki szablonu (`index.php`, `page.php`, `single.php`, `404.php`) korzystają z modułowych części nagłówka.

## Workflow developerski

1. `npm run watch` – uruchom przed pracą nad front-endem.
2. Edytuj partiale w `assets/scss/` lub pliki PHP.
3. BrowserSync automatycznie odświeży stronę po zapisie.
4. Przed wdrożeniem uruchom `npm run build`, aby wygenerować zminifikowany CSS.

## Publikowanie na GitHubie

1. Utwórz repo (`git init` już wykonano).
2. Dodaj origin:
   ```bash
   git remote add origin git@github.com:twoj-user/care4kids.git
   git branch -M main
   git push -u origin main
   ```
3. Po zmianach używaj standardowego workflow:
   ```bash
   git add .
   git commit -m "Opis zmiany"
   git push
   ```

## Licencja

Projekt dziedziczy licencję WordPressa (GPL v2 lub nowszą). Dostosuj nagłówki w `style.css` i README zgodnie z wymaganiami projektu.
