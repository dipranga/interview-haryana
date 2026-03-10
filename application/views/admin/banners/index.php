<?php /* admin/banners/index.php */ ?>
<div class="admin-card">
  <div class="admin-card-header">
    <h3><i class="fas fa-images"></i> Banners & Sliders</h3>
    <a href="<?php echo base_url('admin/banners/create'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Banner</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="admin-table">
      <thead><tr><th style="width:80px;">Image</th><th>Title</th><th>Position</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($banners as $b): ?>
        <tr>
          <td><img src="<?php echo base_url('assets/uploads/banners/' . $b['image']); ?>" style="width:80px; height:50px; object-fit:cover; border-radius:4px;" alt=""></td>
          <td>
            <strong><?php echo htmlspecialchars($b['title']); ?></strong>
            <?php if ($b['subtitle']): ?><div style="font-size:12px; color:#888;"><?php echo htmlspecialchars(mb_substr($b['subtitle'], 0, 60)); ?></div><?php endif; ?>
          </td>
          <td><span class="badge badge-published"><?php echo $b['position']; ?></span></td>
          <td><?php echo $b['sort_order']; ?></td>
          <td><span class="badge <?php echo $b['is_active'] ? 'badge-published' : 'badge-archived'; ?>"><?php echo $b['is_active'] ? 'Active' : 'Inactive'; ?></span></td>
          <td style="white-space:nowrap;">
            <a href="<?php echo base_url('admin/banners/edit/' . $b['id']); ?>" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-edit"></i></a>
            <?php echo form_open('admin/banners/delete/' . $b['id'], 'class="delete-form" style="display:inline;"'); ?>
              <button class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></button>
            <?php echo form_close(); ?>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($banners)): ?><tr><td colspan="6" style="text-align:center; color:#999; padding:24px;">No banners yet.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
