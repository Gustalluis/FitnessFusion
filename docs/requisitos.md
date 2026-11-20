# Requisitos — FitnessFusion

Este documento lista os requisitos funcionais e não funcionais planejados para a nova versão do **FitnessFusion**, organizados por domínio.

> **Fora de escopo (Descontinuado):** Os módulos de **Blog** e **Postagens** presentes no sistema legado em PHP procedural foram intencionalmente descontinuados nesta versão para priorizar a segurança, o controle de acesso e a gestão operacional da academia.

---

## Requisitos Funcionais

### 1. Gestão de Alunos (Clientes)
* Funcionário cadastra aluno (CPF e data de nascimento obrigatórios).
* Funcionário matricula como aluno uma pessoa que já é funcionária, sem criar uma segunda conta.
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
* Funcionário cancela uma inscrição (`status = 'cancelada'`).
* O sistema marca automaticamente como `vencida` toda inscrição ativa cujo período terminou.
* Funcionário renova a matrícula de um aluno com inscrição vencida.

### 3. Gestão de Funcionários
* Administrador cadastra funcionário (CPF e data de nascimento obrigatórios).
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
* **Fonte Única dos Dados Pessoais:** Dados civis (CPF, data de nascimento, telefone) são armazenados uma única vez por pessoa, independentemente de quantos papéis ela exerce no sistema.
* **Dados Civis Obrigatórios:** Toda pessoa ativa no sistema deve ter CPF e data de nascimento válidos, garantido diretamente pelo banco de dados.
* **Direito de Exclusão (LGPD, Art. 18):** Pedidos de eliminação de dados pessoais são atendidos por anonimização e desativação da conta, com registro da data de atendimento, preservando o histórico financeiro exigido pela operação.
* **Exposição Mínima de Dados Pessoais:** Dados civis (CPF, data de nascimento, telefone) ficam ocultos por padrão em qualquer serialização e só são expostos explicitamente onde houver necessidade e autorização.
