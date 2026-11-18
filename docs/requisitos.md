# Requisitos — FitnessFusion

Este documento lista os requisitos funcionais e não funcionais planejados para a nova versão do **FitnessFusion**, organizados por domínio.

> **Fora de escopo (Descontinuado):** Os módulos de **Blog** e **Postagens** presentes no sistema legado em PHP procedural foram intencionalmente descontinuados nesta versão para priorizar a segurança, o controle de acesso e a gestão operacional da academia.

---

## Requisitos Funcionais

### 1. Gestão de Alunos (Clientes)
* Funcionário cadastra aluno.
* Funcionário edita dados do aluno.
* Funcionário lista alunos cadastrados.
* Aluno visualiza seus próprios dados cadastrais.
* Aluno atualiza seus dados pessoais permitidos.

### 2. Gestão de Planos e Inscrições
* Funcionário cadastra plano de assinatura.
* Funcionário edita plano de assinatura.
* Aluno visualiza planos disponíveis.
* Funcionário realiza inscrição de um aluno em um plano.
* Aluno visualiza sua inscrição ativa e histórico de matrículas.
* Funcionário atualiza o status da inscrição (`ativa`, `vencida`, `cancelada`).

### 3. Gestão de Funcionários
* Administrador cadastra funcionário.
* Administrador e funcionário editam dados cadastrais permitidos.
* Administrador lista funcionários e remunerações.

### 4. Treinos e Agendamentos
* Funcionário cadastra fichas de treino.
* Funcionário agenda treino para o aluno.
* Aluno visualiza seus treinos agendados.
* Aluno consulta detalhes do treino.

### 5. Avaliação Física
* Funcionário registra avaliação física do aluno.
* Aluno visualiza seu histórico de avaliações físicas.

### 6. Financeiro (Pagamentos)
* Funcionário registra pagamento vinculado à inscrição do aluno.
* Aluno visualiza seu histórico de pagamentos.

### 7. Modalidades e Institucional (Contato e Banners)
* Funcionário cadastra e edita modalidades.
* Aluno e visitante visualizam modalidades oferecidas.
* Visitante envia mensagem pelo formulário de contato.
* Funcionário visualiza mensagens de contato recebidas.
* Funcionário gerencia banners institucionais do site.

---

## Requisitos Não Funcionais (Segurança, Dados e Qualidade)

* **Armazenamento Seguro de Senhas:** Toda senha deve ser armazenada exclusivamente como hash unidirecional (Bcrypt/Argon2id) e nunca exposta em respostas JSON ou logs.
* **Autenticação e Autorização Obrigatórias:** Todo acesso a dados pessoais, financeiros ou administrativos exige sessão autenticada e validação granular por papel (`admin`, `funcionario`, `aluno`) e propriedade do recurso (Policies).
* **Proteção contra Força Bruta:** Endpoints de autenticação devem aplicar limitação de tentativas (*rate limiting*).
* **Tratamento Seguro de Erros:** Mensagens internas de banco de dados, exceções SQL ou stack traces nunca devem ser exibidos ao usuário final em produção.
* **Integridade no Banco de Dados:** Regras críticas de domínio (valores não negativos, unicidade de inscrição ativa, formatos de documentos e chaves estrangeiras com `RESTRICT`) devem ser garantidas diretamente no PostgreSQL via constraints.
* **Conformidade e Minimização (LGPD):** Coleta estritamente limitada aos dados necessários para a operação, com restrição de acesso a dados financeiros (salários) e dados sensíveis de saúde (avaliações físicas).

---