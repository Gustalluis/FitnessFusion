# 🏋️‍♂️ FitnessFusion

Aplicação web full-stack para gestão de academias (planos de assinatura, matrículas, alunos, equipe e acompanhamento físico), reescrita do zero em **Laravel** com foco em arquitetura limpa, integridade de dados e segurança de aplicações.

> **Status do projeto:** 🚧 Em desenvolvimento — **Fase 1 de 10 em andamento** (modelagem relacional, migrations e Enums de domínio concluídos; restam ajuste dos models, factories, seeders e aplicação no Supabase).

> ⚠️ **Aviso:** as rotas JSON atuais (`/clientes`, `/funcionarios`, `/planos`, `/inscricoes`) são endpoints provisórios de desenvolvimento, **sem autenticação**. Elas serão protegidas por login, Policies e API Resources na Fase 2 e não devem ser expostas em produção até lá.

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
* **Gestão de Segredos (✅ Implementado):** Credenciais isoladas via `.env` fora do versionamento; as credenciais expostas no código legado foram revogadas e os acessos antigos desativados.
* **Proteção contra Mass Assignment (✅ Implementado):** Colunas que definem permissão (`role`, `ativo`) ficam fora do `$fillable` do Model `User`, impedindo escalada de privilégio por campos injetados em formulários.
* **Tipagem do Domínio com Enums (✅ Implementado):** Enums do PHP (`Role`, `StatusInscricao`) espelham os `CHECK` do banco e são aplicados via cast no Eloquent: valores inválidos falham na aplicação e no banco, nunca em silêncio.
* **Autenticação e Autorização Granular (🔜 Fase 2):** Fluxo de login com proteção de sessão e controle de acesso baseado em papéis (RBAC) via Middlewares e Laravel Policies para isolar rotas administrativas, financeiras e dados pessoais (LGPD).

---

## 🚀 Como Rodar Localmente

### Pré-requisitos
* Docker e Docker Compose instalados
* PHP 8.3+ e Composer instalados localmente

### Passo a passo

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/Gustalluis/FitnessFusion.git
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
