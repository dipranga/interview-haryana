<!-- FOOTER -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-col">
        <h4><?php echo $settings['site_name'] ?? 'Interview haryana'; ?></h4>
        <p><?php echo $settings['footer_about'] ?? ''; ?></p>
        <div class="footer-social" style="margin-top:14px;">
          <?php if (!empty($settings['facebook_url'])): ?><a href="<?php echo $settings['facebook_url']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
          <?php if (!empty($settings['twitter_url'])): ?><a href="<?php echo $settings['twitter_url']; ?>" target="_blank"><i class="fab fa-twitter"></i></a><?php endif; ?>
          <?php if (!empty($settings['youtube_url'])): ?><a href="<?php echo $settings['youtube_url']; ?>" target="_blank"><i class="fab fa-youtube"></i></a><?php endif; ?>
          <?php if (!empty($settings['instagram_url'])): ?><a href="<?php echo $settings['instagram_url']; ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?>
        </div>
      </div>
      <div class="footer-col">
        <h4>श्रेणियाँ</h4>
        <ul>
          <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
              <li><a href="<?php echo base_url('category/' . $cat['slug']); ?>">
                <i class="fas fa-chevron-right" style="font-size:10px; margin-right:5px;"></i>
                <?php echo htmlspecialchars($cat['name']); ?>
              </a></li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>
      <div class="footer-col">
        <h4>त्वरित लिंक</h4>
        <ul>
          <li><a href="<?php echo base_url(); ?>"><i class="fas fa-chevron-right" style="font-size:10px; margin-right:5px;"></i>होम</a></li>
          <li><a href="<?php echo base_url('search'); ?>"><i class="fas fa-chevron-right" style="font-size:10px; margin-right:5px;"></i>खोज</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>संपर्क</h4>
        <?php if (!empty($settings['site_email'])): ?>
          <p><i class="fas fa-envelope" style="margin-right:6px; color:#e63946;"></i><?php echo $settings['site_email']; ?></p>
        <?php endif; ?>
        <?php if (!empty($settings['site_phone'])): ?>
          <p style="margin-top:8px;"><i class="fas fa-phone" style="margin-right:6px; color:#e63946;"></i><?php echo $settings['site_phone']; ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?> <?php echo $settings['site_name'] ?? 'Interview haryana'; ?> — सर्वाधिकार सुरक्षित</p>
    </div>
  </div>
</footer>

<button id="scrollTop" style="display:none; position:fixed; bottom:24px; right:24px; width:42px; height:42px; background:#c0392b; color:#fff; border:none; border-radius:50%; cursor:pointer; font-size:18px; align-items:center; justify-content:center; box-shadow:0 3px 12px rgba(0,0,0,.2); z-index:999;">
  <i class="fas fa-chevron-up"></i>
</button>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>
