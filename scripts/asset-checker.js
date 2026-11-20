  window.addEventListener('load', () => {
    // Get all <link rel="stylesheet"> tags in the HTML
    const links = document.querySelectorAll('link[rel="stylesheet"]');
    
    // Get the hrefs of stylesheets that actually loaded
    const loadedSheets = Array.from(document.styleSheets).map(sheet => sheet.href);

    links.forEach(link => {
      if (loadedSheets.includes(link.href)) {
        console.log('Loaded successfully:', link.href);
      } else {
        console.error('Failed to load:', link.href);
      }
    });
  });
