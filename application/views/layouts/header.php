<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : ($settings['site_name'] ?? 'Interview Haryana'); ?></title>
  <meta name="description" content="<?php echo $settings['site_tagline'] ?? 'हर बात आपके साथ '; ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
  <div class="container">
    <div class="topbar-inner">
      <span class="topbar-date"><i class="far fa-calendar-alt"></i> <?php echo date('l, d F Y'); ?></span>
      <div class="topbar-social">
        <?php if (!empty($settings['facebook_url'])): ?>
          <a href="<?php echo $settings['facebook_url']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <?php endif; ?>
        <?php if (!empty($settings['twitter_url'])): ?>
          <a href="<?php echo $settings['twitter_url']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        <?php endif; ?>
        <?php if (!empty($settings['youtube_url'])): ?>
          <a href="<?php echo $settings['youtube_url']; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
        <?php endif; ?>
        <?php if (!empty($settings['instagram_url'])): ?>
          <a href="<?php echo $settings['instagram_url']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="site-header">
  <div class="container">
    <div class="header-inner">
      <!-- LOGO + SITE NAME side by side -->
      <a href="<?php echo base_url(); ?>" class="site-logo">
        <?php if (!empty($settings['site_logo'])): ?>
          <img src="<?php echo base_url('assets/uploads/logo/' . $settings['site_logo']); ?>"
               alt="<?php echo htmlspecialchars($settings['site_name'] ?? 'Interview Haryana'); ?>"
               class="site-logo-img">
        <?php endif; ?>
        <div class="site-logo-text">
          <span class="logo-name"><?php echo $settings['site_name'] ?? 'Interview Haryana'; ?></span>
          <span class="logo-tagline"><?php echo $settings['site_tagline'] ?? 'हर बात आपके साथ'; ?></span>
        </div>
      </a>
      <form class="header-search" action="<?php echo base_url('search'); ?>" method="get">
        <input type="text" name="q" placeholder="Search news..." value="<?php echo htmlspecialchars($this->input->get('q') ?? ''); ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </div>
</header>

<!-- MAIN NAV -->
<nav class="main-nav">
  <div class="container" style="display:flex; align-items:center;">
    <button class="hamburger"><i class="fas fa-bars"></i></button>
    <ul class="nav-list">
      <li><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="<?php echo base_url('news/headlines'); ?>"><i class="fas fa-newspaper"></i> Headlines</a></li>

      <?php if (!empty($categories)):
            $top  = array_slice($categories, 0, 6);
            $more = array_slice($categories, 6);
      ?>
        <?php foreach ($top as $cat): ?>
          <li>
            <a href="<?php echo base_url('category/' . $cat['slug']); ?>"
               style="border-bottom-color:<?php echo $cat['color']; ?> !important">
              <?php echo htmlspecialchars($cat['name']); ?>
            </a>
          </li>
        <?php endforeach; ?>

        <?php if (!empty($more)): ?>
          <li class="nav-more">
            <a href="#" onclick="return false;">
              More <i class="fas fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <ul class="nav-dropdown">
              <?php foreach ($more as $cat): ?>
                <li>
                  <a href="<?php echo base_url('category/' . $cat['slug']); ?>"
                     style="border-left:3px solid <?php echo $cat['color']; ?>;">
                    <?php echo htmlspecialchars($cat['name']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php endif; ?>

      <?php endif; ?>

      <li><a href="<?php echo base_url('about-us'); ?>"><i class="fas fa-info-circle"></i> About Us</a></li>
    </ul>
  </div>
</nav>

<!-- BREAKING NEWS -->
<?php if (!empty($breaking)): ?>
<div class="breaking-bar">
  <span class="breaking-label"><i class="fas fa-bolt"></i> Breaking</span>
  <div class="breaking-scroll">
    <div class="breaking-ticker">
      <?php foreach ($breaking as $b): ?>
        <a href="<?php echo base_url('news/' . $b['slug']); ?>"><?php echo htmlspecialchars($b['title']); ?></a>
        <span class="ticker-sep">|</span>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
