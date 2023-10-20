@php 
$prefix=Request::route()->getPrefix();
$route=Route::current()->getName();
@endphp 
 
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ (!empty(Auth::user()->image))?url('Backend/images/student/student_reg_images/'.Auth::user()->image):url('Backend/images/default_image/default_image.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu  -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
          </ul>
        </li>
         <!-- manage user-->
         <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage User
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View User</p>
              </a>
            </li>      
          </ul>
        </li>
        <!-- manage profile-->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Profile
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Your Profile</p>
              </a>
            </li>  
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>       
          </ul>
        </li>
        <!--Setup-->
        <li class="nav-item has-treeview {{ ($prefix=='/setups')?'menu-open':'' }}">
          <a href="#" class="nav-link {{ ($prefix=='/setups')?'active':'' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Setup
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('setups.student.class.view') }}" class="nav-link {{ ($route=='setups.student.class.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student class</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.student.year.view') }}" class="nav-link {{ ($route=='setups.student.year.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Year</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.student.group.view') }}" class="nav-link {{ ($route=='setups.student.group.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Group</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.student.shift.view') }}" class="nav-link {{ ($route=='setups.student.shift.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Shift</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.student.fee.category.view') }}" class="nav-link {{ ($route=='setups.student.fee.category.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Fee Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.student.fee.amount.view') }}" class="nav-link {{ ($route=='setups.student.fee.amount.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Fee Category Amount</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.exam.type.view') }}" class="nav-link {{ ($route=='setups.exam.type.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Exam Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.subject.view') }}" class="nav-link {{ ($route=='setups.subject.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Subject View</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.assign.subject.view') }}" class="nav-link {{ ($route=='setups.assign.subject.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Assign Subject</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('setups.designation.view') }}" class="nav-link {{ ($route=='setups.designation.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Designation</p>
              </a>
            </li>
          </ul>
        </li>

        <!--registration-->
        <li class="nav-item has-treeview {{ ($prefix=='/student')?'menu-open':'' }}">
          <a href="#" class="nav-link {{ ($prefix=='/student')?'active':'' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Students
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('student.registration.view') }}" class="nav-link {{ ($route=='student.registration.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Registration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student.roll.view') }}" class="nav-link {{ ($route=='student.roll.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Roll generate</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student.registration.fee.view') }}" class="nav-link {{ ($route=='student.registration.fee.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Registration Fee</p>
              </a>
            </li>
            
          </ul>
        </li>

        <!-- manage Employe-->
         <li class="nav-item has-treeview {{ ($prefix=='/employees')?'menu-open':'' }}">
          <a href="#" class="nav-link {{ ($prefix=='/employees')?'active':'' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Employees
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('employees.reg.view') }}" class="nav-link {{ ($route=='employees.reg.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employees Registration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.salary.view') }}" class="nav-link {{ ($route=='employees.salary.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employees Salary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.leave.view') }}" class="nav-link {{ ($route=='employees.leave.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employees Leave</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employees.attendance.view') }}" class="nav-link {{ ($route=='employees.attendance.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employees Attendance</p>
              </a>
            </li>
            
          </ul>
        </li>
         <!--Student Marke entry-->
        <li class="nav-item has-treeview {{ ($prefix=='/studentmarke')?'menu-open':'' }}">
          <a href="#" class="nav-link {{ ($prefix=='/studentmarke')?'active':'' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Markes 
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('student.marks.add') }}" class="nav-link {{ ($route=='student.marks.add')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Markes Entry</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student.marks.edit') }}" class="nav-link {{ ($route=='student.marks.edit')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Markes Edit</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student.marke.grade.view') }}" class="nav-link {{ ($route=='student.marke.grade.view')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Grade Point</p>
              </a>
            </li>
            
          </ul>
        </li>

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>