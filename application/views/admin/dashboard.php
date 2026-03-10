<?php /* admin/dashboard.php */ ?>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-icon"><i class="fas fa-newspaper"></i></div><div><div class="stat-num"><?php echo number_format($total_news); ?></div><div class="stat-label">Total Articles</div></div></div>
  <div class="stat-card"><div class="stat-icon"><i class="fas fa-check-circle"></i></div><div><div class="stat-num"><?php echo number_format($published_news); ?></div><div class="stat-label">Published</div></div></div>
  <div class="stat-card"><div class="stat-icon"><i class="fas fa-edit"></i></div><div><div class="stat-num"><?php echo number_format($draft_news); ?></div><div class="stat-label">Drafts</div></div></div>
  <div class="stat-card"><div class="stat-icon"><i class="fas fa-th-list"></i></div><div><div class="stat-num"><?php echo number_format($total_categories); ?></div><div class="stat-label">Categories</div></div></div>
  <div class="stat-card"><div class="stat-icon"><i class="fas fa-images"></i></div><div><div class="stat-num"><?php echo number_format($total_banners); ?></div><div class="stat-label">Banners</div></div></div>
</div>

<div class="admin-card">
  <div class="admin-card-header"><h3><i class="fas fa-bolt"></i> Quick Actions</h3></div>
  <div class="admin-card-body" style="display:flex; gap:12px; flex-wrap:wrap;">
    <a href="<?php echo base_url('admin/news/create'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> New Article</a>
    <a href="<?php echo base_url('admin/banners/create'); ?>" class="btn btn-info"><i class="fas fa-image"></i> Add Banner</a>
    <a href="<?php echo base_url('admin/categories/create'); ?>" class="btn btn-success"><i class="fas fa-folder-plus"></i> New Category</a>
    <a href="<?php echo base_url('admin/settings'); ?>" class="btn btn-secondary"><i class="fas fa-cog"></i> Settings</a>
    <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> View Site</a>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3><i class="fas fa-newspaper"></i> Recent Articles</h3>
    <a href="<?php echo base_url('admin/news'); ?>" class="btn btn-secondary btn-sm">View All</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="admin-table">
      <thead>
        <tr><th>Title</th><th>Category</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($recent_news as $n): ?>
        <tr>
          <td style="max-width:280px;">
            <?php if ($n['is_breaking']): ?><span class="badge" style="background:#fed7d7; color:#c53030; margin-right:4px; font-size:9px;">Breaking</span><?php endif; ?>
            <span style="font-weight:500;"><?php echo htmlspecialchars(mb_substr($n['title'], 0, 60)); ?>...</span>
          </td>
          <td><?php echo htmlspecialchars($n['cat_name']); ?></td>
          <td><?php echo htmlspecialchars($n['author_name']); ?></td>
          <td><span class="badge badge-<?php echo $n['status']; ?>"><?php echo ucfirst($n['status']); ?></span></td>
          <td style="white-space:nowrap; font-size:12px; color:#888;"><?php echo date('d M Y', strtotime($n['created_at'])); ?></td>
          <td style="white-space:nowrap;">
            <a href="<?php echo base_url('admin/news/edit/' . $n['id']); ?>" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-edit"></i></a>
            <a href="<?php echo base_url('news/' . $n['slug']); ?>" target="_blank" class="btn btn-info btn-sm btn-icon"><i class="fas fa-eye"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($recent_news)): ?>
          <tr><td colspan="6" style="text-align:center; color:#999; padding:28px;">No articles yet. <a href="<?php echo base_url('admin/news/create'); ?>">Create one!</a></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
