<?php /* admin/banners/form.php */
$is_edit = !empty($banner);
$action  = $is_edit ? base_url('admin/banners/update/' . $banner['id']) : base_url('admin/banners/store');
?>
<div class="admin-card" style="max-width:640px;">
  <div class="admin-card-header"><h3><?php echo $page_title; ?></h3></div>
  <div class="admin-card-body">
    <?php echo form_open_multipart($action); ?>
      <div class="form-group">
        <label class="form-label">Title <span class="req">*</span></label>
        <input type="text" name="title" class="form-control" required value="<?php echo set_value('title', $is_edit ? htmlspecialchars($banner['title']) : ''); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" value="<?php echo set_value('subtitle', $is_edit ? htmlspecialchars($banner['subtitle'] ?? '') : ''); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Link URL</label>
        <input type="url" name="link_url" class="form-control" placeholder="https://..." value="<?php echo set_value('link_url', $is_edit ? $banner['link_url'] ?? '' : ''); ?>">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Position</label>
          <select name="position" class="form-control">
            <option value="homepage_slider" <?php echo ($is_edit && $banner['position'] === 'homepage_slider') ? 'selected' : ''; ?>>Homepage Slider</option>
            <option value="sidebar"         <?php echo ($is_edit && $banner['position'] === 'sidebar') ? 'selected' : ''; ?>>Sidebar</option>
            <option value="footer"          <?php echo ($is_edit && $banner['position'] === 'footer') ? 'selected' : ''; ?>>Footer</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="<?php echo $is_edit ? $banner['sort_order'] : 0; ?>">
        </div>
      </div>
      <?php if ($is_edit): ?>
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo $banner['is_active'] ? 'checked' : ''; ?>>
          <label for="is_active">Active</label>
        </div>
      </div>
      <?php endif; ?>
      <div class="form-group">
        <label class="form-label">Image <?php echo !$is_edit ? '<span class="req">*</span>' : ''; ?></label>
        <?php if ($is_edit && $banner['image']): ?>
          <img src="<?php echo base_url('assets/uploads/banners/' . $banner['image']); ?>" style="width:100%; max-height:180px; object-fit:cover; border-radius:6px; margin-bottom:10px;">
        <?php endif; ?>
        <input type="file" name="image" class="form-control" accept="image/*" data-preview="bannerPrev" <?php echo !$is_edit ? 'required' : ''; ?>>
        <img id="bannerPrev" class="img-preview" style="display:none;" alt="">
        <div class="form-hint">Slider: 1200×500px recommended. Max 2MB.</div>
      </div>
      <div style="display:flex; gap:10px;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Banner</button>
        <a href="<?php echo base_url('admin/banners'); ?>" class="btn btn-secondary">Cancel</a>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
