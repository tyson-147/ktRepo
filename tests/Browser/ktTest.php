<?php

namespace Tests\Browser;

//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Page_Elements\xpaths;

class ktTest extends DuskTestCase
{
    private $pageElements;

    public function __construct()
    {
        parent::__construct();
        $this->pageElements = new xpaths();
    }

    public function testKurtosys(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit(ENV('URL'))
                    ->waitForText('INSIGHTS', 5)
                    ->mouseover($this->pageElements->insightsHeader)
                    ->clickAtXPath($this->pageElements->whitePapeAndEbookMenu)
                    ->waitForText('UCITS White Paper')
                    ->clickAtXPath($this->pageElements->UCITSwhitePaper)
                    ->waitForText('Accept All Cookies', 10)
                    ->clickAtXPath($this->pageElements->acceptCookiesButton);

            $browser->driver->switchTo()->frame(0);

            $browser->waitForText('First Name', 5)
                     ->assertDontSee("This field is required")
                     ->type($this->pageElements->firstNameXpathInputValue, ENV('FIRST_NAME'))
                     ->type($this->pageElements->lastNameXpathInputValue, ENV('LAST_NAME'))
                     ->type($this->pageElements->companyNameXpathInputValue, ENV('COMPANY_NAME'))
                     ->type($this->pageElements->industryNameXpathInputValue, ENV('INDUSTRY_NAME'))
                     ->clickAtXPath($this->pageElements->sendMeCopyButton)
                     ->waitForText('This field is required.', 5)
                     ->screenshot("Error_Message")
                     ->assertSee("This field is required");

            sleep(5);
            $browser->driver->switchTo()->defaultContent();
        });
    }
}
