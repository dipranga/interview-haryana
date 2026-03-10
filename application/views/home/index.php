<?php /* Home/index view — CI3 */ ?>

<!-- HERO SLIDER -->
<?php if (!empty($sliders)): ?>
<section class="hero-section">
  <div class="container">
    <div class="hero-slider">
      <div class="slider-track">
        <?php foreach ($sliders as $s): ?>
        <div class="slide">
          <img src="<?php echo base_url('assets/uploads/banners/' . $s['image']); ?>" alt="<?php echo htmlspecialchars($s['title']); ?>">
          <div class="slide-caption">
            <h2>
              <?php if ($s['link_url']): ?>
                <a href="<?php echo $s['link_url']; ?>"><?php echo htmlspecialchars($s['title']); ?></a>
              <?php else: ?>
                <?php echo htmlspecialchars($s['title']); ?>
              <?php endif; ?>
            </h2>
            <?php if ($s['subtitle']): ?>
              <p style="color:#ddd; font-size:14px; margin-top:6px;"><?php echo htmlspecialchars($s['subtitle']); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <button class="slider-btn slider-prev"><i class="fas fa-chevron-left"></i></button>
      <button class="slider-btn slider-next"><i class="fas fa-chevron-right"></i></button>
      <div class="slider-dots">
        <?php foreach ($sliders as $i => $s): ?>
          <div class="slider-dot <?php echo $i === 0 ? 'active' : ''; ?>"></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<div class="container">
  <div class="page-layout">
    <main>

      <!-- FEATURED NEWS -->
      <?php if (!empty($featured)): ?>
      <section class="mb-20">
        <div class="section-heading">
          <div class="line"></div>
          <h2>मुख्य खबरें</h2>
        </div>
        <div class="news-grid-3">
          <?php foreach ($featured as $n): ?>
            <div class="news-card">
              <div class="card-img">
                <?php if ($n['banner_image']): ?>
                  <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
                <?php else: ?>
                  <div style="background:#eee; min-height:160px; display:flex; align-items:center; justify-content:center; color:#bbb; font-size:40px;"><i class="fas fa-newspaper"></i></div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <span class="cat-badge" style="background:<?php echo $n['cat_color']; ?>"><?php echo htmlspecialchars($n['cat_name']); ?></span>
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
      </section>
      <?php endif; ?>

      <!-- LATEST NEWS -->
      <section class="mb-20">
        <div class="section-heading">
          <div class="line"></div>
          <h2>ताज़ा खबरें</h2>
          <a href="<?php echo base_url('category/haryana'); ?>">और देखें <i class="fas fa-arrow-right"></i></a>
        </div>
        <?php if (!empty($latest)): ?>
        <div class="news-grid-4">
          <?php foreach ($latest as $n): ?>
            <div class="news-card">
              <div class="card-img">
                <?php if ($n['banner_image']): ?>
                  <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
                <?php else: ?>
                  <div style="background:#f0f0f0; min-height:140px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:32px;"><i class="fas fa-newspaper"></i></div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <span class="cat-badge" style="background:<?php echo $n['cat_color']; ?>"><?php echo htmlspecialchars($n['cat_name']); ?></span>
                <div class="card-title"><a href="<?php echo base_url('news/' . $n['slug']); ?>"><?php echo htmlspecialchars($n['title']); ?></a></div>
                <div class="card-meta">
                  <span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
          <div class="no-results"><i class="fas fa-newspaper"></i>अभी कोई खबर नहीं है।</div>
        <?php endif; ?>
      </section>

      <!-- CATEGORY SECTIONS -->
      <?php if (!empty($cat_news)): ?>
        <?php foreach ($cat_news as $slug => $block): ?>
          <?php if (!empty($block['news'])): ?>
          <section class="cat-section">
            <div class="section-heading">
              <div class="line" style="background:<?php echo $block['cat']['color']; ?>"></div>
              <h2><?php echo htmlspecialchars($block['cat']['name']); ?></h2>
              <a href="<?php echo base_url('category/' . $slug); ?>">और देखें <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid-4">
              <?php foreach ($block['news'] as $n): ?>
                <div class="news-card">
                  <div class="card-img">
                    <?php if ($n['banner_image']): ?>
                      <img src="<?php echo base_url('assets/uploads/news/' . $n['banner_image']); ?>" alt="<?php echo htmlspecialchars($n['title']); ?>">
                    <?php else: ?>
                      <div style="background:#f0f0f0; min-height:130px; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:28px;"><i class="fas fa-newspaper"></i></div>
                    <?php endif; ?>
                  </div>
                  <div class="card-body">
                    <div class="card-title"><a href="<?php echo base_url('news/' . $n['slug']); ?>"><?php echo htmlspecialchars($n['title']); ?></a></div>
                    <div class="card-meta">
                      <span><i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($n['published_at'])); ?></span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </section>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

    </main>

    <!-- SIDEBAR -->
    <aside>
      <?php if (!empty($sidebar_banners)): ?>
      <div class="sidebar-widget">
        <div class="widget-header"><i class="fas fa-ad"></i> विज्ञापन</div>
        <div class="widget-body" style="padding:10px;">
          <?php foreach ($sidebar_banners as $b): ?>
            <?php if ($b['link_url']): ?>
              <a href="<?php echo $b['link_url']; ?>" target="_blank">
                <img src="<?php echo base_url('assets/uploads/banners/' . $b['image']); ?>" alt="<?php echo htmlspecialchars($b['title']); ?>" style="width:100%; border-radius:4px; margin-bottom:8px;">
              </a>
            <?php else: ?>
              <img src="<?php echo base_url('assets/uploads/banners/' . $b['image']); ?>" alt="<?php echo htmlspecialchars($b['title']); ?>" style="width:100%; border-radius:4px; margin-bottom:8px;">
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="sidebar-widget">
        <div class="widget-header"><i class="fas fa-th-list"></i> श्रेणियाँ</div>
        <div class="widget-body" style="padding:0;">
          <ul style="list-style:none;">
            <?php foreach ($categories as $cat): ?>
              <li style="border-bottom:1px solid #f0f0f0;">
                <a href="<?php echo base_url('category/' . $cat['slug']); ?>"
                   style="display:flex; justify-content:space-between; padding:10px 16px; font-size:13px; font-weight:500; color:#333; transition:all .2s;"
                   onmouseover="this.style.color='<?php echo $cat['color']; ?>'; this.style.paddingLeft='22px';"
                   onmouseout="this.style.color='#333'; this.style.paddingLeft='16px';">
                  <span><i class="fas fa-circle" style="font-size:6px; margin-right:8px; color:<?php echo $cat['color']; ?>;"></i><?php echo htmlspecialchars($cat['name']); ?></span>
                  <i class="fas fa-chevron-right" style="font-size:10px; opacity:.4;"></i>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </aside>

  </div>
</div>
