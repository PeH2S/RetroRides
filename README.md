# 🚗 RetroRides – Plataforma de Anúncios de Veículos

Sistema Laravel 12 para criação e consulta de anúncios de carros e motos, com integração à API FIPE v2 para dados automotivos e suporte a upload de fotos, cache e filas.

---

## ✅ Requisitos

- PHP 8.2+
- Composer
- MySQL ou MariaDB
- Node.js + NPM
- Redis (opcional)
- Laravel CLI (opcional)

---

## ⚙️ Instalação

```bash
git clone <URL_DO_REPOSITORIO>
cd RetroRides

composer install
cp .env.example .env
php artisan key:generate
```

Configure o `.env` com:

```env
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

FIPE_API_TOKEN=seu_token
GOOGLE_CLIENT_ID=seu_id
GOOGLE_CLIENT_SECRET=seu_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/login/google/callback
```

```bash
php artisan migrate
php artisan serve
```

---

## 🗂️ Estrutura

- **Controllers:** Anúncios, API FIPE, autenticação  
- **Models:** Anuncio, User, Fotos, etc.  
- **Services:** API FIPE (CarApiService)  
- **Views:** Blade com layouts modulares, cadastros multi-etapas (carros/motos)  
- **Migrations:** Estrutura de usuários, anúncios, fotos, jobs, cache  
- **Public:** CSS e JS por página  

---

## 🚀 Funcionalidades

- Cadastro multi-etapas de carros e motos  
- Integração completa com API FIPE v2  
- Upload de imagens com preview  
- Sistema de favoritos, busca e filtros  
- Cache de requisições e filas com suporte Redis  
- Login com Google via OAuth  
- Notificações em tempo real com Pusher  

---

## 🔧 Scripts Úteis

```bash
composer run dev
```

Executa simultaneamente:
- `php artisan serve`  
- `php artisan queue:listen`  
- `php artisan pail` (visualizador de logs)  

---

## 🔐 Integração com API FIPE e Google

Certifique-se de preencher no `.env`:

```env
FIPE_API_TOKEN=...
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
GOOGLE_REDIRECT_URI=http://localhost:8000/login/google/callback
```

---

## 🌐 Configuração SSL (Windows)

Baixe o arquivo: [cacert.pem](https://curl.se/ca/cacert.pem)  
Salve, por exemplo, em:

```
C:\php\extras\ssl\cacert.pem
```

E no seu `php.ini`, ajuste:

```ini
curl.cainfo = "C:\php\extras\ssl\cacert.pem"
openssl.cafile = "C:\php\extras\ssl\cacert.pem"
```

Reinicie o servidor.

---

## 📡 WebSockets com Pusher

No `.env`:

```env
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=2006092
PUSHER_APP_KEY=c315c4e2f577feb87dce
PUSHER_APP_SECRET=a58893f2e2d350df0f8c
PUSHER_APP_CLUSTER=sa1
```

---

## 📄 Licença

Projeto open-source com fins educacionais.  
Desenvolvido por **Vinicius Thales** – [viniciusthales486@gmail.com](mailto:viniciusthales486@gmail.com)
