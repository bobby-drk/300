<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class LedgerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_create_a_ledger_with_valid_data()
    {
        //Given -  valid ledger data
        //create 2 users to besure they are in the DB
        $users = factory(App\Models\User::class, 4)->create();

        $ledger = [
            "debtor" => [$users[1]->id, $users[2]->id, $users[3]->id],
            "credit_type" => "food",
            "amount" => "8.00",
        ];

        //When - url is hit
        $response = $this->getJson('/api/v1/ledger/record?api_token='. $users[0]->api_token, 'POST', $ledger);

        //Then - a ledger is create in the db
        $this->seeInDatabase('ledger', ['debtor' => $users[1]->id, 'amount' => 2.00, "credit_type" => "food"]);
        $this->seeInDatabase('ledger', ['debtor' => $users[2]->id, 'amount' => 2.00, "credit_type" => "food"]);
        $this->seeInDatabase('ledger', ['debtor' => $users[3]->id, 'amount' => 2.00, "credit_type" => "food"]);

        //Then - a 201 status is returned
        $this->assertResponseStatus(201);
    }

    /** @test */
    public function it_will_respond_with_a_400_if_data_does_not_validate()
    {
        //Given -  valid ledger data
        //create 2 users to besure they are in the DB
        $users = factory(App\Models\User::class, 2)->make();
        $users = $users->each(function($user)
        {
            $user->save();
        });

        $ledger = [
            "debtor" => $users[1]->id,
            "credit_type" => "pets",
            "amount" => "5.00",
        ];

        //When - url is hit
        $response = $this->getJson('/api/v1/ledger/record?api_token='. $users[0]->api_token, 'POST', $ledger);

       //Then - a 201 status is returned
        $this->assertResponseStatus(400);

    }

}