# Sistema de Controle de Biblioteca

Projeto didático de CRUD desenvolvido com **PHP + HTML + CSS + MySQL**, sem uso de
frameworks e sem orientação a objetos (código procedural), voltado para uma turma
iniciante em programação.

O sistema permite:
- Login e cadastro de usuários do sistema (bibliotecário/atendente)
- Cadastro de livros (acervo)
- Cadastro de clientes (quem pega livros emprestados)
- Registro de empréstimos e devoluções, com controle automático da quantidade
  de exemplares disponíveis de cada livro

## Tecnologias utilizadas

- PHP 8 (procedural, com `mysqli`)
- MySQL / MariaDB
- HTML5 + CSS3
- [Bootstrap 5](https://getbootstrap.com/) (via CDN)

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP), ou qualquer
  ambiente equivalente (Apache/Nginx + PHP 8 + MySQL)

## Como instalar e rodar

1. Clone (ou copie) este repositório para dentro da pasta `htdocs` do XAMPP:
   ```
   C:\xampp\htdocs\teste_claude
   ```
2. Inicie o **Apache** e o **MySQL** pelo painel de controle do XAMPP.
3. Crie o banco de dados executando o script `database.sql`:
   - Pelo phpMyAdmin (`http://localhost/phpmyadmin`) → aba **Importar** → selecione o
     arquivo `database.sql`; **ou**
   - Pela linha de comando:
     ```
     mysql -u root -p < database.sql
     ```
4. Confira as credenciais do banco em `conexao.php` (por padrão, usuário `root` e
   senha em branco — o padrão do XAMPP). Ajuste se o seu ambiente for diferente.
5. Acesse no navegador:
   ```
   http://localhost/teste_claude/
   ```
6. Na landing page, clique em **Entrar** → **Criar uma conta** para cadastrar o
   primeiro usuário do sistema e começar a usar.

## Estrutura do projeto

```
teste_claude/
├── assets/css/estilo.css      # Estilos personalizados
├── includes/
│   ├── cabecalho.php          # Navbar/menu (áreas internas)
│   ├── rodape.php             # Fechamento do HTML
│   └── verifica_login.php     # Bloqueia acesso de quem não está logado
├── livros/                    # CRUD de livros
├── clientes/                  # CRUD de clientes
├── emprestimos/                # Registrar e devolver empréstimos
├── conexao.php                 # Conexão com o banco de dados
├── database.sql                 # Script de criação do banco e tabelas
├── index.php                    # Landing page
├── login.php / logout.php       # Autenticação
├── cadastro_usuario.php         # Cadastro de usuário do sistema
└── dashboard.php                # Painel interno
```

## Estrutura do banco de dados

4 tabelas: `usuarios`, `livros`, `clientes` e `emprestimos` (esta última relaciona
livro + cliente e controla o status do empréstimo). Veja o detalhamento completo em
[database.sql](database.sql).

## Observações

- Este é um projeto **didático**: prioriza clareza de código sobre boas práticas de
  arquitetura mais avançadas (não há orientação a objetos, API ou framework).
- Senhas são armazenadas com hash (`password_hash`), e todas as consultas ao banco
  usam *prepared statements* (`mysqli_prepare`) para evitar SQL Injection.
