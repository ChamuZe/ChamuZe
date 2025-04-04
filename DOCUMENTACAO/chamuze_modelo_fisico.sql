/*Criação do banco*/
CREATE DATABASE chamuze 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

/*Usando o banco de dados*/
USE chamuze;

/*Criação da tabela usuario - Generalização - */
CREATE TABLE usuario (
	id_usuario INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(150) NOT NULL,
	senha VARCHAR(255) NOT NULL,
	nota_reputacao DECIMAL(3,2) NOT NULL,
	tipo_perfil ENUM ('administrador','prestador','solicitante')NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela administrador - Especialização - */
CREATE TABLE administrador (
	id_administrador INTEGER NOT NULL PRIMARY KEY,
	FOREIGN KEY (id_administrador) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela prestador - Especialização - */
CREATE TABLE prestador (
id_prestador INTEGER NOT NULL PRIMARY KEY,
	FOREIGN KEY (id_prestador) REFERENCES usuario(id_usuario),
	cpf VARCHAR(11) NOT NULL,
	img_rg VARCHAR(255) NOT NULL,
	chave_pix VARCHAR(100) NOT NULL,
	status_avaliacao ENUM('aprovado','reprovado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela solicitante - Especialização - */
CREATE TABLE solicitante (
	id_solicitante INTEGER NOT NULL PRIMARY KEY,
	FOREIGN KEY (id_solicitante) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela administrador_prestador - Relacional - */
CREATE TABLE administrador_prestador (
    id_administrador INTEGER NOT NULL,
    id_prestador INTEGER NOT NULL,
    PRIMARY KEY (id_administrador, id_prestador),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
    FOREIGN KEY (id_prestador) REFERENCES prestador(id_prestador)
);

/*Criação da tabela administrador_solicitante - Relacional - */
CREATE TABLE administrador_solicitante (
    id_administrador INTEGER NOT NULL,
    id_solicitante INTEGER NOT NULL,
    PRIMARY KEY (id_administrador, id_solicitante),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador),
	FOREIGN KEY (id_solicitante) REFERENCES solicitante(id_solicitante)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela pagamento */
CREATE TABLE pagamento (
	id_pagamento INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    data_pagamento DATE NOT NULL,
    status_pagamento ENUM('pago','pendente') NOT NULL,
    valor_pagamento DECIMAL(10,2) NOT NULL,
    id_solicitante INTEGER,
    id_prestador INTEGER,
    FOREIGN KEY (id_solicitante) REFERENCES solicitante(id_solicitante),
    FOREIGN KEY (id_prestador) REFERENCES prestador(id_prestador)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela servico */
CREATE TABLE servico (
    id_servico INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descricao Text NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    img_servico VARCHAR(255) NOT NULL,
    categoria VARCHAR(255) NOT NULL,
    status_servico ENUM('aceito','disponivel') NOT NULL,
    regiao VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    id_solicitante INTEGER,
    id_prestador INTEGER,
    FOREIGN KEY (id_solicitante) REFERENCES solicitante(id_solicitante),
    FOREIGN KEY (id_prestador) REFERENCES prestador(id_prestador)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Criação da tabela proposta */
CREATE TABLE proposta (
	id_proposta INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_servico INTEGER NOT NULL,
	valor FLOAT NOT NULL,
    mensagem TEXT NOT NULL,
    id_solicitante INTEGER,
    id_prestador INTEGER,
    FOREIGN KEY (id_servico) REFERENCES servico(id_servico),
    FOREIGN KEY (id_solicitante) REFERENCES solicitante(id_solicitante),
    FOREIGN KEY (id_prestador) REFERENCES prestador(id_prestador)
);
