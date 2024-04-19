CREATE DATABASE IF NOT EXISTS `SkyNotesDB`;
USE `SkyNotesDB`;
SET sql_safe_updates = 0;

CREATE TABLE IF NOT EXISTS `usuario` 
(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nome` VARCHAR(70),
    `senha` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `tarefas` 
(
    `id_tarefa` INT PRIMARY KEY AUTO_INCREMENT,
    `nome_da_tarefa` VARCHAR(100),
    `descricao_tarefa` VARCHAR(1000),
    `categoria_tarefa` VARCHAR(50),
    `prioridade_tarefa` VARCHAR(20),
    `prazo_tarefa` DATE,
    `status_tarefa` VARCHAR(20),
    `id_usuario` INT,
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id`)
);

GRANT SELECT, INSERT, UPDATE, DELETE ON SkyNotesDB.tarefas TO 'seu_usuario'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON SkyNotesDB.usuario TO 'seu_usuario'@'localhost';