<?php

use Illuminate\Support\Facades\Route;

use App\Models\Student;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//insert data
Route::get('/insert', function () {
    DB::insert('insert into students(name,date_of_birth,gpa,advisor) values(?,?,?,?)',['Islam','2002-07-02',3.5,'Jangir']);
});

Route::get('/select', function () {
    $result = DB::select('select * from students where id=?',[1]);
    foreach ($result as $student) {
    	echo "student name is: ". $student->name;
    	echo "<br>";
    	echo "date of birth: ". $student->date_of_birth;
    	echo "<br>";
    	echo "gpa: ". $student->gpa;
    	echo "<br>";
    	echo "advisor name is: ". $student->advisor;
    }
});

Route::get('/update', function () {
    $updated=DB::update('update students set gpa=4.0 where id=?',[2]);
    return $updated;
});

Route::get('/delete', function () {
    $deleted=DB::delete('delete from students where id=?',[1]);
    return $deleted;
});


Route::get('/insert_with_Model',function(){
    $student = new Student;
    $student->name='Alshyn';
    $student->date_of_birth = '2002-02-07';
    $student->gpa = 3.8;
    $student->advisor = 'Kurmangazy';
    $student->save();
});

Route::get('/update_with_Model',function(){
    $student = Student::find(2);
    $student->advisor = 'Marjan';
    $student->save();
});


Route::get('/delete_with_Model',function(){
    $student = Student::find(2);
    $student->delete();
});

Route::get('/select_with_Model',function(){
    $student = Student::where('id',2)->first();
    return $student;
});
