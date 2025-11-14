# 🚗 CarStore - Projeto de Venda de Veículos

## 📸 Prints das Telas

![Print 1](https://github.com/user-attachments/assets/6c61c0ff-c8d3-4799-9c37-8124430060da)
![Print 2](https://github.com/user-attachments/assets/a9b0dfda-4c2f-4911-bf81-97fb0a5daffe)
![Print 3](https://github.com/user-attachments/assets/16bfbd65-14db-4b7f-8b9a-15ad3f91b292)
![Print 4](https://github.com/user-attachments/assets/79518fa5-e1e2-4058-932e-1e5476fde7d6)
![Print 5](https://github.com/user-attachments/assets/92e0a750-0f7a-4910-ab13-32d88fce56ef)
![Print 6](https://github.com/user-attachments/assets/07de28f1-6bb4-4942-89d7-218ed77e514d)
![Print 7](https://github.com/user-attachments/assets/da921016-a725-4f62-9b20-a6a67524395d)
![Print 8](https://github.com/user-attachments/assets/7b777db2-a5e5-4e15-9599-e753f1f419a2)
![Print 9](https://github.com/user-attachments/assets/5c8f6c97-f673-4dbd-ba3e-eddfaf3dca62)
![Print 10](https://github.com/user-attachments/assets/673ca2f1-de6b-480a-ad81-03b5ee5979ee)
![Print 11](https://github.com/user-attachments/assets/b000d519-8a18-45b6-80ca-d7b14d99d512)
![Print 12](https://github.com/user-attachments/assets/d42f0aec-602d-4c44-92dd-0a52af70e7f5)
![Print 13](https://github.com/user-attachments/assets/315bf701-9924-49b8-b1dc-1c099c0eaa8e)
![Print 14](https://github.com/user-attachments/assets/87630af7-01eb-48b6-a47f-0876ffd0201c)
![Print 15](https://github.com/user-attachments/assets/4c27056c-d60b-4650-9c07-b59bbd698e9e)
![Print 16](https://github.com/user-attachments/assets/f4b01b0b-42b8-43f9-9399-e662cb3cf6cf)
![Print 17](https://github.com/user-attachments/assets/fd2ac45a-fdac-4d1c-870c-31a264370d88)
![Print 18](https://github.com/user-attachments/assets/d8a04010-1455-46c0-99ac-d56ddce55a7c)
![Print 19](https://github.com/user-attachments/assets/2fc45701-85f9-4ea8-b761-38a34addbf26)
![Print 20](https://github.com/user-attachments/assets/e71fdcaa-2e9c-44ee-bdf5-f1a628aa5c52)
![Print 21](https://github.com/user-attachments/assets/3a00d23a-1124-43f3-9a56-afb323b321ce)

---

## 🛠️ Como Rodar o Projeto

Para executar este projeto localmente, siga os passos abaixo:

1.  **Clonar o repositório:**
    ```bash
    git clone [https://github.com/seu-nome/CarStore.git](https://github.com/seu-nome/CarStore.git)
    cd CarStore
    ```
    *(Não se esqueça de alterar `seu-nome` para o seu usuário do GitHub!)*

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