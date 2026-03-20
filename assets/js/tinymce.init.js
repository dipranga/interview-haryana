tinymce.init({
  selector: 'textarea[name="body"]',
  height: 500,
  menubar: false,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image',
    'charmap', 'preview', 'anchor', 'searchreplace',
    'visualblocks', 'code', 'fullscreen',
    'media', 'table', 'wordcount'
  ],
  toolbar:
    'undo redo | blocks | bold italic underline | ' +
    'alignleft aligncenter alignright | ' +
    'bullist numlist | link image | code fullscreen',
  content_style: `
    body {
      font-family: 'Noto Sans Devanagari', Mukta, sans-serif;
      font-size: 15px;
      line-height: 1.8;
      color: #1a2a44;
      padding: 16px;
    }
  `,
  branding: false,
  promotion: false,
});