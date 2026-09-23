# 🌲 Serraria — Site Institucional

> 🚧 **Projeto em desenvolvimento**

Site institucional desenvolvido para uma serraria, com o objetivo de apresentar a empresa, seus produtos e serviços de forma moderna, simples e profissional.

## 📌 Sobre o projeto

O projeto está **em desenvolvimento** e busca criar uma presença digital para a serraria, permitindo que clientes conheçam a empresa, seus produtos e serviços, além de encontrarem facilmente informações de contato.

## 🚀 Funcionalidades

* 🏠 Página inicial com apresentação da empresa
* 🌲 Apresentação dos produtos e serviços
* 🏢 Seção sobre a empresa
* 📞 Informações de contato
* 📱 Design responsivo
* 🎨 Interface moderna e intuitiva

## 🛠️ Tecnologias utilizadas

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL

## ⚙️ Como rodar localmente

1. Coloque a pasta do projeto dentro de `htdocs` do XAMPP e inicie o Apache.
2. Copie `mail-config.example.php` para `mail-config.php` e preencha com seus dados de SMTP (as instruções estão no próprio arquivo).
3. Crie o banco de dados MySQL rodando o script `database/schema.sql` (pelo phpMyAdmin, MySQL Workbench ou pelo terminal com `mysql -u root -p < database/schema.sql`).
4. Copie `db-config.example.php` para `db-config.php` e preencha com o usuário e a senha do seu MySQL.
5. Acesse `http://localhost/brazil-south-lumber/` no navegador.

> ⚠️ O `mail-config.php` e o `db-config.php` contêm dados reais de acesso e estão no `.gitignore` — nunca envie esses arquivos para o Git.

## 🗄️ Banco de dados

O site usa MySQL com duas tabelas:

* `orcamentos` — cada pedido enviado pelo formulário fica salvo aqui, além de ir por e-mail. A coluna `email_enviado` mostra se o aviso por e-mail saiu.
* `produtos` — o catálogo exibido em `produtos.php`. Para esconder um produto sem apagar, mude `ativo` para `0`; para mudar a ordem, use a coluna `ordem`.

## 🎯 Objetivo

Desenvolver um site profissional e responsivo para fortalecer a presença digital da serraria, facilitar a divulgação de seus produtos e proporcionar uma experiência simples para os clientes.

## 🚧 Status do projeto

**Em desenvolvimento.**

Novas funcionalidades, melhorias visuais e ajustes serão adicionados ao projeto ao longo do desenvolvimento.
