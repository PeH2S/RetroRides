#  RetroRides - Projeto Laravel para Cadastro e Consulta de Veículos

Este é um projeto Laravel 12 desenvolvido com o objetivo de criar uma plataforma para anúncios e consultas de veículos, integrando com a API FIPE v2 para dados automotivos e contando com um sistema estruturado de criação de anúncios para carros e motos.

---

## ✅ Requisitos do Projeto

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js + NPM
- Redis (opcional para cache)
- Laravel CLI (opcional)
- Navegador moderno

---

## 🔧 Instalação

1. **Clone o projeto**

```bash
git clone <URL_DO_REPOSITORIO>
cd RetroRides
```

2. **Instale as dependências do PHP**

```bash
composer install
```


3. **Configure o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` com suas configurações de banco e token da API FIPE:

```env
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

FIPE_API_TOKEN="seu_token_aqui"
```

4. **Execute as migrações**

```bash
php artisan migrate
```


5. **Inicie o servidor local**

```bash
php artisan serve
```

---

## 🗂️ Estrutura do Projeto

### Backend

- `app/Http/Controllers`
  - `AnuncioController.php` – Controle de anúncios
  - `CarDataController.php` – Comunicação com API FIPE
- `app/Models`
  - `Anuncio.php`, `AnuncioFoto.php`, `User.php`
- `app/Services`
  - `CarApiService.php` – Serviço responsável pelas chamadas à API externa
- `routes/`
  - `web.php`, `api.php` – Rotas da aplicação

### Banco de Dados

- `database/migrations/` – Estrutura das tabelas: `users`, `anuncios`, `anuncio_fotos`, `cache`, `jobs`
- `database/seeders/` – Seeders para popular o banco (em desenvolvimento)

### Frontend

- `resources/views`
  - `pages/anuncios/cars_create/` – Telas de cadastro multi-etapas de carros (`step2`, `step3`, etc)
  - `pages/anuncios/moto/` – Telas de cadastro de motos
  - `static/` – Layouts, banner, footer
- `public/css/` – Estilos separados por página
- `public/js/` – Scripts JS dos formulários

---

## 🧪 Scripts Úteis

Você pode rodar o servidor com múltiplos serviços usando o script do `composer.json`:

```bash
composer run dev
```

Este comando executa simultaneamente:
- `php artisan serve`
- `php artisan queue:listen`
- `php artisan pail` (log viewer)


---

## 🚀 Funcionalidades

- Cadastro passo-a-passo de anúncios de carros e motos
- Upload de fotos de anúncios
- Consulta de dados FIPE por marca, modelo, ano
- Integração via serviço interno com API externa
- Separação de layouts reutilizáveis (Blade)
- Cache e fila de jobs configurados com banco

---

## 🔐 Autenticação API FIPE

O token da API FIPE deve ser adicionado no `.env`:

```env
FIPE_API_TOKEN=seu_token
```

A autenticação é gerenciada no `CarApiService.php`.

---

## 📄 Licença

Projeto open-source para fins educacionais. Desenvolvido por Vinicius Thales.

---

## 📝 Autor

Vinicius Thales  
Email: viniciusthales486@gmail.com  
Framework: Laravel 12  
