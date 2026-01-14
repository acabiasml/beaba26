# 📘 RESUMO TÉCNICO OFICIAL  
## Projeto BEABÁ – Sistema de Gestão Escolar  

**Versão:** 1.0  
**Data:** Janeiro/2026  
**Responsável técnico:** Acabias Marques Luiz  
**Licença:** GNU GPL v3  
**Organização:** Operação Mato Grosso  

---

## 1. Visão Geral do Sistema

O **BEABÁ** é um sistema de gestão escolar desenvolvido em **Laravel 12**, voltado às escolas da organização **Operação Mato Grosso**, com foco em:

- Educação Básica (Educação Infantil, Ensino Fundamental e Ensino Médio)
- Conformidade com **BNCC** e **Censo Escolar**
- Histórico escolar completo, inclusive de alunos vindos de outras instituições
- Auditoria detalhada de alterações
- Autenticação institucional via **Google Workspace**

---

## 2. Princípios de Modelagem (Decisões Centrais)

### 2.1 Separação Pessoa × Usuário

- `people`: dados civis e pessoais (nome, CPF, RG, certidão, SUS, NIS etc.)
- `users`: conta de acesso (person_id, email, role, auth_provider, archived)

A tabela `users` **não possui nome**, respeitando normalização e Censo Escolar.

---

## 3. Papéis no Sistema

- administrador
- gestor
- professor
- aluno
- apoio

Controlados por Gates no `AppServiceProvider`.

---

## 4. Autenticação

### 4.1 Login Google

- Google OAuth (Socialite)
- Domínio autorizado: `ctjj.org`
- Sem criação automática de usuários

### 4.2 Setup Inicial

- Se não houver usuários → `/setup`
- Primeiro usuário é administrador

---

## 5. Middlewares

- `EnsureUserIsActive` não é global
- Usado como alias `active`
- Aplicado após `auth`

---

## 6. Auditoria

- Tabela `audit_logs`
- Observers para Grade, Attendance, Diary, SchoolYear e User
- Histórico escolar imutável não auditável

---

## 7. Modelagem Pedagógica

### 7.1 BNCC

- Educação Física é componente de Linguagens
- Formação Técnica e Profissional incluída

### 7.2 Ensino Médio

- 1800h + 1200h
- 2400h + 600h
- Regra associada ao ano letivo

---

## 8. Horários e Avaliação

- Horários mutáveis
- Aulas geminadas separadas
- Frequência P/F
- Notas numéricas ou conceituais

---

## 9. Rotas

- `/` home/dashboard
- `/setup`
- `/auth/google`
- `/dashboard`
- `/usuarios/novo`

---

## 10. Interface

- Layout base `layouts.app`
- Dashboard por papel

---

## 11. Estado Atual

- Laravel 12 OK
- Banco migrado
- Login Google OK
- Auditoria OK
- Dashboard OK

---

## 12. Próximo Passo

**Passo 3 – Cadastro de usuários**

---

## 13. Preferências do Projeto

- Sem gambiarras
- Alinhado a BNCC e Censo
- Documentação clara
- Base sólida antes de avançar

---

## 14. Uso

Documento oficial de continuidade do projeto.
