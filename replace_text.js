const fs = require('fs');
const path = require('path');

const viewsDir = 'c:\\code\\cake_shop\\resources\\views';
const dirsToScan = [
    viewsDir,
    path.join(viewsDir, 'layouts'),
    path.join(viewsDir, 'shop')
];

const replacements = [
    { target: /Kerala/g, replace: 'UAE' },
    { target: /\+91 98955 88988/g, replace: '000000' },
    { target: /919895588988/g, replace: '000000' },
    { target: /0484 2767660/g, replace: '000000' },
    { target: /Bespoke/g, replace: 'Custom' },
    { target: /bespoke/g, replace: 'custom' },
    { target: /Collections/g, replace: 'Cakes' }
];

function processDir(dir) {
    if (!fs.existsSync(dir)) return;
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isFile() && fullPath.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let modified = false;
            
            for (const {target, replace} of replacements) {
                if (target.test(content)) {
                    content = content.replace(target, replace);
                    modified = true;
                }
            }
            
            if (modified) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated: ${fullPath}`);
            }
        }
    }
}

for (const dir of dirsToScan) {
    processDir(dir);
}
console.log('Text formatting done');
