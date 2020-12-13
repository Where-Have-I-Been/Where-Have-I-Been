# Where Have I Been

*TODO: opis*

### Autorzy:

*   Adrian Hopek *(Lider/PM/DevOps/Tester)*
*   Justyn Chroł *(Backend)*
*   Patryk Zym *(Frontend)*
*   Agnieszka Rudek *(Frontend)*

### Funkcjonalności:

*TODO: funkcjonalności*

### Technologie:

*   PHP
*   Laravel
*   MySQL
*   Vue.js

### Uruchomienie aplikacji w środowisku deweloperskim

**1. Pobranie projektu z repozytorium**

```
git clone https://github.com/Where-Have-I-Been/Where-Have-I-Been.git
```
```
cd where-have-i-been
```

**2. Konfiguracja pliku .env**

```
cp .env.example .env
```

**3. Uruchomienie kontenerów dockerowych**

```
docker-compose up -d --build
```

**4. Pobranie zależności**

```
docker-compose exec php composer install
```

**5. Wygenerowanie klucza**

```
docker-compose exec php php artisan key:generate
```

**6. Migracja tabel w bazie danych i seed początkowych danych**

```
docker-compose exec php php artisan migrate --seed
```

**7. Aplikacja powinna być dostępna na:**

```
http://localhost
```

### Przydatne komendy

**Docker - uruchomienie kontenerów**
```
docker-compose up -d
```

**Docker - zatrzymanie kontenerów**
```
docker-compose stop
```

**Docker - zatrzymanie i usunięcie kontenerów**
```
docker-compose down
```

**Artisan - migracje**

```
docker-compose exec php php artisan migrate
```

**Artisan - migracje i seed**

```
docker-compose exec php php artisan migrate --seed
```

**Artisan - "reset" bazy i migracje**

```
docker-compose exec php php artisan migrate:refresh
```

**Artisan - wyczyszczenie cache**

```
docker-compose exec php php artisan cache:clear
```

**Artisan - ogólne**

```
docker-compose exec php php artisan *
```

gdzie * to dowolna inna komenda

**Zbiorcze sprawdzenie kodu (Psalm i ECS)**

```
docker-compose exec php composer check
```

**ECS**

```
docker-compose exec php composer ecs
```

```
docker-compose exec php ./vendor/bin/ecs check
```

```
docker-compose exec php ./vendor/bin/ecs check --fix
```

**Psalm**

```
docker-compose exec php composer psalm
```

```
docker-compose exec php ./vendor/bin/psalm --no-cache
```

```
docker-compose exec php ./vendor/bin/psalm --show-info=true
```


