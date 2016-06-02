<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_access_page_when_api_token_pass()
    {
        //given a valid user w/api_token
        $user = new User();
        $user->first_name = "Clark";
        $user->last_name = "Kent";
        $user->api_token = "Peomyp63Yvloh3qMFx5MWA89RFwmOkOI";
        $user->save();

        //when attempting to access secure page
         $this->visit('/scores?api_token='. $user->api_token )
            ->click('logout')
            ->seePageIs('/');
    }

    /** @test */
    public function it_cannot_access_page_without_token()
    {
         $this->visit('/scores')
            ->seePageIs('/');
    }


}