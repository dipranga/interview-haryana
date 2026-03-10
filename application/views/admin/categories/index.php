<?php /* admin/categories/index.php */ ?>
<div class="admin-card">
  <div class="admin-card-header">
    <h3><i class="fas fa-th-list"></i> Categories</h3>
    <a href="<?php echo base_url('admin/categories/create'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="admin-table">
      <thead><tr><th>#</th><th>Name</th><th>Slug</th><th>Color</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
          <td><?php echo $cat['id']; ?></td>
          <td><strong><?php echo htmlspecialchars($cat['name']); ?></strong></td>
          <td style="font-size:12px; color:#888;"><?php echo $cat['slug']; ?></td>
          <td><span style="display:inline-block; width:20px; height:20px; border-radius:4px; background:<?php echo $cat['color']; ?>; vertical-align:middle;"></span> <span style="font-size:12px;"><?php echo $cat['color']; ?></span></td>
          <td><?php echo $cat['sort_order']; ?></td>
          <td><span class="badge <?php echo $cat['is_active'] ? 'badge-published' : 'badge-archived'; ?>"><?php echo $cat['is_active'] ? 'Active' : 'Inactive'; ?></span></td>
          <td style="white-space:nowrap;">
            <a href="<?php echo base_url('admin/categories/edit/' . $cat['id']); ?>" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-edit"></i></a>
            <?php echo form_open('admin/categories/delete/' . $cat['id'], 'class="delete-form" style="display:inline;"'); ?>
              <button class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></button>
            <?php echo form_close(); ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
