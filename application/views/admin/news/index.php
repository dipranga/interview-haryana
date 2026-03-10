<?php /* admin/news/index.php */ ?>
<div class="admin-card">
  <div class="admin-card-header">
    <h3><i class="fas fa-newspaper"></i> All Articles (<?php echo count($news_list); ?>)</h3>
    <a href="<?php echo base_url('admin/news/create'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New Article</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="admin-table">
      <thead>
        <tr><th style="width:60px;">Image</th><th>Title</th><th>Category</th><th>Status</th><th>Views</th><th>Date</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($news_list as $n): ?>
        <tr>
          <td>
            <?php if ($n['banner_image']): ?>
              <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" class="news-thumb" alt="">
            <?php else: ?>
              <div style="width:60px; height:42px; background:#f0f0f0; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#ccc;"><i class="fas fa-image"></i></div>
            <?php endif; ?>
          </td>
          <td style="max-width:280px;">
            <?php if ($n['is_featured']): ?><span class="badge" style="background:#fefcbf; color:#744210; font-size:9px;">★ Featured</span><?php endif; ?>
            <?php if ($n['is_breaking']): ?><span class="badge" style="background:#fed7d7; color:#c53030; font-size:9px;">Breaking</span><?php endif; ?>
            <div style="font-weight:500; margin-top:3px;"><?php echo htmlspecialchars(mb_substr($n['title'], 0, 70)); ?><?php echo mb_strlen($n['title']) > 70 ? '...' : ''; ?></div>
          </td>
          <td><span style="font-size:12px;"><?php echo htmlspecialchars($n['cat_name']); ?></span></td>
          <td><span class="badge badge-<?php echo $n['status']; ?>"><?php echo ucfirst($n['status']); ?></span></td>
          <td style="font-size:12px;"><?php echo number_format($n['views']); ?></td>
          <td style="white-space:nowrap; font-size:12px; color:#888;"><?php echo date('d M Y', strtotime($n['created_at'])); ?></td>
          <td style="white-space:nowrap;">
            <a href="<?php echo base_url('admin/news/edit/' . $n['id']); ?>" class="btn btn-warning btn-sm btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
            <?php echo form_open('admin/news/status/' . $n['id'], 'style="display:inline;"'); ?>
              <button type="submit" class="btn btn-info btn-sm btn-icon" title="Toggle Status"><i class="fas fa-toggle-<?php echo $n['status'] === 'published' ? 'on' : 'off'; ?>"></i></button>
            <?php echo form_close(); ?>
            <a href="<?php echo base_url('news/' . $n['slug']); ?>" target="_blank" class="btn btn-secondary btn-sm btn-icon"><i class="fas fa-eye"></i></a>
            <?php echo form_open('admin/news/delete/' . $n['id'], 'class="delete-form" style="display:inline;"'); ?>
              <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete"><i class="fas fa-trash"></i></button>
            <?php echo form_close(); ?>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($news_list)): ?>
          <tr><td colspan="7" style="text-align:center; color:#999; padding:28px;">No articles yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
