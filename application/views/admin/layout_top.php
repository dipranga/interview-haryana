<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Admin'; ?> — Interview haryana</title>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
</head>
<body>
<div class="admin-wrapper">

  <!-- SIDEBAR -->
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
      <div class="brand-name">Interview haryana</div>
      <div class="brand-sub">Admin Dashboard</div>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-section-label">Main</div>
      <a href="<?php echo base_url('admin/dashboard'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'dashboard' || $this->uri->segment(2) === '') ? 'active' : ''; ?>">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>

      <div class="nav-section-label" style="margin-top:8px;">Content</div>
      <a href="<?php echo base_url('admin/news'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'news' && $this->uri->segment(3) == FALSE) ? 'active' : ''; ?>">
        <i class="fas fa-newspaper"></i> Articles
      </a>
      <a href="<?php echo base_url('admin/news/create'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'news' && $this->uri->segment(3) === 'create') ? 'active' : ''; ?>">
        <i class="fas fa-plus-circle"></i> New Article
      </a>
      <a href="<?php echo base_url('admin/categories'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'categories') ? 'active' : ''; ?>">
        <i class="fas fa-th-list"></i> Categories
      </a>
      <a href="<?php echo base_url('admin/tags'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'tags') ? 'active' : ''; ?>">
        <i class="fas fa-tags"></i> Tags
      </a>

      <div class="nav-section-label" style="margin-top:8px;">Media</div>
      <a href="<?php echo base_url('admin/banners'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'banners') ? 'active' : ''; ?>">
        <i class="fas fa-images"></i> Banners / Sliders
      </a>

      <div class="nav-section-label" style="margin-top:8px;">System</div>
      <a href="<?php echo base_url('admin/settings'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'settings' && $this->uri->segment(3) == FALSE) ? 'active' : ''; ?>">
        <i class="fas fa-cog"></i> Site Settings
      </a>
      <a href="<?php echo base_url('admin/settings/change_password'); ?>" class="sidebar-link <?php echo ($this->uri->segment(2) === 'settings' && $this->uri->segment(3) === 'change_password') ? 'active' : ''; ?>">
        <i class="fas fa-key"></i> Change Password
      </a>
    </nav>
    <div class="sidebar-footer">
      <a href="<?php echo base_url(); ?>" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
      <a href="<?php echo base_url('admin/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="admin-main">
    <header class="admin-topbar">
      <div style="display:flex; align-items:center; gap:16px;">
        <button onclick="document.getElementById('adminSidebar').classList.toggle('open')"
                style="background:none; border:none; font-size:20px; cursor:pointer; display:none;" id="menuBtn">
          <i class="fas fa-bars"></i>
        </button>
        <span class="topbar-title"><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard'; ?></span>
      </div>
      <div class="topbar-user">
        <div class="user-avatar"><?php echo strtoupper(substr($this->session->userdata('admin_name') ?? 'A', 0, 1)); ?></div>
        <div>
          <strong><?php echo htmlspecialchars($this->session->userdata('admin_name') ?? 'Admin'); ?></strong>
          <div style="font-size:11px;"><?php echo $this->session->userdata('admin_role') ?? ''; ?></div>
        </div>
      </div>
    </header>

    <div class="admin-content">
      <!-- Flash messages -->
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?></div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('errors')): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('errors'); ?></div>
      <?php endif; ?>
