<?php

$files = [
    'advisory-services.html' => 'advisory_services',
    'conference-hall.html' => 'conference_hall',
    'contact.html' => 'contact',
    'grievance.html' => 'grievance',
    'gst-helpdesk.html' => 'gst_helpdesk',
    'media-coverage.html' => 'media_coverage',
    'media-kit.html' => 'media_kit',
    'press-release.html' => 'press_release'
];

$routes = [];

foreach ($files as $file => $methodName) {
    if (!file_exists($file)) {
        echo "File not found: $file\n";
        continue;
    }
    
    $content = file_get_contents($file);
    
    // Extract title
    preg_match('/<title>(.*?)<\/title>/', $content, $titleMatch);
    $title = $titleMatch ? trim($titleMatch[1]) : '';
    $title = str_replace(' – P A C T Punjab & Chandigarh', '', $title);
    
    // Extract style
    preg_match('/<style>(.*?)<\/style>/s', $content, $styleMatch);
    $style = $styleMatch ? trim($styleMatch[0]) : '';
    
    // Extract body (from <div class="page-hero"> to just before footer)
    $bodyStart = strpos($content, '<div class="page-hero">');
    if ($bodyStart === false) {
        // Some pages might not have page-hero, just find <body>
        preg_match('/<body>(.*?)<\/body>/s', $content, $bodyMatch);
        $body = $bodyMatch ? trim($bodyMatch[1]) : '';
        // Remove header and footer includes
        $body = preg_replace('/<!--\s*<\?php include \'includes\/(header|footer)\.php\'; \?>\s*-->/i', '', $body);
    } else {
        $footerPos = strpos($content, '<!-- <?php include \'includes/footer.php\'; ?> -->');
        if ($footerPos === false) {
            $footerPos = strpos($content, '</body>');
        }
        $body = substr($content, $bodyStart, $footerPos - $bodyStart);
    }
    
    // Replace index.html with route('home')
    $body = str_replace('href="index.html"', 'href="{{ route(\'home\') }}"', $body);
    // Replace become-member.html with route('become-member')
    $body = str_replace('href="become-member.html"', 'href="{{ route(\'become-member\') }}"', $body);
    $body = str_replace('href="profile.html"', 'href="{{ route(\'profile\') }}"', $body);
    
    $bladeName = str_replace('.html', '.blade.php', str_replace('-', '_', $file));
    $bladePath = "resources/views/frontend/$bladeName";
    
    $bladeContent = "@extends('layouts.frontend')\n";
    $bladeContent .= "@section('title', '$title')\n\n";
    $bladeContent .= "@section('content')\n";
    if ($style) {
        $bladeContent .= "$style\n\n";
    }
    $bladeContent .= $body . "\n";
    $bladeContent .= "@endsection\n";
    
    file_put_contents($bladePath, $bladeContent);
    echo "Created: $bladePath\n";
    
    $routePath = '/' . str_replace('.html', '', $file);
    $routeName = str_replace('.html', '', $file);
    $routes[] = "Route::get('$routePath', [FrontendController::class, '$methodName'])->name('$routeName');";
}

echo "\n--- Routes ---\n";
echo implode("\n", $routes) . "\n";
echo "\n--- Controller Methods ---\n";
foreach ($files as $file => $methodName) {
    $viewName = 'frontend.' . str_replace('.html', '', str_replace('-', '_', $file));
    echo "    public function $methodName()\n    {\n        return view('$viewName');\n    }\n\n";
}

// Optionally delete original html files
foreach (array_keys($files) as $file) {
    if (file_exists($file)) {
        unlink($file);
    }
}
echo "Cleaned up HTML files.\n";

?>
