<?php /* admin/news/form.php */
$is_edit = !empty($news);
$action  = $is_edit ? base_url('admin/news/update/' . $news['id']) : base_url('admin/news/store');
?>
<?php echo form_open_multipart($action); ?>
<div style="display:grid; grid-template-columns:1fr 320px; gap:20px;">

  <!-- LEFT: Content -->
  <div>
    <div class="admin-card">
      <div class="admin-card-header"><h3><i class="fas fa-<?php echo $is_edit ? 'edit' : 'plus'; ?>"></i> <?php echo $page_title; ?></h3></div>
      <div class="admin-card-body">
        <div class="form-group">
          <label class="form-label">Title <span class="req">*</span></label>
          <input type="text" name="title" class="form-control" required
                 value="<?php echo set_value('title', $is_edit ? htmlspecialchars($news['title']) : ''); ?>"
                 placeholder="Article title...">
        </div>
        <div class="form-group">
          <label class="form-label">Summary / Excerpt</label>
          <textarea name="summary" class="form-control" rows="3"
                    placeholder="Short summary shown on cards..."><?php echo set_value('summary', $is_edit ? htmlspecialchars($news['summary'] ?? '') : ''); ?></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Article Body <span class="req">*</span></label>
          <div class="form-hint" style="margin-bottom:6px;">Write plain text or paste HTML. Use &lt;p&gt;, &lt;h2&gt;, &lt;ul&gt;, &lt;blockquote&gt; etc.</div>
          <textarea name="body" class="form-control" rows="20"
                    placeholder="Write the full article here..."><?php echo set_value('body', $is_edit ? $news['body'] : ''); ?></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Tags</label>
          <input type="text" name="tags" class="form-control"
                 value="<?php echo set_value('tags', $is_edit ? htmlspecialchars($news['tags'] ?? '') : ''); ?>"
                 placeholder="tag1, tag2, tag3 (comma separated)">
          <div class="form-hint">Separate multiple tags with commas</div>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT: Meta -->
  <div>
    <div class="admin-card">
      <div class="admin-card-header"><h3><i class="fas fa-cog"></i> Publish Settings</h3></div>
      <div class="admin-card-body">
        <div class="form-group">
          <label class="form-label">Status <span class="req">*</span></label>
          <select name="status" class="form-control">
            <option value="draft"     <?php echo set_select('status', 'draft',     (!$is_edit || $news['status'] === 'draft')); ?>>Draft</option>
            <option value="published" <?php echo set_select('status', 'published', ($is_edit && $news['status'] === 'published')); ?>>Published</option>
            <option value="archived"  <?php echo set_select('status', 'archived',  ($is_edit && $news['status'] === 'archived')); ?>>Archived</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Category <span class="req">*</span></label>
          <select name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?php echo $cat['id']; ?>"
                <?php echo set_select('category_id', $cat['id'], ($is_edit && $news['category_id'] == $cat['id'])); ?>>
                <?php echo htmlspecialchars($cat['name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <div class="form-check" style="margin-bottom:10px;">
            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                   <?php echo ($is_edit && $news['is_featured']) ? 'checked' : ''; ?>>
            <label for="is_featured">⭐ Featured Article</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="is_breaking" id="is_breaking" value="1"
                   <?php echo ($is_edit && $news['is_breaking']) ? 'checked' : ''; ?>>
            <label for="is_breaking">🔴 Breaking News</label>
          </div>
        </div>
        <div style="display:flex; gap:10px;">
          <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center;">
            <i class="fas fa-save"></i> <?php echo $is_edit ? 'Update' : 'Publish'; ?>
          </button>
          <a href="<?php echo base_url('admin/news'); ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
        </div>
      </div>
    </div>

    <div class="admin-card">
  <div class="admin-card-header"><h3><i class="fas fa-images"></i> Article Images</h3></div>
  <div class="admin-card-body">
    <div class="form-hint" style="margin-bottom:12px;">JPG, PNG, WebP — Max 2MB. Recommended: 1200×675px</div>

    <div class="form-group" style="border-bottom:1px solid #eee; padding-bottom:15px; margin-bottom:15px;">
      <label class="form-label">Image 1 (Main)</label>
      <?php if ($is_edit && !empty($news['banner_image'])): ?>
        <img src="<?php echo base_url('assets/uploads/news/' . $news['banner_image']); ?>"
             style="width:100%; border-radius:6px; margin-bottom:10px;" alt="Current banner 1">
      <?php endif; ?>
      <input type="file" name="banner_image" class="form-control" accept="image/*" data-preview="bannerPreview1">
      <img id="bannerPreview1" class="img-preview" style="display:none;" alt="Preview">
    </div>

    <div class="form-group" style="border-bottom:1px solid #eee; padding-bottom:15px; margin-bottom:15px;">
      <label class="form-label">Image 2</label>
      <?php if ($is_edit && !empty($news['banner_image_2'])): ?>
        <img src="<?php echo base_url('assets/uploads/news/' . $news['banner_image_2']); ?>"
             style="width:100%; border-radius:6px; margin-bottom:10px;" alt="Current banner 2">
      <?php endif; ?>
      <input type="file" name="banner_image_2" class="form-control" accept="image/*" data-preview="bannerPreview2">
      <img id="bannerPreview2" class="img-preview" style="display:none;" alt="Preview">
    </div>

    <div class="form-group">
      <label class="form-label">Image 3</label>
      <?php if ($is_edit && !empty($news['banner_image_3'])): ?>
        <img src="<?php echo base_url('assets/uploads/news/' . $news['banner_image_3']); ?>"
             style="width:100%; border-radius:6px; margin-bottom:10px;" alt="Current banner 3">
      <?php endif; ?>
      <input type="file" name="banner_image_3" class="form-control" accept="image/*" data-preview="bannerPreview3">
      <img id="bannerPreview3" class="img-preview" style="display:none;" alt="Preview">
    </div>
  </div>
</div>
  </div>

</div>
<script src="<?php echo base_url('assets/js/tinymce.init.js'); ?>"></script>
<?php echo form_close(); ?>
