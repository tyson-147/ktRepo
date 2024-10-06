<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ktTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('https://kurtosys.com/')
                    ->waitForText('INSIGHTS', 5)
                    ->assertSee('INSIGHTS')
                    ->mouseover(".kurtosys-menu-item:nth-child(3)")
                    ->clickAtXPath("/html/body/div[1]/div/section[1]/div/div/div[1]/div/div/div[2]/div/div/div/div/ul/li[3]/div/div/div/div/section/div/div/div/div/div/div/div/ul/li[3]/a")
                    ->waitForText('UCITS White Paper')
                    ->clickAtXPath('/html/body/div[2]/div/section[2]/div/div/div/div/div/div/div/div[1]/article[7]/div/div[1]/p/a')
                    ->waitForText('Accept All Cookies', 10)
                    ->clickAtXPath("//button[@id='onetrust-accept-btn-handler']");

            $browser->driver->switchTo()->frame(0);
            $browser->clickAtXPath('//*[@id="pardot-form"]/p[2]/input');
            sleep(1000);
            $browser->driver->switchTo()->defaultContent();
        });
    }
}
