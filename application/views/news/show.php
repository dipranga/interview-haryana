<?php /* news/show.php */ ?>
<div class="container" style="padding-top:24px; padding-bottom:40px;">
  <div class="page-layout">
    <main>
      <div style="margin-bottom:20px;">
        <span class="article-category" style="color:<?php echo $news['cat_color']; ?>">
          <a href="<?php echo base_url('category/' . $news['cat_slug']); ?>" style="color:inherit;"><?php echo htmlspecialchars($news['cat_name']); ?></a>
        </span>
        <h1 class="article-title"><?php echo htmlspecialchars($news['title']); ?></h1>
        <?php if ($news['summary']): ?>
          <p class="article-summary" style="font-size:16px; color:#555; margin-bottom:12px; line-height:1.7; text-align: justify;"><?php echo htmlspecialchars($news['summary']); ?></p>
        <?php endif; ?>
        <div class="article-meta">
          <!-- <span><i class="fas fa-user"></i> <?php // echo htmlspecialchars($news['author_name'] ?? 'Admin'); ?></span> -->
          <span><i class="far fa-clock"></i> <?php echo date('d M Y, h:i A', strtotime($news['published_at'])); ?></span>
          <span><i class="far fa-eye"></i> <?php echo number_format($news['views']); ?> views</span>
          <?php if ($news['is_breaking']): ?><span class="badge-breaking"><i class="fas fa-bolt"></i> Breaking</span><?php endif; ?>
        </div>
      </div>

      <?php if ($news['banner_image']): ?>
        <img src="<?php echo base_url('assets/uploads/news/' . $news['banner_image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="article-banner">
      <?php endif; ?>

      <!-- Share -->
      <div style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:#1877f2; color:#fff; padding:7px 16px; border-radius:4px; font-size:13px; font-weight:600;"><i class="fab fa-facebook-f"></i> Share</a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(current_url()); ?>&text=<?php echo urlencode($news['title']); ?>" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:#1da1f2; color:#fff; padding:7px 16px; border-radius:4px; font-size:13px; font-weight:600;"><i class="fab fa-twitter"></i> Tweet</a>
        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($news['title'] . ' ' . current_url()); ?>" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:#25d366; color:#fff; padding:7px 16px; border-radius:4px; font-size:13px; font-weight:600;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
      </div>

      <div class="article-body"><?php echo $news['body']; ?></div>

      <?php if (!empty($news['tags'])): ?>
      <div style="margin-top:24px; padding-top:16px; border-top:1px solid #eee;">
        <span style="font-weight:700;"><i class="fas fa-tags"></i> Tags:</span>
        <?php foreach ($news['tags'] as $tag): ?>
          <a href="<?php echo base_url('tag/' . $tag['slug']); ?>" class="tag-pill"><?php echo htmlspecialchars($tag['name']); ?></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if (!empty($related)): ?>
      <div style="margin-top:32px;">
        <div class="section-heading"><div class="line"></div><h2>संबंधित खबरें</h2></div>
        <div class="news-grid-3">
          <?php foreach ($related as $n): ?>
            <div class="news-card"><a href="<?php echo base_url('news/' . $n['slug']); ?>">
              <div class="card-img">
                <?php if ($n['banner_image']): ?>
                  <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="">
                <?php else: ?>
                  <div style="background:#f0f0f0; min-height:130px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:28px;"><i class="fas fa-newspaper"></i></div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <div class="card-title"><?php echo htmlspecialchars($n['title']); ?></div>
                <div class="card-meta"><span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span></div>
              </div>
            </a></div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </main>

    <aside>
      <div class="sidebar-widget">
        <div class="widget-header"><i class="fas fa-th-list"></i> श्रेणियाँ</div>
        <div class="widget-body" style="padding:0;">
          <ul style="list-style:none;">
            <?php foreach ($categories as $cat): ?>
              <li style="border-bottom:1px solid #f0f0f0;">
                <a href="<?php echo base_url('category/' . $cat['slug']); ?>" style="display:flex; justify-content:space-between; padding:10px 16px; font-size:13px; font-weight:500; color:#333;">
                  <span><i class="fas fa-circle" style="font-size:6px; margin-right:8px; color:<?php echo $cat['color']; ?>;"></i><?php echo htmlspecialchars($cat['name']); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </aside>
  </div>
</div>
