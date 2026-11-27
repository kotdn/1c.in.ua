<?php
// sitemap.xml (на 1c.in.ua — RewriteRule ^sitemap\.xml$ sitemap.php). Сторінки — inc/pages.php,
// <loc> — як canonical (abs_url), <lastmod> — дата зміни файлу сторінки.
define('B1C', true);
require __DIR__ . '/inc/config.php';
require __DIR__ . '/inc/pages.php';
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', "\n";
foreach ($PAGES as $p) {
    $file = __DIR__ . ($p === '/' ? '' : rtrim($p, '/')) . '/index.php';
    if (!is_file($file)) {
        continue;
    }
    echo "  <url>\n";
    echo '    <loc>', htmlspecialchars(abs_url($p), ENT_XML1 | ENT_QUOTES, 'UTF-8'), "</loc>\n";
    echo '    <lastmod>', date('Y-m-d', filemtime($file)), "</lastmod>\n";
    echo "  </url>\n";
}
echo "</urlset>\n";
