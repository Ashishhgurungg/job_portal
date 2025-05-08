<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AddJobPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_page_does_not_open_for_guest(): void
    {
        $response = $this->get('/add-job');

        $response->assertStatus(302); //assert redirection

        $response->assertRedirect('/login'); //assert we are taken to login page
    }

    public function test_page_opens_for_auth_company_user(): void
    {
        $user = User::factory()->create(['role' => 1]);//create company user

        $response = $this->actingAs($user)->get('/add-job');

        // dd($response);

        $response->assertStatus(200);
    }

    public function test_page_does_not_open_for_auth_non_company_user(): void
    {
        $user = User::factory()->create(['role' => 0]); //create admin user

        $response = $this->actingAs($user)->get('/add-job');

        // dd($response);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create(['role' => 2]); //create normal user

        $response = $this->actingAs($user)->get('/add-job');

        // dd($response);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_does_not_submit_for_invalid_data(): void
    {
        $user = User::factory()->create(['role'=>1]); // we can use create to create real data to be saved in database and use make so it doesn't gets saved in the database
        $response = $this->actingAs($user)->post('/add-job'. [
            'title' => '',
            'category' => '',
            'type' => '',
            'salary' => '20/01/2020',
            'deadline' => '',
            'description' => '']);
        
        $response->assertStatus(302);
        $response = assertSessionErrors(['title','category','type','salary','deadline','description']);
        // $view = $this->view('add_job');
        // $response = assertRedirect('/add-job'); //commenting this because we need to go to form first

        // $response->assertSee('');// this is for general with html tags
       // $response->assertSeeText('The title field is required'); // this is for specific , like plain text
    }

    public function test_page_submits_for_valid_data(): void
    {
        $user = User::factory()->create(['role'=>1]);
        $response = $this->actingAs($user)->post('/add-job'. [
            'title' => 'HR',
            'category' => '3',
            'type' => 'Remote',
            'salary' => '50000',
            'deadline' => '01/01/2026',
            'description' => 'test job']); // in this these are fields name because form is being submitted so we wrote category
        
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $response = $this->get('Dashboard');
        $response = assertSee('Job added successfully');
        // $response = assertDontsee('Job failed');
        $response->assertSee('Job added successfully');

        $response->assertDatabaseHas('vacancies',
        [
            'title' => 'HR',
            'category_id' => '3',
            'type' => 'Remote',
            'salary' => '50000',
            'deadline' => '01/21/2026',
            'description' => 'test job'
        ]);//in this case field names are column names of table because we are checking the database so we wrote category_id
        //vacancies is the table name

        //note:: we can write make instead of create , but for databsae test we need to write create,
        //create will create a real data and make will make a dummy data

        

        }
        public function deletes_the_job(): void{
            //login as company user --- update form --
        }
}
