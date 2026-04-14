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
    'undo redo | blocks | fontfamily fontsize | bold italic underline | ' +
    'alignleft aligncenter alignright | ' +
    'bullist numlist | link image | code fullscreen',
  font_family_formats: `
    Noto Sans Devanagari=Noto Sans Devanagari, sans-serif;
    Mukta=Mukta, sans-serif;
    Andale Mono=andale mono,times;
    Arial=arial,helvetica,sans-serif;
    Arial Black=arial black,avant garde;
    Book Antiqua=book antiqua,palatino;
    Comic Sans MS=comic sans ms,sans-serif;
    Courier New=courier new,courier;
    Georgia=georgia,palatino;
    Helvetica=helvetica;
    Impact=impact,chicago;
    Open Sans=open sans,sans-serif; // Your new font
    Symbol=symbol;
    Tahoma=tahoma,arial,helvetica,sans-serif;
    Terminal=terminal,monaco;
    Times New Roman=times new roman,times;
    Trebuchet MS=trebuchet ms,geneva;
    Verdana=verdana,geneva;
    Webdings=webdings;
    Wingdings=wingdings,zapf dingbats;`,
  content_style: `
    body {
      font-family: 'Noto Sans Devanagari', Mukta, sans-serif;
      font-size: 14px;
      line-height: 1.8;
      color: #1a2a44;
      padding: 16px;
    }
  `,
  branding: false,
  promotion: false,
});