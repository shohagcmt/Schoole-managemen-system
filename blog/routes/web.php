<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Default\DefaultController;

use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;   
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentFeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentFeeCategoryAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\StudentSubjectController;
use App\Http\Controllers\Backend\Setup\StudentAssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Employees\EmployeesRegController;
use App\Http\Controllers\Backend\Employees\EmployeesSalaryController;
use App\Http\Controllers\Backend\Employees\EmployeesLeaveController;
use App\Http\Controllers\Backend\Employees\EmployeesAttendanceController;
use App\Http\Controllers\Backend\Marks\StudentMarksController;
use App\Http\Controllers\Backend\Marks\StudentGradeMarksController;


Route::get('/', function () {
    return view('backend.layouts.master');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user
Route::prefix('/user')->group(function(){
    Route::get('/student/view',[StudentClassController::class,'view'])->name('registration.student.view');
    Route::get('/student/add',[StudentClassController::class,'add'])->name('registration.student.add');
    Route::post('/student/store',[StudentClassController::class,'store'])->name('registration.student.store');
    Route::get('/student/edit/{id}',[StudentClassController::class,'edit'])->name('registration.student.edit');
    Route::post('/student/update/{id}',[StudentClassController::class,'update'])->name('registration.student.update');
    Route::get('/student/delete/{id}',[StudentClassController::class,'delete'])->name('registration.student.delete');
   
});

//setups
Route::prefix('setups')->group(function(){
    //Student Class
    Route::get('/student/class/view',[StudentClassController::class,'view'])->name('setups.student.class.view');
    Route::get('/student/class/add',[StudentClassController::class,'add'])->name('setups.student.class.add');
    Route::post('/student/class/store',[StudentClassController::class,'store'])->name('setups.student.class.store');
    Route::get('/student/class/edit/{id}',[StudentClassController::class,'edit'])->name('setups.student.class.edit');
    Route::post('/student/class/update/{id}',[StudentClassController::class,'update'])->name('setups.student.class.update');
    Route::get('/student/class/delete/{id}',[StudentClassController::class,'delete'])->name('setups.student.class.delete');
    
    //student year
    Route::get('/student/year/view',[StudentYearController::class,'view'])->name('setups.student.year.view');
    Route::get('/student/year/add',[StudentYearController::class,'add'])->name('setups.student.year.add');
    Route::post('/student/year/store',[StudentYearController::class,'store'])->name('setups.student.year.store');
    Route::get('/student/year/edit/{id}',[StudentYearController::class,'edit'])->name('setups.student.year.edit');
    Route::post('/student/year/update/{id}',[StudentYearController::class,'update'])->name('setups.student.year.update');
    Route::get('/student/year/delete/{id}',[StudentYearController::class,'delete'])->name('setups.student.year.delete');
    
    //student group
    Route::get('/student/group/view',[StudentGroupController::class,'view'])->name('setups.student.group.view');
    Route::get('/student/group/add',[StudentGroupController::class,'add'])->name('setups.student.group.add');
    Route::post('/student/group/store',[StudentGroupController::class,'store'])->name('setups.student.group.store');
    Route::get('/student/group/edit/{id}',[StudentGroupController::class,'edit'])->name('setups.student.group.edit');
    Route::post('/student/group/update/{id}',[StudentGroupController::class,'update'])->name('setups.student.group.update');
    Route::get('/student/group/delete/{id}',[StudentGroupController::class,'delete'])->name('setups.student.group.delete');
    
    //student shift
    Route::get('/student/shift/view',[StudentShiftController::class,'view'])->name('setups.student.shift.view');
    Route::get('/student/shift/add',[StudentShiftController::class,'add'])->name('setups.student.shift.add');
    Route::post('/student/shift/store',[StudentShiftController::class,'store'])->name('setups.student.shift.store');
    Route::get('/student/shift/edit/{id}',[StudentShiftController::class,'edit'])->name('setups.student.shift.edit');
    Route::post('/student/shift/update/{id}',[StudentShiftController::class,'update'])->name('setups.student.shift.update');
    Route::get('/student/shift/delete/{id}',[StudentShiftController::class,'delete'])->name('setups.student.shift.delete');
     
    //student fee category
    Route::get('/student/fee/category/view',[StudentFeeCategoryController::class,'view'])->name('setups.student.fee.category.view');
    Route::get('/student/fee/category/add',[StudentFeeCategoryController::class,'add'])->name('setups.student.fee.category.add');
    Route::post('/student/fee/category/store',[StudentFeeCategoryController::class,'store'])->name('setups.student.fee.category.store');
    Route::get('/student/fee/category/edit/{id}',[StudentFeeCategoryController::class,'edit'])->name('setups.student.fee.category.edit');
    Route::post('/student/fee/category/update/{id}',[StudentFeeCategoryController::class,'update'])->name('setups.student.fee.category.update');
    Route::get('/student/fee/category/delete/{id}',[StudentFeeCategoryController::class,'delete'])->name('setups.student.fee.category.delete');
      
    //student fee category
    Route::get('/student/fee/amount/view',[StudentFeeCategoryAmountController::class,'view'])->name('setups.student.fee.amount.view');
    Route::get('/student/fee/amount/add',[StudentFeeCategoryAmountController::class,'add'])->name('setups.student.fee.amount.add');
    Route::post('/student/fee/amount/store',[StudentFeeCategoryAmountController::class,'store'])->name('setups.student.fee.amount.store');
    Route::get('/student/fee/amount/details/{student_fee_category_id}',[StudentFeeCategoryAmountController::class,'details'])->name('setups.student.fee.amount.details');
    Route::get('/student/fee/amount/edit/{student_fee_category_id}',[StudentFeeCategoryAmountController::class,'edit'])->name('setups.student.fee.amount.edit');
    Route::post('/student/fee/amount/update/{student_fee_category_id}',[StudentFeeCategoryAmountController::class,'update'])->name('setups.student.fee.amount.update');
    Route::get('/student/fee/amount/delete/{student_fee_category_id}',[StudentFeeCategoryAmountController::class,'delete'])->name('setups.student.fee.amount.delete');

    //student exam type
    Route::get('/exam/type/view',[ExamTypeController::class,'view'])->name('setups.exam.type.view');
    Route::get('/exam/type/add',[ExamTypeController::class,'add'])->name('setups.exam.type.add');
    Route::post('/exam/type/store',[ExamTypeController::class,'store'])->name('setups.exam.type.store');
    Route::get('/exam/type/edit/{id}',[ExamTypeController::class,'edit'])->name('setups.exam.type.edit');
    Route::post('/exam/type/update/{id}',[ExamTypeController::class,'update'])->name('setups.exam.type.update');
    Route::get('/exam/type/delete/{id}',[ExamTypeController::class,'delete'])->name('setups.exam.type.delete');
    
    //student subject
    Route::get('/subject/view',[StudentSubjectController::class,'view'])->name('setups.subject.view');
    Route::get('/subject/add',[StudentSubjectController::class,'add'])->name('setups.subject.add');
    Route::post('/subject/store',[StudentSubjectController::class,'store'])->name('setups.subject.store');
    Route::get('/subject/edit/{id}',[StudentSubjectController::class,'edit'])->name('setups.subject.edit');
    Route::post('/subject/update/{id}',[StudentSubjectController::class,'update'])->name('setups.subject.update');
    Route::get('/subject/delete/{id}',[StudentSubjectController::class,'delete'])->name('setups.subject.delete');
   
   //assign subject
   Route::get('/assign/subject/view',[StudentAssignSubjectController::class,'view'])->name('setups.assign.subject.view');
   Route::get('/assign/subject/add',[StudentAssignSubjectController::class,'add'])->name('setups.assign.subject.add');
   Route::post('/assign/subject/store',[StudentAssignSubjectController::class,'store'])->name('setups.assign.subject.store');
   Route::get('/assign/subject/details/{student_class_id}',[StudentAssignSubjectController::class,'details'])->name('setups.assign.subject.details');
   Route::get('/assign/subject/edit/{student_class_id}',[StudentAssignSubjectController::class,'edit'])->name('setups.assign.subject.edit');
   Route::post('/assign/subject/update/{student_class_id}',[StudentAssignSubjectController::class,'update'])->name('setups.assign.subject.update');
   Route::get('/assign/subject/delete/{student_class_id}',[StudentAssignSubjectController::class,'delete'])->name('setups.assign.subject.delete');
  
   //designation
   Route::get('/designation/view',[DesignationController::class,'view'])->name('setups.designation.view');
   Route::get('/designation/add',[DesignationController::class,'add'])->name('setups.designation.add');
   Route::post('/designation/store',[DesignationController::class,'store'])->name('setups.designation.store');
   Route::get('/designation/edit/{id}',[DesignationController::class,'edit'])->name('setups.designation.edit');
   Route::post('/designation/update/{id}',[DesignationController::class,'update'])->name('setups.designation.update');
   Route::get('/designation/delete/{id}',[DesignationController::class,'delete'])->name('setups.designation.delete');   
});

//registration
Route::prefix('/student')->group(function(){
    //Student registration
    Route::get('/registration/view',[StudentRegController::class,'view'])->name('student.registration.view');
    Route::get('/registration/add',[StudentRegController::class,'add'])->name('student.registration.add');
    Route::post('/registration/store',[StudentRegController::class,'store'])->name('student.registration.store');
    Route::get('/registration/edit/{id}/{student_id}',[StudentRegController::class,'edit'])->name('student.registration.edit');
    Route::post('/registration/update/{id}/{student_id}',[StudentRegController::class,'update'])->name('student.registration.update');
    Route::get('/registration/delete/{student_id}',[StudentRegController::class,'delete'])->name('student.registration.delete');
    //Search Class-Year
    Route::get('/search-student-Class-Year',[StudentRegController::class,'searchClassYear'])->name('student.registration.search.class.year');
    //Promotion
    Route::get('/registration/promotion/{student_id}',[StudentRegController::class,'promotion'])->name('student.registration.promotion');
    Route::post('/registration/Promotion/store/{student_id}',[StudentRegController::class,'promotionStore'])->name('student.registration.promotion.store');
    //details + pdf file
    Route::get('/registration/details/{student_id}',[StudentRegController::class,'details_pdfFile'])->name('student.registration.details');
   
    //Student Roll generate
    Route::get('/roll/view',[StudentRollController::class,'view'])->name('student.roll.view');
    Route::post('/roll/get_student',[StudentRollController::class,'getStudent'])->name('student.roll.get_student'); 
    Route::post('/roll/store',[StudentRollController::class,'store'])->name('student.roll.store');
   
    //Student registration fee
    Route::get('/registration/fee/view',[StudentRegistrationFeeController::class,'view'])->name('student.registration.fee.view');
    Route::post('/registration/fee/get_Student',[StudentRegistrationFeeController::class,'getStudent'])->name('student.registration.fee.get_Student');

    Route::post('/registration/fee/payslip',[StudentRegistrationFeeController::class,'paySlip'])->name('student.registration.fee.payslip');
});

//user employees
Route::prefix('/employees')->group(function(){
    //employees Registration
    Route::get('/reg/view',[EmployeesRegController::class,'view'])->name('employees.reg.view');
    Route::get('/reg/add',[EmployeesRegController::class,'add'])->name('employees.reg.add');
    Route::post('/reg/store',[EmployeesRegController::class,'store'])->name('employees.reg.store');
    Route::get('/reg/edit/{id}',[EmployeesRegController::class,'edit'])->name('employees.reg.edit');
    Route::post('/reg/update/{id}',[EmployeesRegController::class,'update'])->name('employees.reg.update');
    Route::get('/reg/details/{id}',[EmployeesRegController::class,'details_pdfFile'])->name('employees.reg.details');
    Route::get('/reg/delete/{id}',[EmployeesRegController::class,'delete'])->name('employees.reg.delete');
    
    //Salary increment
    Route::get('/salary/view',[EmployeesSalaryController::class,'view'])->name('employees.salary.view');
    Route::get('/salary/increment/{id}',[EmployeesSalaryController::class,'increment'])->name('employees.salary.increment');
    Route::post('/salary/store/{id}',[EmployeesSalaryController::class,'store'])->name('employees.salary.store');
    Route::get('/salary/details/{id}',[EmployeesSalaryController::class,'salary_details'])->name('employees.salary.details');
    Route::get('/salary/delete/{id}',[EmployeesSalaryController::class,'delete'])->name('employees.salary.delete');

    //employees Leave
    Route::get('/leave/view',[EmployeesLeaveController::class,'view'])->name('employees.leave.view');
    Route::get('/leave/add',[EmployeesLeaveController::class,'add'])->name('employees.leave.add');
    Route::post('/leave/store',[EmployeesLeaveController::class,'store'])->name('employees.leave.store');
    Route::get('/leave/edit/{id}',[EmployeesLeaveController::class,'edit'])->name('employees.leave.edit');
    Route::post('/leave/update/{id}',[EmployeesLeaveController::class,'update'])->name('employees.leave.update');

    //employees Leave
    Route::get('/attendance/view',[EmployeesAttendanceController::class,'view'])->name('employees.attendance.view');
    Route::get('/attendance/add',[EmployeesAttendanceController::class,'add'])->name('employees.attendance.add');
    Route::post('/attendance/store',[EmployeesAttendanceController::class,'store'])->name('employees.attendance.store');
    Route::get('/attendance/edit/{id}',[EmployeesAttendanceController::class,'edit'])->name('employees.attendance.edit');
    Route::post('/attendance/update/{id}',[EmployeesAttendanceController::class,'update'])->name('employees.attendance.update');
    Route::get('/attendance/delete/{id}',[EmployeesAttendanceController::class,'delete'])->name('employees.attendance.delete');
 
});


Route::prefix('/studentmarke')->group(function(){
    //Student Marke entry
    Route::get('/marks/add',[StudentMarksController::class,'add'])->name('student.marks.add');
    Route::post('/marks/store',[StudentMarksController::class,'store'])->name('student.marks.store');
    Route::get('/marks/edit',[StudentMarksController::class,'edit'])->name('student.marks.edit');
    Route::post('get/marks',[StudentMarksController::class,'getMarks'])->name('student.get.marks');
    Route::post('/marks/update/{id}',[StudentMarksController::class,'update'])->name('student.marks.update'); 
    
    //Grade Point
    Route::get('/grade/view',[StudentGradeMarksController::class,'view'])->name('student.marke.grade.view');
    Route::get('/grade/add',[StudentGradeMarksController::class,'add'])->name('student.marke.grade.add');
    Route::post('/grade/store',[StudentGradeMarksController::class,'store'])->name('student.marke.grade.store');
    Route::get('/grade/edit/{id}',[StudentGradeMarksController::class,'edit'])->name('student.marke.grade.edit');
    Route::post('/grade/update/{id}',[StudentGradeMarksController::class,'update'])->name('student.marke.grade.update'); 
});

Route::post('/get-student',[DefaultController::class,'getStudent'])->name('get-student');
Route::post('/get-subject',[DefaultController::class,'getSubject'])->name('get-subject');


