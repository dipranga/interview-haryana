<?php /* news/search.php */ ?>
<div class="container" style="padding:24px 0 40px;">
  <div style="background:#fff; border-radius:4px; padding:20px 24px; margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,.07);">
    <h1 style="font-size:20px; font-weight:800;">
      <?php if ($query): ?>
        "<?php echo htmlspecialchars($query); ?>" के लिए खोज परिणाम (<?php echo number_format($total); ?>)
      <?php else: ?>
        कुछ खोजें
      <?php endif; ?>
    </h1>
  </div>
  <?php if (!empty($results)): ?>
    <div class="news-grid-4" style="margin-bottom:24px;">
      <?php foreach ($results as $n): ?>
        <div class="news-card">
          <div class="card-img">
            <?php if ($n['banner_image']): ?>
              <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="">
            <?php else: ?>
              <div style="background:#f0f0f0; min-height:140px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:32px;"><i class="fas fa-newspaper"></i></div>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <span class="cat-badge" style="background:<?php echo $n['cat_color']; ?>"><?php echo htmlspecialchars($n['cat_name']); ?></span>
            <div class="card-title"><a href="<?php echo base_url('news/' . $n['slug']); ?>"><?php echo htmlspecialchars($n['title']); ?></a></div>
            <div class="card-meta"><span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php elseif ($query): ?>
    <div class="no-results"><i class="fas fa-search"></i>"<?php echo htmlspecialchars($query); ?>" के लिए कोई खबर नहीं मिली।</div>
  <?php endif; ?>
</div>
