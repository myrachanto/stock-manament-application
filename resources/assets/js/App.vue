<template>
<div id="root">
<div class="spac">
<nav class="navbar navbar-fixed-top">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle btnab" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                     
  
      </button>
      <a class="navbar-brand" href="#">Stock Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><img :src="'img/special/email.gif'" alt="messages" width="15" height="15">messages<span class="badge">5</span></a></li>
          </ul>
        </div>
</nav></div>
<div id="about" class="container-fluid carodiv1">
<table class="table  table-striped">
      <tr>
       <td class="col-sm-2 sydmenu" valign="top">
      <table class="table table-striped">
      <tr>
      <td><router-link to="/"><div><img :src="'img/comment.png'" alt="Dashboard" width="50" height="50">Dashboard</div></router-link></td></tr><tr>
      <td><router-link to="/product"><div><img :src="'img/accounts/inventory.jpg'" alt="Dashboard" width="50" height="50">Stock</div></router-link></td></tr><tr>
      <td><router-link to="/customer"><div><img :src="'img/eplo.jpg'" alt="Dashboard" width="50" height="50">Customers</div></router-link></td></tr><tr>
      <td><router-link to="/supplier"><div><img :src="'img/index.jpg'" alt="Dashboard" width="50" height="50">Suppliers</div></router-link></td></tr><tr> 
      <td><router-link to="/employee"><div><img :src="'img/customers.jpg'" alt="Dashboard" width="50" height="50">Employees</div></router-link></td></tr><tr>
      <td><router-link to="/"><div><img :src="'img/repor.jpg'" alt="Dashboard" width="50" height="50">Accounts</div></router-link></td></tr><tr>
      <td><router-link to="/"><div><img :src="'img/accounts/finance2.jpg'" alt="Dashboard" width="50" height="50">Reports</div></router-link></td></tr><tr>
      <td><router-link to="/"><div><img :src="'img/imag3.jpg'" alt="Dashboard" width="50" height="50">Settings</div></router-link></td>
      </tr>
      </table></td>
      <td class="col-sm-10" valign="top">


<router-view></router-view>
</td></tr></table>
</div>
</div>
</template>  