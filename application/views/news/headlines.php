<?php /* news/headlines.php */ ?>
<div class="container" style="padding-top:24px; padding-bottom:40px;">
  <div style="background:#fff; border-radius:4px; padding:6px 18px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,.07); border-left:5px solid red;">
    <h1 style="font-size:22px; font-weight:800;">Headlines</h1>
  </div>

  <?php if (!empty($news)): ?>
    <div class="news-list">
      <?php foreach ($news as $i => $n): ?>
        <div class="news-list-item">

          <!-- Index number -->
          <div class="list-index"><?php echo $i + 1; ?></div>

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

  <?php else: ?>
    <div class="no-results"><i class="fas fa-newspaper"></i>इस श्रेणी में अभी कोई खबर नहीं है।</div>
  <?php endif; ?>
</div>
