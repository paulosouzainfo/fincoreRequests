<?php
namespace Fincore\Test;

final class PFTest extends \PHPUnit\Framework\TestCase
{
    private $pf;
    private $cpf;

    protected function setup(): void
    {
        $this->pf  = new \Fincore\PF();
        $this->cpf = preg_replace("/[^0-9]/", "", getenv('CPF'));
    }

    public function testAds(): void
    {
        $request = $this->pf->ads($this->cpf);
        $this->assertEquals(200, $request->http_status);
    }

    public function testBasic(): void
    {
        $request = $this->pf->basic($this->cpf);

        $this->assertEquals(200, $request->http_status);

        $this->assertEquals(
            $this->cpf,
            preg_replace("/[^0-9]/",
                "",
                $request->response->document
            )
        );

        $this->assertNotEmpty($request->response->TaxIdCountry);
        $this->assertNotEmpty($request->response->TaxIdCountry);
        $this->assertNotEmpty($request->response->Gender);
        $this->assertNotEmpty($request->response->Age);
        $this->assertNotEmpty($request->response->ZodiacSign);
        $this->assertNotEmpty($request->response->ChineseSign);
        $this->assertNotEmpty($request->response->TaxIdOrigin);
        $this->assertNotEmpty($request->response->BirthCountry);
        $this->assertNotEmpty($request->response->BirthDate);
    }

    public function testMemberships(): void
    {
        $request = $this->pf->memberships($this->cpf);

        $this->assertEquals(200, $request->http_status);

        if (isset($request->response->Memberships)) {
            foreach ($request->response->Memberships as $application) {

                $arrayMemberships = (array) $application;

                $this->assertArrayHasKey('OrganizationName', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationCountry', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationType', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationChapter', $arrayMemberships);
                $this->assertArrayHasKey('RegistrationId', $arrayMemberships);
                $this->assertArrayHasKey('Category', $arrayMemberships);
                $this->assertArrayHasKey('Status', $arrayMemberships);

                $this->assertNOtEmpty($application->OrganizationName);
                $this->assertNOtEmpty($application->OrganizationCountry);
                $this->assertNOtEmpty($application->OrganizationType);
                $this->assertNOtEmpty($application->OrganizationChapter);
                $this->assertNOtEmpty($application->Category);

                $this->assertEquals('NORMAL', $application->Status);
            }

            $this->assertEquals(
                $this->cpf,
                preg_replace("/[^0-9]/",
                    "",
                    $request->response->document
                ));
        }
    }

    public function testPublicProfessions(): void
    {
        $this->cpf = preg_replace("/[^0-9]/", "", $this->cpf);

        $request = $this->pf->publicProfessions($this->cpf);

        $responseArray = (array) $request->response;

        $this->assertEquals(200, $request->http_status);
        $this->assertEquals(
            $this->cpf,
            preg_replace('/[^0-9]/',
                '',
                $request->response->document
            )
        );
        $this->assertArrayHasKey('TotalProfessions', $responseArray);
        $this->assertArrayHasKey('TotalActiveProfessions', $responseArray);
        $this->assertArrayHasKey('TotalIncome', $responseArray);
        $this->assertArrayHasKey('TotalIncomeRange', $responseArray);
        $this->assertArrayHasKey('IsEmployed', $responseArray);
        $this->assertArrayHasKey('updatedAt', $responseArray);
        $this->assertArrayHasKey('createdAt', $responseArray);
        $this->assertArrayHasKey('document', $responseArray);
        $this->assertArrayHasKey('_id', $responseArray);
    }

    public function testProfessions(): void
    {
        $request = $this->pf->professions($this->cpf);

        $this->assertEquals(200, $request->http_status);

        $this->assertEquals(
            $this->cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response->document
            )
        );
    }

    public function testUniversityStudents(): void
    {
        $request = $this->pf->universityStudents($this->cpf);

        $this->assertEquals(200, $request->http_status);

        $this->assertEquals(
            $this->cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response->document
            )
        );

