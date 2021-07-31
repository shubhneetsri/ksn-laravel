<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Student\StudentClassDetail;
use App\Models\Student\Student;
use App\User;
use Auth;
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

        $response1 = $this->call('GET', '/add-student');
        $response2 = $this->get('/student-list');
        $response3 = $this->get('/student-list?page=100');
        $response4 = $this->get('/student-list?by=reg_number&sort=asc&page=1');
        $response5 = $this->get('/student-list?by=father_name&sort=asc&page=1');
        $response6 = $this->get('/student-list?by=caste&sort=asc&page=1');
        
        $response1->assertStatus(200);
        $response2->assertStatus(200);
        $response3->assertStatus(200);
        $response4->assertStatus(200);
        $response5->assertStatus(200);
        $response6->assertStatus(200);
    }

    /**I am shearing my example code with you. 
     * A student's table test.
     *
     * @return void
     */
    public function testStudentDatabase()
    {
        $user = factory(StudentClassDetail::class, 1)->create();
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
            'username' => 'System Test', //$this->faker->name,
            'user_type' => '1',
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['M', 'F']),//the gender does not match the name as it is.
            'father_name' => $this->faker->name,
            'mother_name' => $this->faker->name,
            'caste' => $this->faker->randomElement(['GEN','SC','ST','OBC']),
            'phone' => mt_rand(91111111111, 99999999999),
            'dob' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'doj' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->address,
            'current_address' => $this->faker->address,
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

    /**
     * A Student edit test.
     * 
     * @return void
     */
    public function testStudentEdit(){

        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated

        $user = new Student();
        $data = $user->first();
        $user = factory(StudentClassDetail::class, 1)->create();
        $userCount = count($user) == 1; // check entries count
        $response = $this->call('GET', 'add-student'.'/'.$data->id);

        // Assert true
        $response->assertStatus(200);
    }

     /**
     * A Student update test.
     * 
     * @return void
     */
    public function testStudentUpdate(){

        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated

        $user = new Student();
        $dummy_user = factory(StudentClassDetail::class, 1)->create();
        $data = $user->GetStudent($dummy_user[0]->student_id);
  
        $post = [
            'class_id' => $data['admission_class_id'],
            'username' => $data['user']['name'], //$this->faker->name,
            'user_type' => $data['user']['user_type'],
            'email' => $data['user']['email'],
            'gender' => $data['user']['gender'],
            'father_name' => $data['father_name'],
            'mother_name' => $data['mother_name'],
            'caste' => $data['caste'],
            'phone' => $data['user']['phonenumber'],
            'dob' => $data['user']['dob'],
            'doj' => $data['user']['date_of_join'],
            'address' => $data['user']['address'],
            'current_address' => $data['current_address'],
            'academic_year_id' => $data['academic_year_id'],
            'reg_number' => $data['reg_number'],
            'state' => $data['user']['state_id'],
            'city' => $data['user']['city_id']
        ];
        
        $response = $this->call('POST', '/add-student'.'/'.$data['id'], $post)->assertRedirect('/student-list');
    }

    /**
     * Test delete student
     * 
     * @return void
     */
    public function testStudentDelete(){

        $user = new User(array('name' => 'John'));
        $this->be($user); //You are now authenticated

        $dummy_user = factory(StudentClassDetail::class, 1)->create();

        $response = $this->from('student-list')->get('/student-destroy'.'/'.$dummy_user[0]->student_id)->assertRedirect('student-list');;

    }

}
