# Инструкция по развертыванию на сервере

## Домен: pari-24kz.live

---

## 1. Установка Docker на Ubuntu/Debian

```bash
# Обновление системы
sudo apt update && sudo apt upgrade -y

# Установка зависимостей
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common

# Добавление GPG ключа Docker
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Добавление репозитория Docker
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Установка Docker
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io

# Установка Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Добавление пользователя в группу docker (чтобы не использовать sudo)
sudo usermod -aG docker $USER

# Перезайти в систему или выполнить:
newgrp docker

# Проверка установки
docker --version
docker-compose --version
```

---

## 2. Настройка сервера

```bash
# Создание директории проекта
sudo mkdir -p /var/www/pari-24kz.live
cd /var/www/pari-24kz.live

# Загрузка проекта (через git или scp)
# Вариант 1 - Git:
git clone YOUR_REPOSITORY_URL .

# Вариант 2 - SCP (с локальной машины):
# scp -r /path/to/parimob/* user@server:/var/www/pari-24kz.live/
```

---

## 3. Настройка SSL сертификата (Let's Encrypt)

```bash
# Установка Certbot
sudo apt install -y certbot

# Остановка nginx если запущен
sudo systemctl stop nginx 2>/dev/null || true

# Получение сертификата
sudo certbot certonly --standalone -d pari-24kz.live -d www.pari-24kz.live

# Копирование сертификатов в папку проекта
sudo cp /etc/letsencrypt/live/pari-24kz.live/fullchain.pem /var/www/pari-24kz.live/docker/nginx/ssl/
sudo cp /etc/letsencrypt/live/pari-24kz.live/privkey.pem /var/www/pari-24kz.live/docker/nginx/ssl/
sudo chmod 644 /var/www/pari-24kz.live/docker/nginx/ssl/*.pem
```

---

## 4. Настройка окружения

```bash
cd /var/www/pari-24kz.live

# Копирование production конфига
cp .env.production .env

# Редактирование .env - ВАЖНО изменить:
nano .env
# - DB_PASSWORD (установить надежный пароль)
# - Другие настройки при необходимости
```

---

## 5. Запуск проекта

```bash
cd /var/www/pari-24kz.live

# Сборка и запуск контейнеров
docker-compose up -d --build

# Проверка статуса
docker-compose ps

# Генерация ключа приложения
docker-compose exec app php artisan key:generate

# Запуск миграций
docker-compose exec app php artisan migrate --force

# Создание символической ссылки для storage
docker-compose exec app php artisan storage:link

# Очистка кеша
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## 6. Полезные команды

```bash
# Просмотр логов
docker-compose logs -f

# Логи конкретного сервиса
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f db

# Перезапуск
docker-compose restart

# Остановка
docker-compose down

# Остановка с удалением volumes (ОСТОРОЖНО - удалит базу данных!)
docker-compose down -v

# Вход в контейнер приложения
docker-compose exec app bash

# Вход в контейнер базы данных
docker-compose exec db mysql -u root -p
```

---

## 7. Автообновление SSL сертификата

```bash
# Создание скрипта обновления
sudo nano /etc/cron.d/certbot-renew

# Добавить строку:
0 0 1 * * root certbot renew --quiet && cp /etc/letsencrypt/live/pari-24kz.live/*.pem /var/www/pari-24kz.live/docker/nginx/ssl/ && cd /var/www/pari-24kz.live && docker-compose restart nginx
```

---

## 8. Настройка DNS

В панели управления доменом pari-24kz.live добавить A-записи:

| Тип | Имя | Значение |
|-----|-----|----------|
| A | @ | IP_СЕРВЕРА |
| A | www | IP_СЕРВЕРА |

---

## 9. Firewall (UFW)

```bash
# Разрешить необходимые порты
sudo ufw allow 22/tcp   # SSH
sudo ufw allow 80/tcp   # HTTP
sudo ufw allow 443/tcp  # HTTPS

# Включить firewall
sudo ufw enable
```

---

## Troubleshooting

**Ошибка подключения к БД:**
```bash
docker-compose logs db
docker-compose exec app php artisan config:clear
```

**Ошибка прав доступа:**
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

**502 Bad Gateway:**
```bash
docker-compose restart app
docker-compose logs nginx
```
