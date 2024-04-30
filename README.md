# **SkyNotes**
	 APLICAÇÕES PARA WEB II: INFO-3  　
Repositório para armazenamento dos códigos do site "SkyNotes", uma plataforma para criação e visualização de tarefas. O projeto é referente a um trabalho para a disciplina de Laboratório de Aplicações para Web II.

### 👥 Grupo: 
  - [Eduarda Cristina Moreira Marques](https://github.com/Lizzie-Cristina)
  - [Érika Liz Augusto Moreira](https://github.com/oo0-o0)
  - [Sarah dos Santos Oliveira](https://github.com/SarahSdSO)

## Informações para compilação e execução 
> **Importante**:  O projeto foi desenvolvido utilizando o VSCode, e na versão 8.0.25 do Xampp e só foi testado apenas nelas. 

Para rodar:
1. Clone o repositório no seu computador. 
No CMD
```bash
  git clone https://github.com/oo0-o0/SkyNotes_CRUD.git
```
2. Mova ele para a pasta htdocs do xampp para conseguir rodar o PHP localmente.
No CMD
```bash
  move SkyNotes_CRUD c:\xampp\htdocs
```
3. Inicie o Apache e o MySQL no Xampp e rode o arquivo "sql/SkyNotesBD.sql"

4. Certifique-se de que as informações abaixo no arquivo de configurações "php/config.php" estão corretas de acordo com o seu computador. 
```
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SkyNotesDB";
```

5. Para abrir o programa no navegador, acesse a pasta pelo localhost.
```
  http://localhost/SkyNotes_CRUD
```
