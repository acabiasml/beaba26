# BEABÁ – Fluxo Técnico de Fechamento do Ano Letivo

Este documento descreve o **fluxo técnico oficial de fechamento do ano letivo** no sistema **BEABÁ**, 
estabelecendo regras pedagógicas, administrativas e técnicas para a geração do **histórico escolar imutável**.

---

## 1. Objetivo do Fechamento

O fechamento do ano letivo tem como objetivo:

- Consolidar os resultados pedagógicos
- Garantir a integridade dos dados escolares
- Gerar o histórico escolar imutável do aluno

Após o fechamento, **não é permitida a alteração de dados do ano letivo**.

---

## 2. Princípios Norteadores

O fluxo de fechamento do BEABÁ é regido pelos seguintes princípios:

- O histórico escolar é **imutável**
- Nenhum dado pedagógico é recalculado após o fechamento
- O histórico não depende mais das tabelas operacionais
- Correções exigem **reabertura formal do ano**

---

## 3. Etapa 1 – Pré-validações Obrigatórias

Antes do fechamento, o sistema deve validar automaticamente:

- Existência de períodos letivos configurados
- Componentes curriculares completos por turma
- Cumprimento da carga horária mínima por componente
- Registro de frequência para todas as aulas
- Lançamento de notas em todos os períodos

Caso qualquer validação falhe, o fechamento **é bloqueado**.

---

## 4. Etapa 2 – Cálculo dos Resultados Finais

Com todas as validações atendidas, o sistema realiza:

- Cálculo dos resultados finais por aluno e componente
- Aplicação das regras pedagógicas definidas pela instituição
  - médias numéricas
  - conceitos
  - regras híbridas

Nesta etapa, **nenhum dado é persistido no histórico**.

---

## 5. Etapa 3 – Geração do Histórico Escolar Imutável

Após os cálculos, o sistema gera registros congelados:

- Um registro de histórico anual por aluno
- Um registro por componente cursado, contendo:
  - nome do componente
  - área do conhecimento
  - tipo curricular
  - carga horária total
  - resultado final

Esses dados tornam-se **independentes do restante do sistema**.

---

## 6. Etapa 4 – Fechamento Formal do Ano Letivo

O ano letivo é marcado como fechado no sistema.

A partir desse momento:

- Não é permitido lançar ou alterar notas
- Não é permitido alterar frequência
- Não é permitido modificar matrículas
- Não é permitido alterar horários

Essas restrições são aplicadas por regras de aplicação.

---

## 7. Etapa 5 – Exceções e Retificações

Em caso de erro administrativo:

- O histórico **não deve ser editado**
- O procedimento correto é:
  1. Reabrir formalmente o ano letivo
  2. Corrigir os dados operacionais
  3. Realizar novo fechamento
  4. Preservar o histórico anterior como registro

---

## 8. Considerações Finais

Este fluxo garante:

- Segurança jurídica
- Rastreabilidade administrativa
- Fidelidade pedagógica
- Conformidade com:
  - Educação Básica
  - Censo Escolar
  - Boas práticas de software público

Este documento deve ser utilizado como **referência oficial** para implementação do fechamento do ano letivo no sistema BEABÁ.
