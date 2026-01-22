
# Clash of Clans Autoplanner

Aplicativo web para planejar upgrades de vilas do Clash of Clans.

## Tecnologias
- Backend: PHP (Slim Framework, MVC, API RESTful)
- Frontend: React (Webpack, Babel)

## Funcionalidades
- Consulta dados da vila pela API oficial do Clash of Clans
- Exibe informações visuais: nome, tag, centro da vila, clã, heróis, tropas (com imagens oficiais)
- Interface moderna, responsiva e visual

## Estrutura do Projeto
- `/backend`: Código PHP (API, lógica de negócio, banco de dados)
- `/frontend`: Código React (interface do usuário)

## Instalação e Execução

### 1. Backend (PHP)
1. Acesse a pasta `backend`.
2. Instale as dependências:
   ```
   composer install
   ```
3. Copie o arquivo `.env.example` para `.env` e preencha com seu token da API do Clash of Clans:
   ```
   COC_API_URL=https://api.clashofclans.com/v1
   COC_API_TOKEN=SEU_TOKEN_AQUI
   ```
4. Inicie o servidor embutido do PHP:
   ```
   php -S localhost:8080 -t backend/public
   ```

### 2. Frontend (React)
1. Acesse a pasta `frontend`.
2. Instale as dependências:
   ```
   npm install
   ```
3. (Opcional) Crie um arquivo `.env` baseado em `.env.example` para configurar a URL do backend:
   ```
   REACT_APP_BACKEND_URL=http://localhost:8080
   ```
4. Inicie o servidor de desenvolvimento:
   ```
   npm start
   ```
5. Acesse [http://localhost:3000](http://localhost:3000) no navegador.

## Observações
- Certifique-se de que o backend está rodando antes de usar o frontend.
- O backend já está configurado para aceitar requisições CORS do frontend.
- O token da API do Clash of Clans pode ser obtido em https://developer.clashofclans.com/
- As imagens das tropas são carregadas automaticamente dos assets oficiais do Clash of Clans.

## Licença
MIT
