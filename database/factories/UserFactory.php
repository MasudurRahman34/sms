<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\classes;
use App\User;
use App\model\Subject;
use App\model\Student;
use App\model\studentoptionalsubject;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

// $factory->define(schoolBranch::class, function (Faker $faker) {
//     return [
//         'brancheId' => rand(0,100),

//     ];
// });
$factory->define(classes::class, function (Faker $faker) {
    $numbersetone =$faker->numberBetween($min=1, $max=25);
    $numbersettwo =$faker->numberBetween($min=91, $max=115);
    return [
        'className' => $faker->randomElement(['One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten']),
        'duration' => '1 Year',
        'seat' => 100,
        'bId' => rand(0,30),


    ];
});



$group =array('General','Science','Arts','Commerce');
$factory->define(Subject::class, function (Faker $faker) {
    $numbersetone =$faker->numberBetween($min=101, $max=199);
    $class =$faker->numberBetween($min=13, $max=24);
    return [
        'subjectName' =>$faker->randomElement(['Bengali 1st Paper','Bengali 2nd Paper','English 1st Paper','English 2nd Paper','Mathematics','Higher Mathematics','Chemistry','Physics','Biology','Economics','History of Bangladesh','Islam and moral Education','Hindu Religion and moral Education','Business Initiative','Accounting','ICT','Geography and Environment','Agriculture','Home Science
        ','Sharirik Shikka and Shosto','Bangladesh and Global Studies','Civics and Good Citizenship','Finance and Banking
        ','']),
        'subjectCode' => $numbersetone,
        // 'classId' => $class,
        'classId' =>1,
        'group' =>$faker->randomElement(['General','Science','Arts','Commerce']),
        // 'bId' => rand(0,30),
        'bId' => 2,
        // 'optionalstatus' => rand(0,1),
        'optionalstatus' => 0,

    ];
});

$factory->define(Student::class, function (Faker $faker) {
    return [
        'studentId' =>rand(),
        'firstName' => $faker->firstname,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'mobile' => $faker->e164PhoneNumber ,
        'birthDate' => $faker->date($format = 'Y-m-d H:i:s', $max = '2012',$min = '1990'),
        'blood' => $faker->randomElement(['O+','O-','AB+','AB-','B+','B-','A+','A-']),
        'address' => $faker->address,
        'password' => bcrypt('12345678'),
        'readablePassword' => '12345678',
        'fatherName' => $faker->name,
        'motherName' => $faker->name,
        'fatherOccupation' => str_random(5),
        'MotherOccupation' => str_random(5),
        'fatherIncome' => rand(0,100000),
        'motherIncome' => rand(0,100000),
        'age' => rand(3,18),
        'roll' => rand(),
        'gender' =>  $faker->randomElement(['Male','Female']),
        'religion' => $faker->randomElement(['Islam','Hinduism','Buddhism','Christianity','Atheism']),
        'bId' =>1,
        'sectionId' =>4,
        'group' => $faker->randomElement(['General','Science','Arts','Commerce']),
        'schoolarshipId' =>0,
        'type' =>  'regular',
        // 'optionalSubjectId' => rand(0,1),
        'remember_token' => Str::random(10),

    ];
});
$factory->define(studentoptionalsubject::class, function (Faker $faker) {
    $numbersetone =$faker->numberBetween($min=1, $max=25);
    $numbersettwo =$faker->numberBetween($min=91, $max=115);
    return [
        'studentId' => $numbersettwo,
        'subjectId' => $numbersetone,
        'optional' => rand(0,1),
        'bId' => rand(1,1),


    ];
});


