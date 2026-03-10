<?php /* admin/settings/index.php */ ?>
<div class="admin-card" style="max-width:700px;">
  <div class="admin-card-header"><h3><i class="fas fa-cog"></i> Site Settings</h3></div>
  <div class="admin-card-body">

    <!-- LOGO UPLOAD (separate form with multipart) -->
    <h4 style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:#888; margin-bottom:14px; padding-bottom:8px; border-bottom:1px solid #eee;">
      <i class="fas fa-image"></i> Site Logo
    </h4>
    <div style="display:flex; align-items:flex-start; gap:24px; margin-bottom:24px; flex-wrap:wrap;">
      <!-- Current logo preview -->
      <div style="flex-shrink:0;">
        <?php if (!empty($settings['site_logo'])): ?>
          <div style="background:#f7fafc; border:1px solid #e2e8f0; border-radius:8px; padding:12px; display:inline-block;">
            <img src="<?php echo base_url('assets/uploads/logo/' . $settings['site_logo']); ?>"
                 alt="Current Logo" style="max-height:70px; max-width:240px; display:block; object-fit:contain;">
          </div>
          <p style="font-size:11px; color:#888; margin-top:6px; text-align:center;">Current Logo</p>
        <?php else: ?>
          <div style="background:#f0f2f5; border:2px dashed #cbd5e0; border-radius:8px; padding:20px 28px; text-align:center; color:#aaa;">
            <i class="fas fa-image" style="font-size:32px; display:block; margin-bottom:6px;"></i>
            <span style="font-size:12px;">No logo uploaded</span>
          </div>
        <?php endif; ?>
      </div>

      <!-- Upload form -->
      <div style="flex:1; min-width:240px;">
        <?php echo form_open_multipart('admin/settings/upload_logo'); ?>
          <div class="form-group">
            <label class="form-label">Upload New Logo</label>
            <input type="file" name="site_logo" class="form-control" accept="image/*" data-preview="logoPreview" required>
            <img id="logoPreview" class="img-preview" style="display:none; margin-top:10px; max-height:70px;" alt="Preview">
            <div class="form-hint" style="margin-top:6px;">
              PNG or SVG recommended (transparent background).<br>
              JPG/WebP also accepted. Max 1MB.<br>
              Ideal size: around 300&times;80px.
            </div>
          </div>
          <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> Upload Logo</button>
            <?php if (!empty($settings['site_logo'])): ?>
              <a href="<?php echo base_url('admin/settings/remove_logo'); ?>"
                 onclick="return confirm('Remove the current logo? The site name text will show instead.');"
                 class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove Logo</a>
            <?php endif; ?>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>

    <!-- GENERAL SETTINGS -->
    <?php echo form_open('admin/settings/update'); ?>
      <h4 style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:#888; margin-bottom:14px; padding-bottom:8px; border-bottom:1px solid #eee;">General</h4>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Site Name</label>
          <input type="text" name="site_name" class="form-control" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>">
          <div class="form-hint">Shown as fallback if no logo is uploaded.</div>
        </div>
        <div class="form-group">
          <label class="form-label">Tagline</label>
          <input type="text" name="site_tagline" class="form-control" value="<?php echo htmlspecialchars($settings['site_tagline'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Contact Email</label>
          <input type="email" name="site_email" class="form-control" value="<?php echo $settings['site_email'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Phone</label>
          <input type="text" name="site_phone" class="form-control" value="<?php echo $settings['site_phone'] ?? ''; ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Breaking News Ticker</label>
        <input type="text" name="breaking_news_text" class="form-control" value="<?php echo htmlspecialchars($settings['breaking_news_text'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Footer About Text</label>
        <textarea name="footer_about" class="form-control" rows="3"><?php echo htmlspecialchars($settings['footer_about'] ?? ''); ?></textarea>
      </div>

      <h4 style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:#888; margin:20px 0 14px; padding-bottom:8px; border-bottom:1px solid #eee;">Social Media</h4>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label"><i class="fab fa-facebook" style="color:#1877f2;"></i> Facebook URL</label>
          <input type="url" name="facebook_url" class="form-control" value="<?php echo $settings['facebook_url'] ?? ''; ?>" placeholder="https://facebook.com/...">
        </div>
        <div class="form-group">
          <label class="form-label"><i class="fab fa-twitter" style="color:#1da1f2;"></i> Twitter URL</label>
          <input type="url" name="twitter_url" class="form-control" value="<?php echo $settings['twitter_url'] ?? ''; ?>" placeholder="https://twitter.com/...">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label"><i class="fab fa-youtube" style="color:#ff0000;"></i> YouTube URL</label>
          <input type="url" name="youtube_url" class="form-control" value="<?php echo $settings['youtube_url'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label class="form-label"><i class="fab fa-instagram" style="color:#e1306c;"></i> Instagram URL</label>
          <input type="url" name="instagram_url" class="form-control" value="<?php echo $settings['instagram_url'] ?? ''; ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="margin-top:8px;"><i class="fas fa-save"></i> Save All Settings</button>
    <?php echo form_close(); ?>

  </div>
</div>
