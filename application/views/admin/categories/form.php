<?php /* admin/categories/form.php */
$is_edit = !empty($cat);
$action  = $is_edit ? base_url('admin/categories/update/' . $cat['id']) : base_url('admin/categories/store');
?>
<div class="admin-card" style="max-width:560px;">
  <div class="admin-card-header"><h3><?php echo $page_title; ?></h3></div>
  <div class="admin-card-body">
    <?php echo form_open($action); ?>

      <!-- Category Name -->
      <div class="form-group">
        <label class="form-label">Category Name <span class="req">*</span></label>
        <input type="text" name="name" id="catName" class="form-control" required
               value="<?php echo set_value('name', $is_edit ? htmlspecialchars($cat['name']) : ''); ?>"
               placeholder="e.g. खेल (Sports)">
      </div>

      <!-- Custom Slug Toggle -->
      <div class="form-group" style="background:#f8faff; border:1px solid #d0d8e8; border-radius:6px; padding:14px 16px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0;" id="slugToggleRow">
          <div>
            <label style="font-weight:600; font-size:13px; color:#0f1f3d; cursor:pointer;" for="have_custom_slug">
              <i class="fas fa-link" style="margin-right:6px; color:#1a3a6b;"></i> Custom Slug
            </label>
            <div style="font-size:11px; color:#888; margin-top:2px;">
              Useful when category name is in Hindi — set a clean English slug manually.
            </div>
          </div>
          <!-- Toggle switch -->
          <label class="slug-switch">
            <input type="checkbox" name="have_custom_slug" id="have_custom_slug" value="1"
                   <?php echo $is_edit && $cat['have_custom_slug'] ? 'checked' : ''; ?>
                   onchange="toggleSlugField(this)">
            <span class="slug-slider"></span>
          </label>
        </div>

        <!-- Slug input — shown only when toggle is ON -->
        <div id="slugFieldWrap" style="margin-top:12px; display:<?php echo $is_edit && $cat['have_custom_slug'] ? 'block' : 'none'; ?>;">
          <label class="form-label" style="margin-bottom:4px;">
            Slug <span class="req">*</span>
            <span style="font-weight:400; color:#888; font-size:11px; margin-left:6px;">
              (lowercase letters, numbers, hyphens only — no spaces)
            </span>
          </label>
          <div style="display:flex; align-items:center; gap:0;">
            <span style="background:#e8edf5; border:1.5px solid #d0d8e8; border-right:none; border-radius:6px 0 0 6px; padding:9px 12px; font-size:12px; color:#888; white-space:nowrap;">
              /category/
            </span>
            <input type="text" name="custom_slug" id="custom_slug" class="form-control"
                   style="border-radius:0 6px 6px 0; border-left:none;"
                   value="<?php echo set_value('custom_slug', $is_edit ? htmlspecialchars($cat['slug']) : ''); ?>"
                   placeholder="e.g. sports, crime, health">
          </div>
          <div class="form-hint" style="margin-top:5px;">
            Example: for category "खेल" enter <strong>sports</strong>, for "क्राइम" enter <strong>crime</strong>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Color</label>
          <input type="color" name="color" class="form-control"
                 value="<?php echo $is_edit ? $cat['color'] : '#1a3a6b'; ?>"
                 style="height:42px; padding:4px;">
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control"
                 value="<?php echo set_value('sort_order', $is_edit ? $cat['sort_order'] : 0); ?>">
        </div>
      </div>

      <?php if ($is_edit): ?>
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" name="is_active" id="is_active" value="1"
                 <?php echo $cat['is_active'] ? 'checked' : ''; ?>>
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

<script>
  function toggleSlugField(cb) {
    document.getElementById('slugFieldWrap').style.display = cb.checked ? 'block' : 'none';
    if (!cb.checked) {
      document.getElementById('custom_slug').value = '';
    }
  }
</script>
