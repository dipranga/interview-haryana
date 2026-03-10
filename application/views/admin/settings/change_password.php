<?php /* admin/settings/change_password.php */ ?>
<div class="admin-card" style="max-width:700px;">
  <div class="admin-card-header"><h3><i class="fas fa-cog"></i> Change Password</h3></div>
  <div class="admin-card-body">
    <?php echo form_open('admin/Auth/change_password_post'); ?>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Current Password</label>
          <input type="password" name="current_password" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">New Password</label>
          <input type="password" name="new_password" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Confirm New Password</label>
          <input type="password" name="confirm_password" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="margin-top:8px;"><i class="fas fa-save"></i> Change Password </button>
    <?php echo form_close(); ?>
  </div>
</div>
