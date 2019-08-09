
# FINCORE Requests
Biblioteca PHP para integração e consultas na API Fincore https://api.fincore.co/doc

## Instalação
```
composer require fincore/requests
```
## Variáveis de ambiente
Aqui, utilizamos a biblioteca [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) para facilitar os testes através de variáveis de ambiente que podem ser recuperadas por qualquer classe através de [getenv](https://www.php.net/manual/en/function.getenv.php).

**É importante saber** que não é recomendado utilizar o arquivo *.env* no seu ambiente de produção. Mas nada impede que você proteja ele da leitura de ambientes abertos quando ele estiver fora da pasta *public_html* - ou equivalente.

Para para iniciarmos essa configuração, renomeie ou copie o arquivo *.env.example* para *.env* na pasta protegida de acesso de sua preferência e insira as informações necessárias para integração com os nossos dados e sua conta, configurando uma única variável de ambiente no seu sistema operacional preferido como *ENVIRONMENTS=/caminho/do/seu/arquivo/env*.

Se você não necessita de acesso e configurações para ambientes administrativos, configure apenas os dados de aplicações ou vice-versa.

### Acesso
#### Recuperação de Senha [#](https://api.fincore.co/doc/#api-Ajuda-Forgot)

Nesta funcionalidade, apenas a ação de recuperação de senha é iniciada, sendo necessária a intervenção manual através do link enviado por e-mail para troca da senha de acesso.

```
<?php
require 'vendor/autoload.php';

$helper = new \Fincore\AccessHelper();
$helper->forgot('seu@email.com');
```

### Conta de usuários
#### Atualização de dados [#](https://api.fincore.co/doc/#api-Ajuda-Recovery)

```
<?php
require 'vendor/autoload.php';

$account = new \Fincore\Account();
$account->UpdatingRegistration(['password' => 'senhaSuperSecreta']);
```
#### Dados do usuário administrativo [#](https://api.fincore.co/doc/#api-Ajuda-Recovery)
```
<?php
require 'vendor/autoload.php';

$account = new \Fincore\Account();
$account->RecoveringData();
```
### Administrativo
#### Dados de uma aplicação [#](https://api.fincore.co/doc/#api-Administrativo-getApp)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->RetrieveApp($id);
```

#### Lista de aplicações [#](https://api.fincore.co/doc/#api-Administrativo-getApps)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->ListApps();
```

#### Criando uma nova aplicação  [#](https://api.fincore.co/doc/#api-Administrativo-newApp)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->NewApp($url, $mongoDbDsn);
```

#### Atualizando os dados de uma aplicação [#](https://api.fincore.co/doc/#api-Administrativo-updateApp)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->UpdatingApps($url, $mongoDbDsn, $id);
```

#### Desabilitando uma aplicação  [#](https://api.fincore.co/doc/#api-Administrativo-deleteApp)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->DisableApps($id);
```

#### Reativando uma aplicação [#](https://api.fincore.co/doc/#api-Administrativo-reEnableApp)
```
<?php
require 'vendor/autoload.php';

$administrative = new \Fincore\Administrative();
$administrative->ReactivatingApps($id);
```

### Aplicações
#### Criando um múltiplos documentos [#](https://api.fincore.co/doc/#api-Apps-documentsUpdate)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsCreate($collection, $data);
```
#### Filtrando documentos [#](https://api.fincore.co/doc/#api-Apps-filterData)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->filterData($collection, $headers = []);
```
#### Consultando um documento através do seu ID [#](https://api.fincore.co/doc/#api-Apps-documentData)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentData($collection, $Id, $headers = []);
```
#### Atualizando um documento [#](https://api.fincore.co/doc/#api-Apps-documentUpdate)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentUpdate($collection, $Id, $data);
```
#### Atualizando múltiplos documentos [#](https://api.fincore.co/doc/#api-Apps-documentsUpdate)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsUpdate($collection, $data, $headers = []);
```
#### Excluindo múltiplos documentos [#](https://api.fincore.co/doc/#api-Apps-documentsDelete)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentsDelete($collection, $headers = []);
```
#### Excluindo um documento através do seu ID [#](https://api.fincore.co/doc/#api-Apps-documentDelete)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->DocumentDelete($collection, $Id);
```
#### Listando suas coleções de dados [#](https://api.fincore.co/doc/#api-Apps-collections)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->Collections();
```
#### Agregação de documentos [#](https://api.fincore.co/doc/#api-Apps-mongoDbAggregate)
```
<?php
require 'vendor/autoload.php';

$apps = new \Fincore\Apps();
$apps->Aggregate($collection, $Instructions);
```
### Background Check
#### Questionário baseado em um CPF  [#](https://api.fincore.co/doc/#api-Background_Check-outsourcingQuestions)
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->question($document);
```
#### Resposta do questionário identificada pelo ticket gerado no questionário [#](https://api.fincore.co/doc/#api-Background_Check-outsourcingAnswers)
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->answers($ticket, $answers);
```
#### OCR de documentos [CNH, Identidade ou Passaporte] [#](https://api.fincore.co/doc/#api-Background_Check-outsourcingDocOCR)
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->documents($imageURL, $type, $side);
```
#### Facematch - Validando a foto do usuário com a selfie enviada [#](https://api.fincore.co/doc/#api-Background_Check-outsourcingFacematch)
```
<?php
require 'vendor/autoload.php';

$bc = new \Fincore\BackgroundCheck();
$bc->facematch($documentURL, $selfieURL);
```

### Pessoa Física
#### Busca por anúncios online vinculados ao número do CPF enviado [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsAds)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->ads($document);
```
#### Dados básicos de um usuário como nome, filiação e outros documentos conhecidos, data de nascimento, signo e regularização na Receita Federal.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsBasic)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->basic($document);
```
#### Dados de profissionais conhecidos em conselhos de classe.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsMemberships)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->memberships($document);
```
#### Dados de profissionais conhecidos de funcionários públicos.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsPublicProfessions)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->publicProfessions($document);
```
#### Dados de profissionais conhecidos.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsProfessions)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->professions($document);
```
#### Dados de estudantes universitários.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsUniversity)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->universityStudents($document);
```
#### Domínios de internet conhecidos para um CPF.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsDomains)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->domains($document);
```
#### Endereços eletrônicos conhecidos para um CPF.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsEmails)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->email($document);
```
#### Endereços físicos conhecidos para um CPF com classificação para endereços de trabalho e casa.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsAddresses)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->addresses($document);
```
#### Exposição e perfil definidos em diversas mídias.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsMediaExposure)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->mediaExposure($document);
```
#### Indicadores e características de atividades financeiras pela WEB.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsFlagsAndFeatures)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->flagsAndFeatures($document);
```
#### Informações financeiras de IR.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsFinancial)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->financial($document);
```
#### Dados de Interpol e Ofac para homônimos e similaridades.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsKyc)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->kyc($document);
```
#### A consulta retorna informações relacionadas com comportamentos ou com o interesse em determinadas categorias de produtos e serviços.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsDemographic)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->interests($document);
```
#### Dados de passagens reconhecidas pela WEB como passagens suspeitas. [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsWebPassages)

```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->webPassages($document);
```
#### Informações de presença online que definem a utilização da internet.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsWebPassages)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->onlinePresence($document);
```
#### Dados de presença em cobranças por empresas, definindo os níveis de encontrabilidade por endereços, e-mails e telefones, por exemplo.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsRecurrencyToCharging)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->recurrencyToCharging($document);
```
#### Dados de processos conhecidos através do CPF oriundos dos tribunais regionais. [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsProcesses)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->processes($document);
```
#### Informações de participação em programas de benefícios como o bolsa-família.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsSocialAssistences)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->socialAssistences($document);
```
#### Informações sobre relacionamentos econômicos.[#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsBusiness)
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->businessRelationships($document);
```
### Pessoa Jurídica

#### Consulta com informações relacionadas dos anuncios postados pela empresa consultado nos principais marketplaces e portais de anúncios da internet. [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesAds)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->ads($document);

```
#### Consulta contém o conjunto mais simples de informações dentre todos os datasets, com informações cadastrais recuperadas de fontes oficiais .[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesBasic)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->basic($document)
```
#### Domínios de internet conhecidos para um CNPJ.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesDomains)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->domains($document)
```
#### Endereços eletrônicos conhecidos para um CNPJ.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesEmails)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> emails($document)
```

#### Exposição e perfil definidos em diversas mídias.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesMediaExposure)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->mediaExposure($document);
```

#### Os dados retornam informações agrupadas e agregadas do grupo econômico relacionado com a empresa principal sendo consultada, em todas as direções.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesEconomicGroups)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->EconomicGroups($document);
```


#### Indicadores e características de atividades financeiras pela WEB.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesactivity_indicators)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> activityIndicators($document);
```

####Os Processos Judiciais e Administrativos retorna informações, tanto atuais quanto históricas, do envolvimento da entidade consultada em ações judiciais de todos os tipos (civil, trabalhista, criminal, etc).[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesProcesses)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> Processes($document);
```


#### Informações sobre relacionamentos econômicos.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesRelationships)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->relationships($document);
```
#### Dados de telefones associados ao CNPJ consultado.[#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesPhones)
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->phones($document);
```

### Utilitários
#### JSON para XLS [#](https://api.fincore.co/doc/#api-Utilidades-jsonToXls)
A conversão de um objeto JSON para um arquivo XLS é importante para exportar dados já normalizados, transformando a sua leitura em uma planilha Excel. Esta rota é um download de arquivo XLS.
```
<?php
require 'vendor/autoload.php';

$json = new \Fincore\Utilities;
$json->JsonToXls($json);

```