        $this->assertNotEmpty($request->response->ScholarshipLevel);
    }

    public function testDomains(): void
    {
        $request = $this->pf->domains($this->cpf);

        $this->assertEquals(200, $request->http_status);

        if (!empty($request->response)) {
            foreach ($request->response as $application) {
                //loop
                $Domains = (array) $application;

                $this->assertArrayHasKey('HostName', $Domains);
                $this->assertArrayHasKey('DomainName', $Domains);
                $this->assertArrayHasKey('DomainClass', $Domains);
                $this->assertArrayHasKey('ServerTechnology', $Domains);
                $this->assertArrayHasKey('Framework', $Domains);
                $this->assertArrayHasKey('PageCountRange', $Domains);
                $this->assertArrayHasKey('IspCountry', $Domains);
                $this->assertArrayHasKey('IspRegion', $Domains);
                $this->assertArrayHasKey('IspCity', $Domains);
                $this->assertArrayHasKey('AnalyticsServices', $Domains);
                $this->assertArrayHasKey('IsActive', $Domains);
                $this->assertArrayHasKey('HasSsl', $Domains);
                $this->assertArrayHasKey('RegistrationDate', $Domains);
                $this->assertArrayHasKey('ExpirationDate', $Domains);
                $this->assertArrayHasKey('document', $Domains);

                $this->assertNotEmpty($Domains['DomainName']);
                $this->assertNotEmpty($Domains['FinalDomainName']);
                $this->assertNotEmpty($Domains['Framework']);
                $this->assertNotEmpty($Domains['DomainClass']);
                $this->assertNotEmpty($Domains['PageCountRange']);

                $this->assertEquals(
                    $this->cpf,
                    preg_replace("/[^0-9]/",
                        "",
                        $Domains['document']
                    )
                );
            }
        }
    }

    public function testEmails(): void
    {
        $request = $this->pf->email($this->cpf);

        if (sizeof($request->response)) {
            foreach ($request->response as $application) {
                $Email = (array) $application;

                $this->assertArrayHasKey('EmailAddress', $Email);
                $this->assertArrayHasKey('Domain', $Email);
                $this->assertArrayHasKey('UserName', $Email);
                $this->assertArrayHasKey('Type', $Email);
                $this->assertArrayHasKey('IsRecent', $Email);
                $this->assertArrayHasKey('ValidationStatus', $Email);
                $this->assertArrayHasKey('FirstPassageDate', $Email);
                $this->assertArrayHasKey('document', $Email);

                $this->assertNotEmpty($Email['EmailAddress']);
                $this->assertNotEmpty($Email['Domain']);
                $this->assertNotEmpty($Email['UserName']);
                $this->assertNotEmpty($Email['Type']);
                $this->assertNotEmpty($Email['FirstPassageDate']);

                $this->assertEquals(false, $Email['IsRecent']);
                $this->assertEquals('VALID', $Email['ValidationStatus']);
                $this->assertEquals(200, $request->http_status);

                $this->assertEquals(
                    $this->cpf,
                    preg_replace("/[^0-9]/",
                        "", $Email['document']
                    )
                );
            }
        }
    }
    /*novo adicionado*/
    public function testAddresses(): void
    {
        $request = $this->pf->addresses($this->cpf);

        if (sizeof($request->response)) {
            foreach ($request->response as $application) {

                $addresses = (array) $application;

                $this->assertArrayHasKey('Typology', $addresses);
                $this->assertArrayHasKey('Title', $addresses);
                $this->assertArrayHasKey('AddressMain', $addresses);
                $this->assertArrayHasKey('Number', $addresses);
                $this->assertArrayHasKey('Complement', $addresses);
                $this->assertArrayHasKey('Neighborhood', $addresses);
                $this->assertArrayHasKey('ZipCode', $addresses);
                $this->assertArrayHasKey('City', $addresses);
                $this->assertArrayHasKey('State', $addresses);
                $this->assertArrayHasKey('Country', $addresses);
                $this->assertArrayHasKey('Type', $addresses);

                $this->assertNotEmpty($addresses['Priority']);

                $this->assertInternalType('bool', $addresses['IsRecent']);
                $this->assertInternalType('bool', $addresses['IsRecent']);
            }

            $this->assertEquals(
                $this->cpf,
                preg_replace("/[^0-9]/",
                    "",
                    $addresses['document']
                )
            );
            $this->assertEquals(200, $request->http_status);
        }
    }

    public function testMediaExposure(): void
    {
        $request       = $this->pf->mediaExposure($this->cpf);
        $arrayExposure = (array) $request->response;

        $this->assertArrayHasKey('MediaExposureLevel', $arrayExposure);
        $this->assertArrayHasKey('CelebrityLevel', $arrayExposure);
        $this->assertArrayHasKey('UnpopularityLevel', $arrayExposure);

        $this->assertEquals(
            $this->cpf,
            preg_replace("/[^0-9]/",
                "",
                $arrayExposure['document']
            )
        );

        $this->assertEquals(200, $request->http_status);
    }

    public function testFlagsAndFeatures(): void
    {
        $request = $this->pf->flagsAndFeatures($this->cpf);

        if (sizeof($request->response)) {
            foreach ($request->response as $application) {

                $Features = (array) $application;

                $this->assertArrayHasKey('ModelDescription', $Features);
                $this->assertArrayHasKey('ModelName', $Features);
                $this->assertArrayHasKey('ModelRating', $Features);
                $this->assertArrayHasKey('ModelScore', $Features);
                $this->assertArrayHasKey('CalculationDate', $Features);
                $this->assertArrayHasKey('ReferenceDate', $Features);

                $this->assertNotEmpty($Features['ModelDescription']);
                $this->assertNotEmpty($Features['ModelName']);
                $this->assertNotEmpty($Features['ModelRating']);
                $this->assertNotEmpty($Features['ModelScore']);
                $this->assertNotEmpty($Features['CalculationDate']);
                $this->assertNotEmpty($Features['ReferenceDate']);
            }
        }

        $this->assertEquals(
            $this->cpf,
            preg_replace("/[^0-9]/",
                "",
                $Features['document']
            )
        );
        $this->assertEquals(200, $request->http_status);
    }

    public function testFinancial(): void
    {
        $request = $this->pf->financial($this->cpf);

        if (!empty($request->response)) {

            foreach ($request->response->TaxReturns as $application) {

                $financial = (array) $application;

                $this->assertArrayHasKey('Year', $financial);
                $this->assertArrayHasKey('Bank', $financial);
                $this->assertArrayHasKey('Branch', $financial);
                $this->assertArrayHasKey('Batch', $financial);
                $this->assertArrayHasKey('IsVipBranch', $financial);

                $this->assertNotEmpty($financial['Year']);
                $this->assertInternalType('bool', $financial['IsVipBranch']);

            }
            $this->assertNotEmpty($request->response->TotalAssets);

            $this->assertEquals(200, $request->http_status);
        }

    }

    public function testDemographic(): void
    {

        $request = $this->pf->Demographic($this->cpf);

        if (!empty($request->response)) {
            foreach ($request->response as $application) {

                $Demographic = (array) $application;

                $this->assertArrayHasKey('DataOrigin', $Demographic);
                $this->assertArrayHasKey('DataAgregationLevel', $Demographic);
                $this->assertArrayHasKey('DataCountry', $Demographic);
                $this->assertArrayHasKey('EstimatedIncomeRange', $Demographic);
                $this->assertArrayHasKey('EstimatedInstructionLevel', $Demographic);
                $this->assertArrayHasKey('SocialClass', $Demographic);

                $this->assertNotEmpty($Demographic['DataOrigin']);
                $this->assertNotEmpty($Demographic['DataAgregationLevel']);
                $this->assertNotEmpty($Demographic['DataCountry']);
             }

            $this->assertEquals(200, $request->http_status);
        }
    }

    public function testKyc(): void
    {
        $request = $this->pf->kyc($this->cpf);

        if (!empty($request->response)) {
            foreach ($request->response->SanctionsHistory as $application) {

                $kyc = (array) $application;

                $this->assertArrayHasKey('Source', $kyc);
                $this->assertArrayHasKey('Type', $kyc);
                $this->assertArrayHasKey('MatchRate', $kyc);
                $this->assertArrayHasKey('NameUniquenessScore', $kyc);
                $this->assertArrayHasKey('Details', $kyc);

                $this->assertNotEmpty($kyc['Details']->OriginalName);
                $this->assertNotEmpty($kyc['Details']->SanctionName);
                $this->assertNotEmpty($kyc['Details']->SanctionName);

            }
        }

        $this->assertEquals(200, $request->http_status);
    }

    public function testInterests(): void
    {
        $request = $this->pf->interests($this->cpf);
        $this->assertEquals(200, $request->http_status);
    }

    public function testWebPassages(): void
    {
        $request     = $this->pf->webPassages($this->cpf);
        $webPassages = (array) $request->response;

        $this->assertArrayHasKey('TotalPassages', $webPassages);
        $this->assertArrayHasKey('BadPassages', $webPassages);
        $this->assertArrayHasKey('CrawlingPassages', $webPassages);
        $this->assertArrayHasKey('ValidationPassages', $webPassages);
        $this->assertArrayHasKey('QueryPassages', $webPassages);
        $this->assertArrayHasKey('MonthAveragePassages', $webPassages);
        $this->assertArrayHasKey('NumberOfEmails', $webPassages);
        $this->assertArrayHasKey('NumberOfPhones', $webPassages);
        $this->assertArrayHasKey('NumberOfAddresses', $webPassages);

        $this->assertArrayHasKey('FirstPassageDate', $webPassages);
        $this->assertArrayHasKey('LastPassageDate', $webPassages);
        $this->assertArrayHasKey('updatedAt', $webPassages);
        $this->assertArrayHasKey('createdAt', $webPassages);

        $this->assertInternalType('int', $webPassages['TotalPassages']);
        $this->assertInternalType('int', $webPassages['BadPassages']);
        $this->assertInternalType('int', $webPassages['CrawlingPassages']);
        $this->assertInternalType('int', $webPassages['ValidationPassages']);
        $this->assertInternalType('int', $webPassages['QueryPassages']);
        $this->assertInternalType('int', $webPassages['NumberOfEmails']);
        $this->assertInternalType('int', $webPassages['NumberOfPhones']);
        $this->assertInternalType('int', $webPassages['NumberOfAddresses']);

        $this->assertNotEmpty($webPassages['FirstPassageDate']);
        $this->assertNotEmpty($webPassages['LastPassageDate']);
        $this->assertNotEmpty($webPassages['updatedAt']);
        $this->assertNotEmpty($webPassages['createdAt']);

        $this->assertEquals(200, $request->http_status);
    }

    public function testOnlinePresence(): void
    {
        $request        = $this->pf->onlinePresence($this->cpf);
        $OnlinePresence = (array) $request->response;

        $this->assertArrayHasKey('Eshopper', $OnlinePresence);
        $this->assertArrayHasKey('Eseller', $OnlinePresence);
        $this->assertArrayHasKey('InternetUsageLevel', $OnlinePresence);
        $this->assertArrayHasKey('WebPassages', $OnlinePresence);
        $this->assertArrayHasKey('LastUpdateDate', $OnlinePresence);
        $this->assertArrayHasKey('LastUpdateDate', $OnlinePresence);
        $this->assertArrayHasKey('createdAt', $OnlinePresence);
        $this->assertArrayHasKey('document', $OnlinePresence);

        $this->assertNotEmpty($OnlinePresence['Eshopper']);
        $this->assertNotEmpty($OnlinePresence['Eseller']);
        $this->assertNotEmpty($OnlinePresence['InternetUsageLevel']);
        $this->assertNotEmpty($OnlinePresence['WebPassages']);
        $this->assertNotEmpty($OnlinePresence['LastUpdateDate']);
        $this->assertNotEmpty($OnlinePresence['LastUpdateDate']);
        $this->assertNotEmpty($OnlinePresence['createdAt']);
        $this->assertNotEmpty($OnlinePresence['document']);

        $this->assertEquals(200, $request->http_status);
    }

    public function testRecurrencyToCharging(): void
    {
        $request = $this->pf->recurrencyToCharging($this->cpf);

        $Recurrency = (array) $request->response;

        $this->assertArrayHasKey('CollectionOccurrences', $Recurrency);
        $this->assertArrayHasKey('CollectionOrigins', $Recurrency);
        $this->assertArrayHasKey('FirstCollectionDate', $Recurrency);
        $this->assertArrayHasKey('LastCollectionDate', $Recurrency);
        $this->assertArrayHasKey('CreationDate', $Recurrency);
        $this->assertArrayHasKey('LastUpdateDate', $Recurrency);
        $this->assertArrayHasKey('updatedAt', $Recurrency);
        $this->assertArrayHasKey('createdAt', $Recurrency);

        $this->assertInternalType('int', $Recurrency['CollectionOccurrences']);
        $this->assertInternalType('int', $Recurrency['CollectionOrigins']);

        $this->assertNotEmpty($Recurrency['FirstCollectionDate']);
        $this->assertNotEmpty($Recurrency['LastCollectionDate']);
        $this->assertNotEmpty($Recurrency['CreationDate']);
        $this->assertNotEmpty($Recurrency['LastUpdateDate']);
        $this->assertNotEmpty($Recurrency['updatedAt']);
        $this->assertNotEmpty($Recurrency['createdAt']);

        $this->assertEquals(200, $request->http_status);
    }

    public function testProcesses(): void
    {
        $request = $this->pf->processes($this->cpf);

        if (!empty($request->response)) {
            foreach ($request->response->Lawsuits as $application) {

                $Processes = (array) $application;

                $this->assertArrayHasKey('Number', $Processes);
                $this->assertArrayHasKey('Type', $Processes);
                $this->assertArrayHasKey('MainSubject', $Processes);
                $this->assertArrayHasKey('CourtName', $Processes);
                $this->assertArrayHasKey('CourtLevel', $Processes);
                $this->assertArrayHasKey('CourtType', $Processes);
                $this->assertArrayHasKey('CourtDistrict', $Processes);
                $this->assertArrayHasKey('JudgingBody', $Processes);
                $this->assertArrayHasKey('State', $Processes);
                $this->assertArrayHasKey('Status', $Processes);
                $this->assertArrayHasKey('NumberOfVolumes', $Processes);
                $this->assertArrayHasKey('NumberOfPages', $Processes);
                $this->assertArrayHasKey('Value', $Processes);
                $this->assertArrayHasKey('PublicationDate', $Processes);
                $this->assertArrayHasKey('NoticeDate', $Processes);
                $this->assertArrayHasKey('LastMovementDate', $Processes);
                $this->assertArrayHasKey('CaptureDate', $Processes);
                $this->assertArrayHasKey('LastUpdate', $Processes);
                $this->assertArrayHasKey('NumberOfParties', $Processes);
                $this->assertArrayHasKey('NumberOfUpdates', $Processes);
                $this->assertArrayHasKey('LawSuitAge', $Processes);
                $this->assertArrayHasKey('AverageNumberOfUpdatesPerMonth', $Processes);

                $this->assertNotEmpty($Processes['Number']);
                $this->assertNotEmpty($Processes['Type']);
                $this->assertNotEmpty($Processes['MainSubject']);
                $this->assertNotEmpty($Processes['CourtName']);
                $this->assertNotEmpty($Processes['CourtLevel']);
                $this->assertNotEmpty($Processes['CourtType']);
                $this->assertNotEmpty($Processes['CourtDistrict']);
                $this->assertNotEmpty($Processes['JudgingBody']);
                $this->assertNotEmpty($Processes['State']);
                $this->assertNotEmpty($Processes['Value']);
                $this->assertNotEmpty($Processes['PublicationDate']);
                $this->assertNotEmpty($Processes['NoticeDate']);
                $this->assertNotEmpty($Processes['LastMovementDate']);
                $this->assertNotEmpty($Processes['CaptureDate']);
                $this->assertNotEmpty($Processes['LastUpdate']);
                $this->assertNotEmpty($Processes['NumberOfParties']);
                $this->assertNotEmpty($Processes['NumberOfUpdates']);
                $this->assertNotEmpty($Processes['LawSuitAge']);
                $this->assertNotEmpty($Processes['AverageNumberOfUpdatesPerMonth']);

                $this->assertInternalType('int', $Processes['NumberOfVolumes']);

                if (!empty($Processes['Parties'])) {

                    foreach ($Processes['Parties'] as $Partie) {

                        $Parties = (array) $Partie;

                        $this->assertArrayHasKey('Doc', $Parties);
                        $this->assertArrayHasKey('Name', $Parties);
                        $this->assertArrayHasKey('Polarity', $Parties);
                        $this->assertArrayHasKey('Type', $Parties);
                        $this->assertNotEmpty($Parties['PartyDetails']->SpecificType);

                    }
                }
            }

            if (!empty($Processes['Updates'])) {

                foreach ($Processes['Updates'] as $Update) {

                    $Updates = (array) $Update;

                    $this->assertArrayHasKey('Content', $Updates);
                    $this->assertArrayHasKey('PublishDate', $Updates);
                    $this->assertArrayHasKey('CaptureDate', $Updates);

                    $this->assertNotEmpty($Updates['Content']);
                    $this->assertNotEmpty($Updates['PublishDate']);
                    $this->assertNotEmpty($Updates['CaptureDate']);
                }
            }
            $this->assertEquals(200, $request->http_status);
        }
    }

    public function testSocialAssistences(): void
    {
        $request = $this->pf->socialAssistences($this->cpf);

        if (!empty($request->response)) {

            $SocialAssistences = (array) $request->response;

            $this->assertArrayHasKey('TotalAssistances', $SocialAssistences);
            $this->assertArrayHasKey('TotalActiveAssistances', $SocialAssistences);
            $this->assertArrayHasKey('TotalAssiantaces', $SocialAssistences);
            $this->assertArrayHasKey('TotalIncome', $SocialAssistences);
            $this->assertArrayHasKey('TotalAmountReceived', $SocialAssistences);
            $this->assertArrayHasKey('TotalInstallmentsReceived', $SocialAssistences);
            $this->assertArrayHasKey('IsReceivingAssistance', $SocialAssistences);
            $this->assertArrayHasKey('updatedAt', $SocialAssistences);
            $this->assertArrayHasKey('createdAt', $SocialAssistences);

            $this->assertInternalType('int', $SocialAssistences['TotalAssistances']);
            $this->assertInternalType('int', $SocialAssistences['TotalActiveAssistances']);
            $this->assertInternalType('int', $SocialAssistences['TotalAssiantaces']);
            $this->assertInternalType('int', $SocialAssistences['TotalIncome']);
            $this->assertInternalType('int', $SocialAssistences['TotalAmountReceived']);
            $this->assertInternalType('int', $SocialAssistences['TotalInstallmentsReceived']);

            $this->assertInternalType('bool', $SocialAssistences['IsReceivingAssistance']);

            $this->assertNotEmpty($SocialAssistences['updatedAt']);
            $this->assertNotEmpty($SocialAssistences['createdAt']);
        }

        $this->assertEquals(200, $request->http_status);
    }

    public function testBusinessRelationships(): void
    {
        $request = $this->pf->businessRelationships($this->cpf);

        if (!empty($request->response)) {

            foreach ($request->response->BusinessRelationships as $application) {

                $Business = (array) $application;

                $this->assertArrayHasKey('RelationshipType', $Business);
                $this->assertArrayHasKey('RelationshipLevel', $Business);
                $this->assertArrayHasKey('RelationshipStartDate', $Business);
                $this->assertArrayHasKey('RelationshipEndDate', $Business);
                $this->assertArrayHasKey('CreationDate', $Business);
                $this->assertArrayHasKey('LastUpdateDate', $Business);

                $this->assertNotEmpty($Business['RelationshipType']);
                $this->assertNotEmpty($Business['RelationshipLevel']);
                $this->assertNotEmpty($Business['RelationshipStartDate']);
                $this->assertNotEmpty($Business['RelationshipEndDate']);
                $this->assertNotEmpty($Business['CreationDate']);
                $this->assertNotEmpty($Business['LastUpdateDate']);
            }

                $this->assertInternalType('int', $request->response->TotalRelationships);
                $this->assertInternalType('int', $request->response->TotalOwnerships);
                $this->assertInternalType('int', $request->response->TotalEmployments);
                $this->assertInternalType('int', $request->response->TotalPartners);
                $this->assertInternalType('int', $request->response->TotalClients);
                $this->assertInternalType('int', $request->response->TotalSuppliers);

                $this->assertNotEmpty($request->response->updatedAt);
                $this->assertNotEmpty($request->response->createdAt);

                $this->assertEquals(200, $request->http_status);
        }
    }

    public function testNearbyRelationships(): void
    {
        $request = $this->pf->nearbyRelationships($this->cpf);

        if (!empty($request->response)) {

            $Nearby = (array) $request->response;

            $this->assertArrayHasKey('TotalRelationships', $Nearby);
            $this->assertArrayHasKey('TotalRelatives', $Nearby);
            $this->assertArrayHasKey('TotalNeighbors', $Nearby);
            $this->assertArrayHasKey('TotalSpouses', $Nearby);
            $this->assertArrayHasKey('TotalCoworkers', $Nearby);
            $this->assertArrayHasKey('TotalHousehold', $Nearby);
            $this->assertArrayHasKey('TotalPartners', $Nearby);
            $this->assertArrayHasKey('updatedAt', $Nearby);
            $this->assertArrayHasKey('createdAt', $Nearby);

            $this->assertInternalType('int', $Nearby['TotalRelationships']);
            $this->assertInternalType('int', $Nearby['TotalRelatives']);
            $this->assertInternalType('int', $Nearby['TotalNeighbors']);
            $this->assertInternalType('int', $Nearby['TotalSpouses']);
            $this->assertInternalType('int', $Nearby['TotalCoworkers']);
            $this->assertInternalType('int', $Nearby['TotalHousehold']);
            $this->assertInternalType('int', $Nearby['TotalPartners']);

            $this->assertNotEmpty($request->response->updatedAt);
            $this->assertNotEmpty($request->response->createdAt);

            $this->assertEquals(200, $request->http_status);
        }
    }

    public function testPhones(): void
    {
        $request = $this->pf->phones($this->cpf);

        if (!empty($request->response)) {

            foreach ($request->response as $application) {

                $Phones = (array) $application;

                $this->assertArrayHasKey('Number', $Phones);
                $this->assertArrayHasKey('AreaCode', $Phones);
                $this->assertArrayHasKey('CountryCode', $Phones);
                $this->assertArrayHasKey('Complement', $Phones);
                $this->assertArrayHasKey('Type', $Phones);
                $this->assertArrayHasKey('PhoneTotalPassages', $Phones);
                $this->assertArrayHasKey('PhoneBadPassages', $Phones);
                $this->assertArrayHasKey('PhoneCrawlingPassages', $Phones);
                $this->assertArrayHasKey('PhoneValidationPassages', $Phones);
                $this->assertArrayHasKey('PhoneQueryPassages', $Phones);
                $this->assertArrayHasKey('PhoneMonthAveragePassages', $Phones);
                $this->assertArrayHasKey('Priority', $Phones);
                $this->assertArrayHasKey('IsMain', $Phones);
                $this->assertArrayHasKey('IsRecent', $Phones);
                $this->assertArrayHasKey('IsActive', $Phones);
                $this->assertArrayHasKey('IsInDoNotCallList', $Phones);
                $this->assertArrayHasKey('CurrentCarrier', $Phones);
                $this->assertArrayHasKey('PlanType', $Phones);
                $this->assertArrayHasKey('FirstPassageDate', $Phones);
                $this->assertArrayHasKey('LastPassageDate', $Phones);
                $this->assertArrayHasKey('CreationDate', $Phones);
                $this->assertArrayHasKey('LastUpdateDate', $Phones);

                $this->assertNotEmpty($Phones['Number']);
                $this->assertNotEmpty($Phones['AreaCode']);
                $this->assertNotEmpty($Phones['CountryCode']);
                $this->assertNotEmpty($Phones['Type']);
                $this->assertNotEmpty($Phones['Priority']);

                $this->assertInternalType('int', $Phones['PhoneTotalPassages']);
                $this->assertInternalType('int', $Phones['PhoneCrawlingPassages']);
                $this->assertInternalType('int', $Phones['PhoneBadPassages']);
                $this->assertInternalType('int', $Phones['PhoneQueryPassages']);
                $this->assertInternalType('int', $Phones['PhoneValidationPassages']);

                $this->assertInternalType('bool', $Phones['IsMain']);
                $this->assertInternalType('bool', $Phones['IsRecent']);
                $this->assertInternalType('bool', $Phones['IsActive']);
                $this->assertInternalType('bool', $Phones['IsInDoNotCallList']);

                $this->assertNotEmpty($Phones['FirstPassageDate']);
                $this->assertNotEmpty($Phones['LastPassageDate']);
                $this->assertNotEmpty($Phones['CreationDate']);
                $this->assertNotEmpty($Phones['LastUpdateDate']);
            }

            $this->assertEquals(200, $request->http_status);
        }

    }
    /*final de adicionados*/

    public function testvehicles(): void
    {
        $request = $this->pf->vehicles($this->cpf);
        $this->assertEquals(200, $request->http_status);
    }
}
