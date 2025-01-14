<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Teachers
            ['name' => "Maya", 'email' => 'maya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's0000001', 'role' => 'teacher'],
            ['name' => "Roy", 'email' => 'roy@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's0000002', 'role' => 'teacher'],
            ['name' => "Jomon", 'email' => 'jomon@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's0000003', 'role' => 'teacher'],
            ['name' => "Joy", 'email' => 'joy@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's0000004', 'role' => 'teacher'],
            ['name' => "Sindhu", 'email' => 'sindhu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's0000005', 'role' => 'teacher'],
            
            // Students
            ['name' => "Tom", 'email' => 'tom@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1000000', 'role' => 'student'],
            ['name' => "Appu", 'email' => 'appu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2000000', 'role' => 'student'],
            ['name' => "Melvin", 'email' => 'melvin@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3000000', 'role' => 'student'],
            ['name' => "Jimmy", 'email' => 'jimmy@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4000000', 'role' => 'student'],
            ['name' => "Jasmin", 'email' => 'jasmin@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's5000000', 'role' => 'student'],
            ['name' => "Chinnu", 'email' => 'chinnu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's6000000', 'role' => 'student'],
            ['name' => "Alen", 'email' => 'alen@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's7000000', 'role' => 'student'],
            ['name' => "Tony", 'email' => 'tony@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's8000000', 'role' => 'student'],
            ['name' => "Kingini", 'email' => 'kingini@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's9000000', 'role' => 'student'],
            ['name' => "Ron", 'email' => 'ron@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1100000', 'role' => 'student'],
            ['name' => "Anil", 'email' => 'anil@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1200000', 'role' => 'student'],
            ['name' => "Raj", 'email' => 'raj@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1300000', 'role' => 'student'],
            ['name' => "Neha", 'email' => 'neha@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1400000', 'role' => 'student'],
            ['name' => "Arya", 'email' => 'arya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1500000', 'role' => 'student'],
            ['name' => "Vijay", 'email' => 'vijay@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1600000', 'role' => 'student'],
            ['name' => "Rita", 'email' => 'rita@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1700000', 'role' => 'student'],
            ['name' => "Sandeep", 'email' => 'sandeep@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1800000', 'role' => 'student'],
            ['name' => "Tina", 'email' => 'tina@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's1900000', 'role' => 'student'],
            ['name' => "Biju", 'email' => 'biju@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2100000', 'role' => 'student'],
            ['name' => "Shyam", 'email' => 'shyam@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2200000', 'role' => 'student'],
            ['name' => "Nina", 'email' => 'nina@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2300000', 'role' => 'student'],
            ['name' => "Sujith", 'email' => 'sujith@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2400000', 'role' => 'student'],
            ['name' => "Liya", 'email' => 'liya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2500000', 'role' => 'student'],
            ['name' => "Kiran", 'email' => 'kiran@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2600000', 'role' => 'student'],
            ['name' => "Nishad", 'email' => 'nishad@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2700000', 'role' => 'student'],
            ['name' => "Manu", 'email' => 'manu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2800000', 'role' => 'student'],
            ['name' => "Priya", 'email' => 'priya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's2900000', 'role' => 'student'],
            ['name' => "Kavya", 'email' => 'kavya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3100000', 'role' => 'student'],
            ['name' => "Arun", 'email' => 'arun@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3200000', 'role' => 'student'],
            ['name' => "Roshan", 'email' => 'roshan@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3300000', 'role' => 'student'],
            ['name' => "Meera", 'email' => 'meera@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3400000', 'role' => 'student'],
            ['name' => "Jithin", 'email' => 'jithin@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3500000', 'role' => 'student'],
            ['name' => "Dhanya", 'email' => 'dhanya@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3600000', 'role' => 'student'],
            ['name' => "Abhi", 'email' => 'abhi@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3700000', 'role' => 'student'],
            ['name' => "Karthik", 'email' => 'karthik@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3800000', 'role' => 'student'],
            ['name' => "Rakesh", 'email' => 'rakesh@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's3900000', 'role' => 'student'],
            ['name' => "Anu", 'email' => 'anu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4100000', 'role' => 'student'],
            ['name' => "Ajith", 'email' => 'ajith@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4200000', 'role' => 'student'],
            ['name' => "Shweta", 'email' => 'shweta@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4300000', 'role' => 'student'],
            ['name' => "Vinu", 'email' => 'vinu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4400000', 'role' => 'student'],
            ['name' => "Gopu", 'email' => 'gopu@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4500000', 'role' => 'student'],
            ['name' => "Krishna", 'email' => 'krishna@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4600000', 'role' => 'student'],
            ['name' => "Salim", 'email' => 'salim@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4700000', 'role' => 'student'],
            ['name' => "Laila", 'email' => 'laila@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4800000', 'role' => 'student'],
            ['name' => "Basil", 'email' => 'basil@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's4900000', 'role' => 'student'],
            ['name' => "Sibi", 'email' => 'sibi@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's5100000', 'role' => 'student'],
            ['name' => "Fathima", 'email' => 'fathima@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's5200000', 'role' => 'student'],
            ['name' => "Mukesh", 'email' => 'mukesh@gmail.com', 'password' => bcrypt('qwertyui'),'s_number' => 's5300000', 'role' => 'student']

        ]);
    }
}
