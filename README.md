# 🏋️‍♂️ FitnessFusion

Aplicação web full-stack para gestão de academias (planos de assinatura, matrículas, alunos, equipe e acompanhamento físico), reescrita do zero em **Laravel** com foco em arquitetura limpa, integridade de dados e segurança de aplicações.

> **Status do projeto:** 🚧 Em desenvolvimento — **Fase 1 de 10 em andamento** (modelagem relacional e migrations concluídas; restam Enums, factories, seeders e aplicação no Supabase).

---

## 🛠️ Stack Tecnológica

* **Backend:** PHP 8.3 + Laravel 13
* **Banco de Dados:** PostgreSQL 17
* **Frontend:** Blade Templates + JavaScript (com exposição de endpoints JSON)
* **Infraestrutura Local:** Docker & Docker Compose

---

## 🔒 Segurança e Engenharia de Dados

Este projeto nasce da refatoração completa de um sistema legado em PHP procedural, atacando vulnerabilidades críticas (autenticação quebrada, ausência de controle de acesso, SQL Injection e senhas em texto puro) com controles em camadas:

* **Armazenamento de Credenciais (✅ Implementado):** Senhas armazenadas com hash criptográfico (Bcrypt), ocultação automática na serialização do Model (`$hidden`) e índice único case-insensitive (`lower(email)`) no PostgreSQL.
* **Integridade no Motor do Banco (✅ Implementado):** Defesa em profundidade com `CHECK` constraints (valores monetários não negativos, validação de CPF numérico e períodos contratuais), chaves estrangeiras com `ON DELETE RESTRICT` e índice único parcial garantindo no máximo uma inscrição `ativa` por cliente.
* **Blindagem do Banco em Produção / Supabase (✅ Implementado):** Data API desativada + Row Level Security (RLS) ativo: duas camadas independentes impedindo exposição direta das tabelas na internet.
* **Gestão de Segredos (🟡 Em andamento):** Credenciais isoladas via `.env` fora do versionamento (`✅`); rotação/desativação formal das credenciais antigas do servidor legado em verificação (`🔜`).
* **Autenticação e Autorização Granular (🔜 Fase 2):** Fluxo de login com proteção de sessão e controle de acesso baseado em papéis (RBAC) via Middlewares e Laravel Policies para isolar rotas administrativas, financeiras e dados pessoais (LGPD).

---

## 🚀 Como Rodar Localmente

### Pré-requisitos
* Docker e Docker Compose instalados
* PHP 8.3+ e Composer instalados localmente

### Passo a passo

1. **Clone o repositório:**
   ```bash
   git clone git clone https://github.com/Gustalluis/FitnessFusion.git
   cd FitnessFusion
   ```

2. **Configure as variáveis de ambiente:**
   ```bash
   cp .env.example .env
   ```
   Abra o arquivo `.env` e defina uma senha local em `DB_PASSWORD=` (ex: `DB_PASSWORD=secret`), caso contrário o container do PostgreSQL recusará a inicialização.

3. **Suba o container do PostgreSQL:**
   ```bash
   docker compose up -d
   ```

4. **Instale as dependências e gere a chave da aplicação:**
   ```bash
   composer install
   php artisan key:generate
   ```

5. **Execute as migrations e popule o banco inicial:**
   ```bash
   php artisan migrate --seed
   ```

6. **Inicie o servidor de desenvolvimento:**
   ```bash
   php artisan serve
   ```

---

## 📄 Documentação

* [Requisitos Funcionais e Não Funcionais](docs/requisitos.md)
* [Modelo de Dados, Diagrama ER e Mapa LGPD](docs/modelo-dados.md)

---