
### **README - API CRUD com Autenticação**

---

#### **Descrição do Projeto**

Esta API CRUD (Create, Read, Update, Delete) foi desenvolvida em PHP e permite a criação, leitura, atualização e exclusão de usuários em um banco de dados MySQL. Ela utiliza autenticação baseada em **tokens SHA1** e possui estrutura modular organizada em pastas. A API inclui rotas para gerenciar os usuários e validações de segurança para proteger os endpoints.

---

### **Estrutura de Pastas**

```
/config       -> Configurações de conexão com o banco de dados
/controllers  -> Controladores responsáveis pelas operações CRUD
/middleware   -> Scripts de autenticação e validação de tokens
/models       -> Modelos de interação com o banco de dados
/public       -> Rota pública para acessar a API
```

---

### **Pré-requisitos**

1. **PHP** (>= 7.4)
2. **MySQL** (ou MariaDB)
3. **Servidor Local** (XAMPP, WAMP ou LAMP)
4. **Composer** (se for utilizado no futuro para dependências)
5. **Postman** ou **Insomnia** (para testes)

---

### **Instalação**

#### 1. **Clone o Repositório**
```bash
git clone https://github.com/seu-usuario/api-crud.git
cd api-crud
```

#### 2. **Configuração do Banco de Dados**
1. Certifique-se de que o MySQL está rodando.
2. Edite o arquivo `/config/database.php` e insira as credenciais do seu banco:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'crud_app');
   ```
3. Acesse a rota `http://localhost/apicrud/public/index.php` para criar o banco de dados e as tabelas automaticamente.

#### 3. **Testar no Servidor Local**
- Coloque o projeto na pasta `htdocs` do XAMPP ou no diretório equivalente do seu servidor local.
- Inicie o servidor e acesse `http://localhost/apicrud/`.

---

### **Endpoints da API**

#### **1. Criar Usuário**
- **Método**: `POST`
- **URL**: `http://localhost/apicrud/controllers/create.php`
- **Body**:
  ```json
  {
      "name": "Seu Nome",
      "email": "seuemail@example.com",
      "password": "suaSenha"
  }
  ```
- **Resposta**:
  ```json
  {
      "message": "Usuário criado com sucesso.",
      "token": "TOKEN_GERADO"
  }
  ```

#### **2. Fazer Login**
- **Método**: `POST`
- **URL**: `http://localhost/apicrud/controllers/auth.php`
- **Body**:
  ```json
  {
      "email": "seuemail@example.com",
      "password": "suaSenha"
  }
  ```
- **Resposta**:
  ```json
  {
      "message": "Login realizado com sucesso.",
      "token": "TOKEN_GERADO"
  }
  ```

#### **3. Listar Todos os Usuários**
- **Método**: `GET`
- **URL**: `http://localhost/apicrud/controllers/read_all.php`
- **Headers**:
  - `Authorization: Bearer TOKEN_GERADO`
- **Resposta**:
  ```json
  [
      {
          "id": 1,
          "name": "Seu Nome",
          "email": "seuemail@example.com",
          "created_at": "2024-11-24 12:00:00"
      }
  ]
  ```

#### **4. Buscar Usuário por ID**
- **Método**: `GET`
- **URL**: `http://localhost/apicrud/controllers/get.php?id=1`
- **Headers**:
  - `Authorization: Bearer TOKEN_GERADO`
- **Resposta**:
  ```json
  {
      "id": 1,
      "name": "Seu Nome",
      "email": "seuemail@example.com",
      "created_at": "2024-11-24 12:00:00"
  }
  ```

#### **5. Atualizar Usuário**
- **Método**: `PUT`
- **URL**: `http://localhost/apicrud/controllers/update.php?id=1`
- **Headers**:
  - `Authorization: Bearer TOKEN_GERADO`
- **Body**:
  ```json
  {
      "name": "Novo Nome",
      "email": "novonome@example.com",
      "password": "novasenha"
  }
  ```
- **Resposta**:
  ```json
  {
      "message": "Usuário atualizado com sucesso."
  }
  ```

#### **6. Excluir Usuário**
- **Método**: `DELETE`
- **URL**: `http://localhost/apicrud/controllers/delete.php?id=1`
- **Headers**:
  - `Authorization: Bearer TOKEN_GERADO`
- **Resposta**:
  ```json
  {
      "message": "Usuário excluído com sucesso."
  }
  ```

---

### **Testes com Postman ou Insomnia**

1. **Configuração Base**:
   - Adicione a URL base: `http://localhost/apicrud/`.
   - Configure um **header Authorization** com o valor `Bearer TOKEN_GERADO` para endpoints que exigem autenticação.

2. **Sequência Recomendada para Testes**:
   1. Acesse `http://localhost/apicrud/public/index.php` para criar o banco e as tabelas.
   2. Crie um usuário utilizando o endpoint `/controllers/create.php`.
   3. Faça login com o endpoint `/controllers/auth.php` para obter o token.
   4. Teste os endpoints protegidos (`read_all`, `get`, `update`, `delete`) utilizando o token gerado.

3. **Exportação para Postman/Insomnia**:
   - Crie uma coleção com as rotas e adicione o token dinamicamente para facilitar os testes em ambientes protegidos.

---