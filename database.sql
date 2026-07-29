-- Banco de dados do Sistema de Controle de Biblioteca
-- Projeto didático - sem uso de frameworks ou ORM

CREATE DATABASE IF NOT EXISTS biblioteca_claude
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE biblioteca_claude;

-- Tabela de usuários do sistema (quem faz login: bibliotecário/atendente)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de livros (acervo da biblioteca)
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    isbn VARCHAR(20),
    quantidade INT NOT NULL DEFAULT 1,
    disponivel INT NOT NULL DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de clientes (quem pega livros emprestados)
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de empréstimos (controla o fluxo de empréstimo/devolução)
CREATE TABLE emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL,
    cliente_id INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_prevista_devolucao DATE NOT NULL,
    data_devolucao DATE DEFAULT NULL,
    status ENUM('emprestado', 'devolvido') NOT NULL DEFAULT 'emprestado',
    FOREIGN KEY (livro_id) REFERENCES livros(id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
