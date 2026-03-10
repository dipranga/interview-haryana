<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Login — Interview haryana</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body{display:flex;align-items:center;justify-content:center;min-height:100vh;background:var(--as);}
    .login-box{width:420px;background:#fff;border-radius:12px;padding:40px;box-shadow:0 20px 60px rgba(0,0,0,.3);}
    .login-logo{text-align:center;margin-bottom:28px;}
    .login-logo .site-name{font-size:22px;font-weight:800;color:var(--ap);letter-spacing:.5px;}
    .login-logo .site-sub{font-size:12px;color:var(--am);margin-top:4px;}
    .login-logo .admin-badge{display:inline-block;background:var(--as);color:#fff;font-size:10px;font-weight:700;padding:3px 12px;border-radius:20px;margin-top:8px;letter-spacing:1px;text-transform:uppercase;}
  </style>
</head>
<body>
<div class="login-box">
  <div class="login-logo">
    <div class="site-name">Interview haryana</div>
    <div class="site-sub">हरियाणा की हर खबर</div>
    <div class="admin-badge"><i class="fas fa-shield-alt"></i> Admin Panel</div>
  </div>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?></div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></div>
  <?php endif; ?>

  <?php echo form_open('admin/login/post'); ?>
    <div class="form-group">
      <label class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="Email"
             value="<?php echo set_value('email'); ?>" required>
    </div>
    <div class="form-group">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px; font-size:14px;">
      <i class="fas fa-sign-in-alt"></i> Login to Dashboard
    </button>
  <?php echo form_close(); ?>

  <p style="text-align:center; margin-top:20px; font-size:12px; color:var(--am);">
    <a href="<?php echo base_url(); ?>" style="color:var(--am);"><i class="fas fa-arrow-left"></i> Back to website</a>
  </p>
</div>
</body>
</html>
