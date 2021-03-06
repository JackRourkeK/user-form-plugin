<?php
$args = array('role__not_in' => 'Administrator', 'number' => 10, 'orderby' => 'ID', 'order' => 'DESC');
$user_query = new WP_User_Query( $args );

$getRoles = array();

foreach (wp_roles()->role_objects as $roles) {
  $getRoles[] = $roles->name;
}

$is_admin = false;
if(is_user_logged_in()){
  if(wp_get_current_user()->roles[0]=='administrator'){
   $is_admin = true;
 }
}

// User Loop through the result
?>
<div>
  <h3>Users</h3> 
  <?php
  if($is_admin):
    ?>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addUser">Add User</button>
  <?php endif; ?>
</div>
<table class="table" id="usersList" style="border-top: 2px solid black !important">
  <thead>
   <tr>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
  </tr>
</thead>
<?php 
if ( ! empty( $user_query->get_results() ) ) { 
  foreach ( $user_query->get_results() as $user ) { ?>
   <tbody style="border-bottom: 2px solid black !important" >
    <tr>
     <td><?=$user->user_login?></td>
     <td><?=$user->user_email?></td>
     <td><?=$user->roles[0]?></td>
   </tr>
 </tbody>
<?php }
} else { ?>
  <tbody>
    <tr style="border: 2px solid black !important">
     <td colspan="3" id="no_user_exists">No Users Found.</td>
   </tr>
 </tbody>
<?php }?>
</table>

<!-- Modal -->
<div id="addUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Add New User</h4>
      </div>
      <div class="modal-body">
        <form id="user_form_submit" action="<?php echo plugin_dir_url( __FILE__ ).'user-form-submit.php' ?>" method="POST">
          <div class="container">
            <input type="hidden" id="action_url">
            <div class="form-group">
              <label for="user_name" class="col-form-label">Username:</label>
              <input type="text" class="form-control" name="user_name" id="user_name">
            </div>
            <div class="form-group">
              <label for="user_email" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name="user_email" id="user_email">
            </div>
            <div class="form-group">
              <label for="user_role" class="col-form-label">User Role:</label>
              <select class="custom-select" name="user_role" id="user_role">
                <?php foreach ($getRoles as $key => $role) {?>
                  <option value="<?php echo $role; ?>"><?php echo $role ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="saveUser">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>