<?php /* admin/categories/form.php */
$is_edit = !empty($cat);
$action  = $is_edit ? base_url('admin/categories/update/' . $cat['id']) : base_url('admin/categories/store');
?>
<div class="admin-card" style="max-width:560px;">
  <div class="admin-card-header"><h3><?php echo $page_title; ?></h3></div>
  <div class="admin-card-body">
    <?php echo form_open($action); ?>
      <div class="form-group">
        <label class="form-label">Category Name <span class="req">*</span></label>
        <input type="text" name="name" class="form-control" required value="<?php echo set_value('name', $is_edit ? htmlspecialchars($cat['name']) : ''); ?>" placeholder="e.g. हरियाणा">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Color</label>
          <input type="color" name="color" class="form-control" value="<?php echo $is_edit ? $cat['color'] : '#e63946'; ?>" style="height:42px; padding:4px;">
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="<?php echo set_value('sort_order', $is_edit ? $cat['sort_order'] : 0); ?>">
        </div>
      </div>
      <?php if ($is_edit): ?>
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo $cat['is_active'] ? 'checked' : ''; ?>>
          <label for="is_active">Active</label>
        </div>
      </div>
      <?php endif; ?>
      <div style="display:flex; gap:10px;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        <a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-secondary">Cancel</a>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
