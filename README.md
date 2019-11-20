Instruções

1 - Instale o gerenciador de dependências composer;
2 - Navegue via terminal até o diretório onde o projeto será instalado;
3 - Execute o comando a seguir para instalar o PHP Slim Framework 3.
        composer require slim/slim "^3.12.2"
4 - Execute o comando a seguir para instalar o PHP-View. Será útil caso precise carregar arquivos de view.
        composer require slim/php-view
5 - Ative a sobrescrita de url em seu servidor e crie o arquivo .htaccess com o conteúdo abaixo na raiz do projeto para omitir o arquivo index.php na URL.
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ ./index.php?/$1 [L]

6 - A arquitetura da API deve seguir o padrão da figura 1.
6.1 - Arquitetura sugerida de diretórios e arquivos a partir da raiz do sistema:
    - index.php
    - env.php
    - app
        - config
            - Config.php (classe)
            - Routes.php (classe)
        - controllers
            - OperatorController.php (classe)
        - models
            - data
            - dao
7 - A ferramenta de documentação sugerida é a 'apidocjs.com'. Instalação e configurações básicas a seguir.
    7.1 - Comando de instalação:
        npm install apidoc -g
    7.2 - Crie um arquivo 'apidoc.json' na raiz do projeto com o conteúdo básico de seu projeto. Exemplo:
        {
            "name": "API Exemplo",
            "version": "1.0.0",
            "description": "Descrição da API",
            "title": "Título principal",
            "url" : "http://........"
        }
    7.3 - Após a criação do arquivo 'apidoc.json' execute o comando a seguir para gerar a documentação dos métodos com as marcações da api. O exemplo abaixo considera que os métodos a serem documentados estão 
    em app/controllers/v1 e colocará a documentação gerada no diretório apidoc, na raiz do projeto: 
        apidoc -i app/controllers/v1 -o apidoc/