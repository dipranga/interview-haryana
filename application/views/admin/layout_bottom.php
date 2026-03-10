    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-wrapper -->

<script>
  var menuBtn = document.getElementById('menuBtn');
  if (window.innerWidth <= 900 && menuBtn) menuBtn.style.display = 'block';
  window.addEventListener('resize', function() {
    if (menuBtn) menuBtn.style.display = window.innerWidth <= 900 ? 'block' : 'none';
  });

  // Image preview on file input change
  document.querySelectorAll('input[type=file]').forEach(function(inp) {
    inp.addEventListener('change', function() {
      var previewId = this.getAttribute('data-preview');
      if (!previewId) return;
      var preview = document.getElementById(previewId);
      if (!preview) return;
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(file);
      }
    });
  });

  // Confirm deletes
  document.querySelectorAll('.delete-form').forEach(function(f) {
    f.addEventListener('submit', function(e) {
      if (!confirm('Are you sure? This cannot be undone.')) e.preventDefault();
    });
  });
</script>
</body>
</html>
