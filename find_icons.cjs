const fs = require('fs');

function getFiles(dir, files = []) {
  const list = fs.readdirSync(dir);
  for (let file of list) {
    const name = dir + '/' + file;
    if (fs.statSync(name).isDirectory()) {
      getFiles(name, files);
    } else if (name.endsWith('.blade.php')) {
      files.push(name);
    }
  }
  return files;
}

const folders = ['booking', 'dashboard', 'kategori', 'lapangan', 'time', 'user'];
let allIcons = new Set();
let allImages = new Set();
folders.forEach(folder => {
  const dir = 'resources/views/admin/' + folder;
  if (!fs.existsSync(dir)) return;
  const files = getFiles(dir);
  files.forEach(file => {
    const content = fs.readFileSync(file, 'utf8');
    
    // Find material symbols
    const iconRegex = /<span[^>]*class="[^"]*material-symbols-outlined[^"]*"[^>]*>([^<]*)<\/span>/g;
    let match;
    while ((match = iconRegex.exec(content)) !== null) {
      allIcons.add(match[1].trim());
    }

    // Find fontawesome / other classes
    const iRegex = /<i\s+class="([^"]*)"[^>]*><\/i>/g;
    while ((match = iRegex.exec(content)) !== null) {
      allIcons.add('FA: ' + match[1].trim());
    }

    // Find images
    const imgRegex = /<img[^>]*src="([^"]*)"[^>]*>/g;
    while ((match = imgRegex.exec(content)) !== null) {
      allImages.add(match[1].trim());
    }
  });
});
console.log('Icons:', Array.from(allIcons));
console.log('Images:', Array.from(allImages));
