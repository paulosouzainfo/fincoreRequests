
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
#### PF - Anúncios online [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsAds)
Busca por anúncios online vinculados ao número do CPF enviado 
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->ads($document);
```

#### PF - Dados Cadastrais Básicos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsBasic)
Dados básicos de um usuário como nome, filiação e outros documentos conhecidos, data de nascimento, signo e regularização na Receita Federal.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->basic($document);
```
#### PF - Dados Profissionais - Conselhos de Classe [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsMemberships)
Dados de profissionais conhecidos em conselhos de classe.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->memberships($document);
```
#### PF - Dados Profissionais - Servidores Públicos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsPublicProfessions)
Dados de profissionais conhecidos de funcionários públicos.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->publicProfessions($document);
```
#### PF - Dados Profissionais [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsProfessions)
Dados de profissionais conhecidos.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->professions($document);
```
#### PF - Dados de Estudantes Universitários [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsUniversity)
Dados de estudantes universitários.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->universityStudents($document);
```
#### PF - Dados de Sites [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsDomains)
Domínios de internet conhecidos para um CPF.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->domains($document);
```
#### PF - E-mails [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsEmails)
Endereços eletrônicos conhecidos para um CPF.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->email($document);
```
#### PF - Endereços físicos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsAddresses)
Endereços físicos conhecidos para um CPF com classificação para endereços de trabalho e casa.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->addresses($document);
```
#### PF - Exposição e Perfil na Mídia [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsMediaExposure)
Exposição e perfil definidos em diversas mídias.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->mediaExposure($document);
```
#### PF - Indicadores e Características [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsFlagsAndFeatures)
Indicadores e características de atividades financeiras pela WEB.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->flagsAndFeatures($document);
```
#### PF - Informações Financeiras [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsFinancial)
Informações financeiras de IR.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->financial($document);
```

#### PF - Interesses e Comportamentos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsDemographic)
A consulta retorna informações relacionadas com comportamentos ou com o interesse em determinadas categorias de produtos e serviços.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->interests($document);
```
#### PF - Informações de KYC [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsKyc)
Dados de Interpol e Ofac para homônimos e similaridades.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->kyc($document);
```
#### PF - Passagens pela Web [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsWebPassages)
Dados de passagens reconhecidas pela WEB como passagens suspeitas. 
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->webPassages($document);
```
#### PF - Presença Online [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsOnlinePresence)
Informações de presença online que definem a utilização da internet.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->onlinePresence($document);
```
#### PF - Presença em Cobrança [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsRecurrencyToCharging)
Dados de presença em cobranças por empresas, definindo os níveis de encontrabilidade por endereços, e-mails e telefones, por exemplo.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->recurrencyToCharging($document);
```
#### PF - Processos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsProcesses)
Dados de processos conhecidos através do CPF oriundos dos tribunais regionais. 
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->processes($document);
```
#### PF - Programas de Benefícios e Assistência Social [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsSocialAssistences)
Informações de participação em programas de benefícios como o bolsa-família.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->socialAssistences($document); 
```
#### PF - Relacionamentos Econômicos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsBusiness)
Informações sobre relacionamentos econômicos.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->businessRelationships($document);
```
#### PF - Relacionamentos Pessoais [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsNearbyRelationships)
Relacionamentos em torno do CPF como familiares, vizinhos e colegas de trabalho.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->nearbyRelationships($document);
```
#### PF - Telefones [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsPhones)
Dados de telefones associados ao CPF consultado.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->phones($document);
```
#### PF - Veículos [#](https://api.fincore.co/doc/#api-PF-outsourcingPersonsVehicles)
 Dados de veículos registrados para o CPF informado.
```
<?php
require 'vendor/autoload.php';

$pf = new \Fincore\PF();
$pf->vehicles($document);
```
### Pessoa Jurídica [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesAds)
#### PJ - Anúncios Online
Consulta com informações relacionadas dos anuncios postados pela empresa consultado nos principais marketplaces e portais de anúncios da internet. 
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->ads($document);

```
#### PJ - Dados Cadastrais Básicos [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesBasic)
Consulta contém o conjunto mais simples de informações dentre todos os datasets, com informações cadastrais recuperadas de fontes oficiais .
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->basic($document)
```
#### PJ - Dados de Sites [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesDomains)
Consulta retorna informações dos sites e domínios que estão associados com a entidade consultada, seja através do registro de domínios ou através de informações contidas dentro do próprio conteúdo do site.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->domains($document)
```
#### PJ - E-mails [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesEmails)
Consulta retorna não só os e-mails relacionados com a entidade consultada, como também uma série de qualificadores desse relacionamento, tais como quantas vezes o e-mail foi visto para aquela entidade, e quantas vezes foi visto associado com outras entidades.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> emails($document)
```
#### PJ - Endereços [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesAddresses)
A consulta retorna não só os endereços relacionados com a entidade consultada, como também uma série de qualificadores desse relacionamento, tais como quantas vezes o endereço foi visto para aquela entidade, e quantas vezes foi visto associado com outras entidades.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> Addresses($document)
```
#### PJ - Exposição e Perfil na Mídia [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesMediaExposure)
Exposição e perfil definidos em diversas mídias.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->mediaExposure($document);
```
#### PJ - Grupos Econômicos [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesEconomicGroups)
```
Os dados retornam informações agrupadas e agregadas do grupo econômico relacionado com a empresa principal sendo consultada, em todas as direções.
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->EconomicGroups($document);
```
####PJ - Indicadores de Atividade [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesactivity_indicators)
Indicadores e características de atividades financeiras pela WEB.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> activityIndicators($document);
```
#### PJ - Processos [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesProcesses)
Os Processos Judiciais e Administrativos retorna informações, tanto atuais quanto históricas, do envolvimento da entidade consultada em ações judiciais de todos os tipos (civil, trabalhista, criminal, etc).
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj-> Processes($document);
```
#### PJ - Relacionamentos [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesRelationships)
Consulta retorna informações sobre outras entidades, sejam elas pessoas ou empresas, que estão relacionadas com a empresa consultada.
```
<?php
require 'vendor/autoload.php';

$pj = new \Fincore\PJ();
$pj->relationships($document);
```
#### PJ - Telefones [#](https://api.fincore.co/doc/#api-PJ-outsourcingCompaniesPhones)
Dados de telefones associados ao CNPJ consultado.
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
