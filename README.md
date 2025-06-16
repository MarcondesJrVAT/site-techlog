## Primeiros passos

Instruções de instalação e configuração do projeto.

```sh
git clone git@github.com:MarcondesJrVAT/site-techlog.git && cd site-techlog && npm install
```

### Build

Para gerar o diretório `public` com os arquivos `css, js, images, fonts` minificados

```sh
npm run build
```

### Dependências PHP

Para gerar o autoload no diretório vendor

```sh
./bin/composer.phar install
```

### Deploy

Para efetuar o deploy nos ambientes definidos no arquivo deploy.php `test`, `production`

```sh
./bin/deployer.phar deploy production
```