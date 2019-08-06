
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
#### Criando um múltiplos documentos
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsCreate($collection, $data);
```
#### Filtrando documentos
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->filterData($collection, $headers = []);
```
#### Consultando um documento através do seu ID
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentData($collection, $Id, $headers = []);
```
#### Atualizando um documento
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentUpdate($collection, $Id, $data);
```
#### Atualizando múltiplos documentos
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsUpdate($collection, $data, $headers = []);
```
#### Excluindo múltiplos documentos
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsDelete($collection, $headers = []);
```
#### Excluindo um documento através do seu ID
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentDelete($collection, $Id);
```
#### Listando suas coleções de dados
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->Collections();
```
#### Agregação de documentos
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->Aggregate($collection, $Instructions);
```
### Background Check
#### Questionário baseado em um CPF
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->question($document);
```
#### Resposta do questionário identificada pelo ticket gerado no questionário
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->answers($ticket, $answers);
```
#### OCR de documentos [CNH, Identidade ou Passaporte]
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->documents($imageURL, $type, $side);
```
#### Facematch - Validando a foto do usuário com a selfie enviada
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->facematch($documentURL, $selfieURL);
```

### Pessoa Física
### Pessoa Jurídica
### Requisições
### Utilitários
