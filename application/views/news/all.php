<?php /* news/all.php */ ?>
<div class="container" style="padding-top:24px; padding-bottom:40px;">

  <div style="background:#fff; border-radius:4px; padding:6px 18px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,.07); border-left:5px solid red;">
    <h1 style="font-size:22px; font-weight:800;">All News</h1>
  </div>

  <?php if (!empty($news)): ?>
    <div class="news-list" style="margin-bottom:24px;">
      <?php foreach ($news as $n): ?>
        <div class="news-list-item">

          <!-- Thumbnail -->
          <div class="list-thumb">
            <?php if ($n['banner_image']): ?>
              <a href="<?php echo base_url('news/' . $n['slug']); ?>">
                <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
              </a>
            <?php else: ?>
              <a href="<?php echo base_url('news/' . $n['slug']); ?>" class="list-thumb-placeholder">
                <i class="fas fa-newspaper"></i>
              </a>
            <?php endif; ?>
          </div>

          <!-- Content -->
          <div class="list-content">
            <?php if ($n['is_breaking']): ?>
              <div class="list-badges"><span class="badge-breaking">Breaking</span></div>
            <?php endif; ?>
            <div class="list-title">
              <a href="<?php echo base_url('news/' . $n['slug']); ?>"><?php echo htmlspecialchars($n['title']); ?></a>
            </div>
            <div class="list-meta">
              <span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span>
              <span><i class="far fa-eye"></i> <?php echo number_format($n['views']); ?></span>
            </div>
          </div>
        </div>
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
