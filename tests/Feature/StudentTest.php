<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use App\User;
use App\Models\Student\Student;
use Str;

class StudentTest extends TestCase
{
    use WithFaker;

    /**
     * A basic route test.
     *
     * @return void
     */
    public function testStudentUrl()
    {

        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated

        $response = $this->call('GET', '/add-student');
        $response = $this->get('/student-list');

        $response->assertStatus(200);
    }

    /**
     * A student's table test.
     *
     * @return void
     */
    public function testStudentDatabase()
    {
        $user = factory(Student::class, 1)->create();
        $userCount = count($user) == 1; // check entries count

        // Assert true
        $this->assertTrue($userCount);
    }

    /**
     * A Student store test.
     * 
     * @return void
     */
    public function testStudentAdd(){

        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated
        
        $data = [
            'class_id' => 1,
            'username' => 'NARULA', //$this->faker->name,
            'user_type' => '1',
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['M', 'F']),//the gender does not match the name as it is.
            'phone' => mt_rand(91111111111, 99999999999),
            'dob' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->address,
            'academic_year_id' => $this->faker->randomElement(['1', '2']),
            'admission_class_id' => $this->faker->randomElement([1,2,3,4,5]),
            'reg_number' => Str::random(10),
            'state' => 1,
            'city' => 1,
            'password' => '123456', // password
            'reenter_password' => '123456', // password
            'remember_token' => Str::random(10),
        ];
    
        $response = $this->call('POST', '/add-student', $data)->assertRedirect('/student-list');
    }

}
