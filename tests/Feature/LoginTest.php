<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class LoginTest extends TestCase
{
    /**
     * A basic login url test example.
     *
     * @return void
     */
    public function testLoginURL()
    {
        $response = $this->call('GET', '/login');

        $this->assertEquals(200,$response->status());
    }

    public function testLoginBlankFields()
    {
        $data = [
            "email" => "",
            "password" => "",
        ];
    
        $response = $this->call('POST', 'login', $data)->assertRedirect('/');
        $this->assertFalse(Auth::check());
    
    }

    public function testLoginWrongValues()
    {
        $data = [
            "email" => "fvb",
            "password" => "mdfvbdfvb",
        ];
    
        $response = $this->call('POST', 'login', $data)->assertRedirect('/');
        $this->assertFalse(Auth::check());

    }

    public function testLoginMisMatchData()
    {
        $data = [
            "email" => "shubhneet@gmail.com",
            "password" => "fjhgdfg",
        ];
    
        $response = $this->call('POST', 'login', $data)->assertRedirect('/');
        $this->assertFalse(Auth::check());

    }

    public function testLoginValid()
    {
        $data = [
            "email" => "shubhneet@gmail.com",
            "password" => "111111",
        ];
    
        $response = $this->call('POST', 'login', $data);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());

    }
}
