<?php /* admin/tags/index.php */ ?>
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
  <div class="admin-card">
    <div class="admin-card-header"><h3><i class="fas fa-plus"></i> Add Tags</h3></div>
    <div class="admin-card-body">
      <?php echo form_open('admin/tags/store'); ?>
        <div class="form-group">
          <label class="form-label">Tag Names</label>
          <input type="text" name="names" class="form-control" placeholder="haryana, politics, crime" required>
          <div class="form-hint">Comma-separated tags</div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Tags</button>
      <?php echo form_close(); ?>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card-header"><h3><i class="fas fa-tags"></i> All Tags (<?php echo count($tags); ?>)</h3></div>
    <div class="admin-card-body" style="max-height:400px; overflow-y:auto;">
      <?php foreach ($tags as $tag): ?>
        <span style="display:inline-flex; align-items:center; gap:6px; background:#f7fafc; border:1px solid #e2e8f0; border-radius:20px; padding:4px 12px; margin:4px; font-size:12px;">
          <?php echo htmlspecialchars($tag['name']); ?>
          <span style="background:#e2e8f0; border-radius:10px; padding:1px 6px; font-size:10px;"><?php echo $tag['news_count']; ?></span>
          <?php echo form_open('admin/tags/delete/' . $tag['id'], 'class="delete-form" style="display:inline;"'); ?>
            <button type="submit" style="background:none; border:none; cursor:pointer; color:#e53e3e; font-size:13px; padding:0; line-height:1;">&times;</button>
          <?php echo form_close(); ?>
        </span>
      <?php endforeach; ?>
      <?php if (empty($tags)): ?><p style="color:#999; text-align:center; padding:16px;">No tags yet.</p><?php endif; ?>
    </div>
  </div>
</div>
