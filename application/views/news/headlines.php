<?php /* news/category.php */ ?>
<div class="container" style="padding-top:24px; padding-bottom:40px;">
  <div style="background:#fff; border-radius:4px; padding:6px 18px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,.07); border-left:5px solid red;">
    <h1 style="font-size:22px; font-weight:800;">Headlines</h1>
  </div>

  <?php if (!empty($news)): ?>
    <div class="news-grid-4" style="margin-bottom:24px;">
      <?php foreach ($news as $n): ?>
        <div class="news-card">
          <div class="card-img">
            <?php if ($n['banner_image']): ?>
              <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
            <?php else: ?>
              <div style="background:#f0f0f0; min-height:140px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:32px;"><i class="fas fa-newspaper"></i></div>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <?php if ($n['is_breaking']): ?><span class="badge-breaking">Breaking</span><?php endif; ?>
            <div class="card-title"><a href="<?php echo base_url('news/' . $n['slug']); ?>"><?php echo htmlspecialchars($n['title']); ?></a></div>
            <div class="card-meta">
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
