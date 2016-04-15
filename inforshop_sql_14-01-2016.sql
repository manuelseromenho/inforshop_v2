-- SCRIPT SQL para "INFORSHOP"

-- cria a BD
create schema if not exists inforshop;

-- seleciona/activa a BD "inforshop"
use inforshop;

CREATE TABLE clientes (
	id_cliente INT PRIMARY KEY AUTO_INCREMENT,
	nif VARCHAR(10) NOT NULL UNIQUE,
	nome VARCHAR(50) NOT NULL,
	morada VARCHAR(50) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	email VARCHAR(30)
);

CREATE TABLE funcionarios (
	id_funcionario INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	morada VARCHAR(50) NOT NULL,
	telefone VARCHAR(50) NOT NULL,
	nif VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(50),
	data_nascimento DATE,
	data_entrada DATE
);

CREATE TABLE servicos (
	id_servico INT PRIMARY KEY AUTO_INCREMENT,
	tipo_servico VARCHAR(50) NOT NULL,
	preco DECIMAL(10 , 2 ) NOT NULL,
	tempo_estimado VARCHAR(50)
);

CREATE TABLE estados (
	id_estado INT PRIMARY KEY AUTO_INCREMENT,
	estado VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE marcas (
	id_marca INT PRIMARY KEY AUTO_INCREMENT,
	marca VARCHAR(50) NOT NULL
);

CREATE TABLE modelos (
	id_modelo INT PRIMARY KEY AUTO_INCREMENT,
	modelo VARCHAR(50) NOT NULL UNIQUE,
	id_marca INT NOT NULL,
	CONSTRAINT ch_estr_marcas FOREIGN KEY (id_marca)
        	REFERENCES marcas (id_marca)
        	ON UPDATE CASCADE 
        	ON DELETE CASCADE

);



CREATE TABLE categorias (
	id_categoria INT PRIMARY KEY AUTO_INCREMENT,
	nome_categoria VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE subcategorias (
	id_subcategoria INT PRIMARY KEY AUTO_INCREMENT,
	nome_subcategoria VARCHAR(50) NOT NULL UNIQUE, 
	id_categoria INT NOT NULL, 
	CONSTRAINT ch_estr_categorias FOREIGN KEY (id_categoria)
        	REFERENCES categorias (id_categoria)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE produtos (
	id_produto INT PRIMARY KEY AUTO_INCREMENT,
	nome_produto VARCHAR(50) NOT NULL,
	num_serie VARCHAR(50) NOT NULL UNIQUE,
	cod_barras VARCHAR(50) NOT NULL UNIQUE,
	peso FLOAT NOT NULL,
	quantidade INT,
	preco_venda DECIMAL(10 , 2 ) NOT NULL, 
    id_subcategoria INT NOT NULL,
    id_marca INT NOT NULL,
	CONSTRAINT ch_estr_subcategorias FOREIGN KEY (id_subcategoria)
        	REFERENCES subcategorias (id_subcategoria)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_marcas FOREIGN KEY (id_marca)
        	REFERENCES marcas (id_marca)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE assistencias (
	id_assistencia INT PRIMARY KEY AUTO_INCREMENT,
	descricao_assistencia VARCHAR(50) NOT NULL,
	descricao_equipamento VARCHAR(50) NOT NULL,
	data_entrada DATE NOT NULL,
	data_saida DATE NOT NULL,
	valor_total DECIMAL(10 , 2 ) NOT NULL,
    id_cliente INT NOT NULL,
    id_funcionario INT NOT NULL,
	CONSTRAINT ch_estr_clientes FOREIGN KEY (id_cliente)
        	REFERENCES clientes (id_cliente)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_funcionarios FOREIGN KEY (id_funcionario)
        	REFERENCES funcionarios (id_funcionario)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE usados_efetuados (
    id_ue INT PRIMARY KEY AUTO_INCREMENT,
    id_assistencia INT NOT NULL,
    id_servico INT NOT NULL,
    id_estado INT NOT NULL,
    CONSTRAINT ch_estr_assistencias FOREIGN KEY (id_assistencia)
        	REFERENCES assistencias (id_assistencia)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_servicos FOREIGN KEY (id_servico)
        	REFERENCES servicos (id_servico)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_estados FOREIGN KEY (id_estado)
        	REFERENCES estados (id_estado)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE instalacao (
	id_instal INT PRIMARY KEY AUTO_INCREMENT,
	quantidade INT NOT NULL,
	id_ue INT NOT NULL,
	id_produto INT NOT NULL,
    CONSTRAINT ch_estr_ue_inst FOREIGN KEY (id_ue)
        	REFERENCES usados_efetuados (id_ue)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_prod_inst FOREIGN KEY (id_produto)
        	REFERENCES produtos (id_produto)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE compra (
	id_compra INT PRIMARY KEY AUTO_INCREMENT,
	data_compra DATE NOT NULL,
	id_cliente INT NOT NULL,
	preco_total DECIMAL(10 , 2 ) NOT NULL,
	CONSTRAINT ch_estr_cli_comp FOREIGN KEY (id_cliente)
        	REFERENCES clientes (id_cliente)
        	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE detalhes_compra(
	id_det_compra INT PRIMARY KEY AUTO_INCREMENT,
	id_compra INT PRIMARY KEY NOT NULL,
	id_produto INT PRIMARY KEY NOT NULL,
	quantidade INT NOT NULL,
	desconto INT,
	CONSTRAINT ch_estr_comp FOREIGN KEY (id_compra)
        	REFERENCES compra (id_compra)
        	ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT ch_estr_prod_comp FOREIGN KEY (id_produto)
        	REFERENCES produtos (id_produto)
        	ON UPDATE CASCADE ON DELETE CASCADE	
	);
