
# FINCORE Requests
Biblioteca PHP para integração e consultas na API Fincore https://api.fincore.co/doc

## Variáveis de ambiente
Aqui, utilizamos a biblioteca [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) para facilitar os testes através de variáveis de ambiente que podem ser recuperadas por qualquer classe através de [getenv](https://www.php.net/manual/en/function.getenv.php).

**É importante saber** que não é recomendado utilizar o arquivo *.env* no seu ambiente de produção. Mas nada impede que você proteja ele da leitura de ambientes abertos ou configure suas chaves no seu *.profile*, *.bashrc* ou equivalente no seu sistema operacional preferido.

Para para iniciarmos essa configuração, renomeie ou copie o arquivo *.env.example* para *.env* e insira as informações necessárias para integração com os nossos dados e sua conta.

Se você não necessita de acesso e configurações para ambientes administrativos, configure apenas os dados de aplicações ou vice-versa.

### Acesso
Nesta funcionalidade, apenas a ação de recuperação de senha é iniciada, sendo necessária a intervenção manual através do link enviado por e-mail para troca da senha de acesso.

```
<?php
require 'vendor/autoload.php';

$helper = new \Fincore\AccessHelper();
$helper->forgot('seu@email.com');
```

### Conta de usuários
#### Atualização de dados
```
<?php
require 'vendor/autoload.php';

$account = new \Fincore\Account();
$account->UpdatingRegistration(['password' => 'senhaSuperSecreta']);
```
#### Dados do usuário administrativo
```
<?php
require 'vendor/autoload.php';

$account = new \Fincore\Account();
$account->RecoveringData();
```
### Administrativo
#### Dados de uma aplicação
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->RetrieveApp($id);
```

#### Lista de aplicações
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->ListApps();
```

#### Criando uma nova aplicação
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->NewApp($url, $mongoDbDsn);
```

#### Atualizando os dados de uma aplicação
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->UpdatingApps($url, $mongoDbDsn, $id);
```

#### Desabilitando uma aplicação
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->DisableApps($id);
```

#### Reativando uma aplicação
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->ReactivatingApps($id);
```

### Aplicações
### Background Check
### Ajuda
### Pessoa Física
### Pessoa Jurídica
### Requisições
### Utilitários
