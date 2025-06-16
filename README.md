dupla do trabalho: Nicolas Toaldo Golemba e Júlio Henrique Lage Michaliszen
# meu_sistema
# Sistema de Cadastro de Itens por Usuário (PHP + MySQL)

##  Tema Escolhido
Sistema de gerenciamento de itens (ex: tarefas, livros ou filmes), onde cada usuário pode:
- Cadastrar-se no sistema
- Fazer login
- Cadastrar, editar e visualizar seus próprios itens

---

##  Resumo do Funcionamento

- Usuários podem se registrar com login, senha e e-mail.
- Após login, é possível cadastrar itens com título e descrição.
- Cada usuário só visualiza e edita seus próprios itens.
- O sistema possui controle de sessão e validação de dados.
- Interface utiliza Bootstrap para melhor usabilidade.

---

##  Usuário de Teste

## 🛠 Passos para Instalação

1.https://github.com/NicolasToaldo10/meu_sistema.git

2. **Importe o banco de dados:**
- Abra o phpMyAdmin ou seu gerenciador MySQL.
- Crie um banco chamado `seu_banco`.
- Importe o arquivo `sql/script.sql`.

3. **Configure a conexão com o banco:**
- Acesse `config/db.php` e altere se necessário:
```php
$host = 'localhost';
$db = 'seu_banco';
$user = 'root';
$pass = '';
http://localhost/meu_sistema/public/
