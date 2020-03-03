<?php

use App\UserModule;
use App\Module;

$oModules = Module::where('status', 1)->where('deleted', 0)->orderBy('id', 'asc')->get();
$aParams = array();
if (Auth::user()->role->code != 'admin') {
    $aParams['iUserId'] = Auth::user()->id;
}
$oUserModuleResponse = UserModule::getUserModule($aParams);
?>
<!-- Left side column. contains the logo and sidebar -->


<style>
    .skin-black .sidebar-menu>li:hover>a, .skin-black .sidebar-menu>li.active>a {
        color: #fff;
        background: gainsboro!important;
        border-left-color: #fff !important;
    }

</style>

<div class="divider" style=" background-color:  #cd0011;
height: 3px; width: 1550px; margin-top: 52px"></div>
  <!-- <div class="divider" style=" background-color:  #8B008B   ;
      height: 5px; width: 1550px; margin-top: 2px;"></div> -->

      <aside class="main-sidebar" style="background-color: #DCDCDC !important; margin-top: 58px;">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" >

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info" style="color: #cd0011; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
                    <p style="color:#cd0011;   font-size: 18px;  ">{{ Auth::user()->firstName }}  {{ Auth::user()->lastName }}</p>
                    <i class="fa fa-circle text-success" ></i>  Online
                </div>
            </div>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" style="margin-top: -5px;"> 
             


                <!-- Optionally, you can add icons to the links -->
                <!-- Admin Links Start-->

                <li>
                    <a href="{{ url('admin/dashboard') }}" style=" font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' " onmouseover="this.background-color='maroon'" onmouseleave="this.background-color='gainsboro'">
                        <i class="fa fa-dashboard" ></i> <span>Dashboard</span>
                    </a>
                </li>
                <hr style="background-color: #cd0011; height: 1px;">
                <?php if (Auth::user()->role->code == 'admin') { ?>

<!--                 <li class="treeview">
                    <a href="{{ url('admin/modules') }}">
                        <i class="fa fa-list"></i> <span>Modules</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('admin/modules') }}"><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                        <li><a href="{{ url('admin/modules/create/') }}"><i class="fa fa-circle-o"></i> <span>Create</span></a></li>
                        <li><a href="{{ url('admin/modules/assign/') }}"><i class="fa fa-circle-o"></i> <span>Assign</span></a></li>
                    </ul>
                </li> -->
                
                <li class="treeview" style="background-color: #DCDCDC; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
                    <a href="{{ url('admin/users') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' " onmouseover="this.background-color='maroon'" onmouseleave="this.background-color='gainsboro'">
                        <i class="fa fa-users"></i> <span>Users</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="background-color: #DCDCDC; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;" >
                        <li><a href="{{ url('admin/users') }}"style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' " 
                           ><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                           <li><a href="{{ url('admin/users/create/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;"
                              
                              onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "
                              ><i class="fa fa-circle-o"></i> <span>Create</span></a></li>
                          </ul>
                      </li>
                      <hr style="background-color: #cd0011; height: 1px;">
                  <?php } ?>
                  
                  <li class="treeview" style="background-color: #DCDCDC; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;" >
                    <a href="{{ url('admin/templates') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' " onmouseover="this.background-color='maroon'" onmouseleave="this.background-color='gainsboro'">
                        <i class="fa fa-list"></i> <span>Templates</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="background-color: #DCDCDC; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; ">
                        <li><a href="{{ url('admin/templates') }}" style="color: #2F4F4F;font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'" ><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                        <?php if (Auth::user()->role->code == 'admin') { ?>
                            <li><a href="{{ url('admin/templates/create/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #2F4F4F;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>Create</span></a></li>
                            <li><a href="{{ url('admin/templates/assign/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>Assign</span></a></li>
                            
                        <?php } ?>
                    </ul>
                </li>
                <hr style="background-color: #cd0011; height: 1px;">
                
            <!--<?php
            if (!empty($oModules)) {
                foreach ($oModules as $oModule) {
                    if (Auth::user()->role->code == 'admin') {
                        ?>
                        @include('admin.commons.sidebar_menu')
                        <?php
                    } else {
                        if (!empty($oUserModuleResponse)) {
                            foreach ($oUserModuleResponse as $value) {
                                if ($value->id == $oModule->id || $value->id == $oModule->parent_id) {
                                    ?>
                                    @include('admin.commons.sidebar_menu')
                                    <?php
                                }
                            }
                        }
                    }
                }
            }
            ?> -->
            <?php if (Auth::user()->role->code == 'admin') { ?>
                <li class="treeview" style="background-color: #DCDCDC;">
                    <a href="{{ url('admin/events/tracking/mixpanel') }}" style="color: #2F4F4F;font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'">
                        <i class="fa fa-bell-o"></i> <span>Sent Notices</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="background-color: #DCDCDC;">
                        <li><a href="{{ url('admin/notifications') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                    </ul>
                </li>
                <hr style="background-color: #cd0011; height: 0.5px;">
                <li class="treeview" style="background-color: #DCDCDC;">
                    <a href="{{ url('admin/templates') }}" style="color: #2F4F4F;font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'">
                        <i class="fa fa-envelope"></i> <span>Emails</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="background-color: #DCDCDC;">
                        <li><a href="{{ url('admin/emails') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                        <li><a href="{{ url('admin/emails/create/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>Create</span></a></li>
                        <li><a href="{{ url('admin/emails/assign/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>Assign</span></a></li>
                    </ul>
                </li>
                <hr style="background-color: #cd0011; height: 0.5px;">
                <li class="treeview" style="background-color: #DCDCDC;">
                    <a href="{{ url('admin/email-configuration') }}" style="color: #2F4F4F;font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'">
                        <i class="fa fa-envelope"></i> <span>Email Configuration</span> 
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="background-color: #DCDCDC;">
                        <li><a href="{{ url('admin/email-configurations') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>List</span></a></li>
                        <li><a href="{{ url('admin/email-configurations/create/') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;color: #696969;"onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F' "><i class="fa fa-circle-o"></i> <span>Create</span></a></li>
                    </ul>
                </li>


            <?php } ?>
            
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
