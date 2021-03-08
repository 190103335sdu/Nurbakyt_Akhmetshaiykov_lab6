<?php

use Illuminate\Support\Facades\Route;

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

/*Raw sql start*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function () {
    DB::insert('insert into student(name,date_of_birth,GPA,advisor) values(?,?,?,?)',
    ['Ali','2000-10-12','3.25','Ualikhan']);
});

Route::get('/select', function () {
    $result =DB::select('select * from student where id=?',[1]);
    foreach($result as $student){
        echo "Name: ".$student->name."<br>";
        echo "Date of birth: ".$student->date_of_birth."<br>";
        echo "GPA: ".$student->GPA."<br>";
        echo "Advisor: ".$student->advisor."<br>";
    }
});

Route::get('/update', function () {
    $updated=DB::update('update student set GPA="3.5" where id=?',[1]);
    return $updated;
});

Route::get('/delete', function () {
    $deleted=DB::delete('delete from student where id=?',[2]);
    return $deleted;
});
/*Raw sql end*/


/*By Model start*/
use App\Models\Student;
Route::get('/modelSelect',function(){
    $student=Student::find(1);
    echo "Name: ".$student->name."<br>";
    echo "Date of birth: ".$student->date_of_birth."<br>";
    echo "GPA: ".$student->GPA."<br>";
    echo "Advisor: ".$student->advisor."<br>";
});

Route::get('/modelInsert',function(){
    $student=new Student;
    $student->name='Arsen';
    $student->date_of_birth='2002-03-03';
    $student->GPA='3.0';
    $student->advisor='Kuanish';
    $student->save();
});

Route::get('/modelUpdate',function(){
    $student=Student::find(1);
    $student->GPA='3.9';
    $student->advisor='Kuanish';
    $student->save();
});

Route::get('/modelDelete', function () {
    Student::where('id',1)->delete();
});
/*By Model end*/


