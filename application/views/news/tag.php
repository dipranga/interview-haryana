<?php /* news/category.php */ ?>
<div class="container" style="padding-top:24px; padding-bottom:40px;">
  <div style="background:#fff; border-radius:4px; padding:20px 24px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,.07); border-left:5px solid green ?>;">
    <h1 style="font-size:22px; font-weight:800;">Tag: #<?php echo htmlspecialchars($tag_slug); ?></h1>
    <p style="color:#888; font-size:13px; margin-top:4px;"><?php echo number_format($total); ?> खबरें</p>
  </div>

  <?php if (!empty($news)): ?>
    <div class="news-grid-4" style="margin-bottom:24px;">
      <?php foreach ($news as $n): ?>
        <div class="news-card"><a href="<?php echo base_url('news/' . $n['slug']); ?>">
          <div class="card-img">
            <?php if ($n['banner_image']): ?>
              <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
            <?php else: ?>
              <div style="background:#f0f0f0; min-height:140px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:32px;"><i class="fas fa-newspaper"></i></div>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <?php if ($n['is_breaking']): ?><span class="badge-breaking">Breaking</span><?php endif; ?>
            <div class="card-title"><?php echo htmlspecialchars($n['title']); ?></div>
            <div class="card-meta">
              <span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span>
              <span><i class="far fa-eye"></i> <?php echo number_format($n['views']); ?></span>
            </div>
          </div>
        </a></div>
      <?php endforeach; ?>
    </div>

    <?php
    $total_pages = ceil($total / $per_page);
    if ($total_pages > 1):
    ?>
    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>"><i class="fas fa-chevron-left"></i></a>
      <?php endif; ?>
      <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
        <?php if ($i === $page): ?>
          <span class="current"><?php echo $i; ?></span>
        <?php else: ?>
          <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>"><i class="fas fa-chevron-right"></i></a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

  <?php else: ?>
    <div class="no-results"><i class="fas fa-newspaper"></i>इस श्रेणी में अभी कोई खबर नहीं है।</div>
  <?php endif; ?>
</div>
