# 🍔 Lancheria

> Sistema web de gestão de pedidos para lanchonetes, desenvolvido com Laravel seguindo o padrão arquitetural MVC.

---

## 📖 Descrição

O **Lancheria** é uma aplicação web completa para gerenciamento de uma lanchonete, permitindo o cadastro de produtos com imagens, organização por categorias, realização de pedidos com múltiplos itens e diferentes métodos de pagamento. A interface foi desenvolvida com inspiração em aplicativos de delivery modernos como o iFood.

Projeto desenvolvido como trabalho acadêmico da disciplina de **Tópicos Especiais em Desenvolvimento Web**.

---

## 🏗️ Arquitetura MVC

O projeto segue rigorosamente o padrão **Model-View-Controller**:

### Model
Camada responsável pela representação dos dados e comunicação com o banco de dados via **Eloquent ORM**.

| Classe | Tabela | Responsabilidade |
|--------|--------|-----------------|
| `User` | `users` | Autenticação e dados do usuário |
| `Produto` | `produtos` | Itens do cardápio com imagem e categoria |
| `Categoria` | `categorias` | Agrupamento dos produtos |
| `Pedido` | `pedidos` | Registro de pedidos com pagamento |
| `ItensPedido` | `itens_pedido` | Relação entre pedidos e produtos |

### Controller
Camada responsável por receber as requisições HTTP, aplicar as regras de negócio e retornar a resposta adequada.

| Classe | Responsabilidade |
|--------|-----------------|
| `HomeController` | Exibe a tela inicial com destaques |
| `ProdutoController` | CRUD completo com upload de imagem |
| `CategoriaController` | CRUD de categorias |
| `PedidoController` | Criação e gestão de pedidos |

### View
Camada responsável pela interface do usuário, utilizando **Blade Templates** e **Bootstrap 5**.

| Arquivo | Descrição |
|---------|-----------|
| `home.blade.php` | Página inicial com banner e destaques |
| `produtos/index.blade.php` | Cardápio com filtro por categoria |
| `produtos/create.blade.php` | Formulário de cadastro com upload |
| `produtos/edit.blade.php` | Formulário de edição |
| `pedidos/create.blade.php` | Tela de pedido com resumo e pagamento |
| `pedidos/index.blade.php` | Listagem de pedidos em cards |
| `categorias/index.blade.php` | Cards de categorias clicáveis |

---

## ✨ Funcionalidades

- 🔐 Autenticação de usuários (login e cadastro)
- 🍔 CRUD completo de produtos com upload de imagem
- 🗂️ CRUD de categorias com ícones automáticos por tipo
- 🔍 Filtro de produtos por categoria
- 🏠 Tela inicial estilo delivery com banner e destaques
- 🛒 Criação de pedidos com múltiplos produtos
- 💳 Métodos de pagamento: Dinheiro, Cartão e Pix
- 🔢 Parcelamento em até 12x no cartão
- 💵 Cálculo de troco para pagamento em dinheiro
- 📋 Visualização de pedidos com fotos e itens detalhados

---

## 🛠️ Tecnologias

| Tecnologia | Versão | Uso |
|-----------|--------|-----|
| PHP | 8.3 | Linguagem principal |
| Laravel | 13 | Framework web |
| MySQL | 8.4 | Banco de dados |
| Bootstrap | 5.3 | Interface responsiva |
| Blade | — | Template engine |
| Eloquent ORM | — | Mapeamento objeto-relacional |
| Git | — | Controle de versão |

---

## 🗄️ Diagrama do Banco de Dados

┌─────────┐       ┌────────────┐       ┌──────────────┐

│  users  │       │  produtos  │       │  categorias  │

├─────────┤       ├────────────┤       ├──────────────┤

│ id      │       │ id         │──────▶│ id           │

│ name    │       │ nome       │       │ nome         │

│ email   │       │ descricao  │       └──────────────┘

│ password│       │ preco      │

└────┬────┘       │ estoque    │

│            │ categoria_id│

│            │ imagem     │

│            └─────┬──────┘

│                  │

┌────▼────┐       ┌─────▼──────┐

│ pedidos │       │itens_pedido│

├─────────┤       ├────────────┤

│ id      │──────▶│ id         │

│ user_id │       │ pedido_id  │

│ status  │       │ produto_id │

│ pagamento│      │ quantidade │

│ troco   │       │ preco_unit │

│ total   │       └────────────┘

└─────────┘

---

## ⚙️ Instalação e Execução

### Pré-requisitos

- PHP 8.3+
- Composer
- MySQL 8+
- Node.js e npm

### Passo a passo

```bash
# Clonar o repositório
git clone https://github.com/GomesszA/Trabalho-Alexandre-Leo.git
cd Trabalho-Alexandre-Leo

# Instalar dependências PHP
composer install --ignore-platform-reqs

# Copiar o arquivo de ambiente
cp .env.example .env

# Gerar a chave da aplicação
php artisan key:generate

# Configurar o banco de dados no .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lancheria
DB_USERNAME=root
DB_PASSWORD=

# Executar as migrations
php artisan migrate

# Criar link simbólico para imagens
php artisan storage:link

# Iniciar o servidor de desenvolvimento
php artisan serve
```

Acesse **http://localhost:8000** no navegador.

---

## 👥 Desenvolvedores

| Nome | GitHub |
|------|--------|
| Alexandre | [@GomesszA](https://github.com/GomesszA) |
| Leonardo | — |

---

## 📄 Licença

Projeto desenvolvido para fins acadêmicos.