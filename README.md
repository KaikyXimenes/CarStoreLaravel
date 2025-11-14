# 🚗 CarStore - Projeto de Venda de Veículos

## 📸 Prints das Telas

*(Aqui você deve adicionar os prints. Veja abaixo como fazer)*

### Página Inicial (Listagem de Carros)
![Print da Página Inicial](https://github.com/user-attachments/assets/21f134ba-5c5d-4b92-8b01-2a671a9da8ce)

### Painel do Administrador (Dashboard)
![Print do Dashboard](https://github.com/user-attachments/assets/21f134ba-5c5d-4b92-8b01-2a671a9da8ce)

### Gerenciamento de Veículos (Admin)
![Print do Gerenciamento de Veículos](https://github.com/user-attachments/assets/0d02b27f-c48c-48e7-811f-c9846dbc4fe0)

### Adicionar Novo Veículo (Formulário)
![Print do Formulário de Adição](https://github.com/user-attachments/assets/7e97cab5-bf80-4962-96d5-dca206962964)

### Gerenciamento de Modelos (Admin)
![Print do Gerenciamento de Modelos](https://github.com/user-attachments/assets/0d380a08-ed5c-4002-8292-c628b69ea121)

---

## 🛠️ Como Rodar o Projeto

Para executar este projeto localmente, siga os passos abaixo:

1.  **Clonar o repositório:**
    ```bash
    git clone [https://github.com/seu-nome/CarStore.git](https://github.com/seu-nome/CarStore.git)
    cd CarStore
    ```

2.  **Copiar o arquivo de ambiente:**
    (Este projeto usa o `.env.example`. Copie-o para `.env`)
    ```bash
    cp .env.example .env
    ```

3.  **Instalar dependências do PHP (Composer):**
    ```bash
    composer install
    ```

4.  **Instalar dependências do Node (NPM):**
    ```bash
    npm install
    ```

5.  **Gerar a Chave de Aplicação do Laravel:**
    ```bash
    php artisan key:generate
    ```

6.  **Configurar o Banco de Dados:**
    Abra o arquivo `.env` e configure sua conexão com o banco de dados (ex: MySQL):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=carstore  <-- (ou o nome que você criou)
    DB_USERNAME=root      <-- (seu usuário do XAMPP)
    DB_PASSWORD=          <-- (sua senha do XAMPP, geralmente vazia)
    ```

7.  **Rodar as Migrações e Seeders:**
    Este comando irá criar as tabelas e popular o banco com os dados iniciais (modelos, cores e o usuário admin).
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Compilar os assets (Tailwind):**
    ```bash
    npm run dev
    ```
    *(Mantenha este terminal aberto)*

9.  **Iniciar o servidor:**
    Em um **novo terminal**, execute:
    ```bash
    php artisan serve
    ```

O site estará disponível em `http://127.0.0.1:8000`.

---

## 🔐 Credenciais de Acesso (Admin)

Para acessar o painel administrativo, utilize as seguintes credenciais:

* **Usuário:** `admin@carstore.com`
* **Senha:** `admin`

*(Estas credenciais são criadas automaticamente pelo `DatabaseSeeder`)*