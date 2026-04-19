        
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>NHPC Admin- SAP_View Materials - <?= esc($moduleName) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #004672;
            --primary-medium: #00659bff;
            --primary-dark: #00314d;
            --secondary:rgb(41, 140, 179);
            --accent: #A4BDCD;
            --warning: #f59e0b;
            --danger: #ef4444;
            --surface: #FEFEFE;
            --surface-alt: #f8fafc;
            --surface-hover: #eaf3f8;
            --border: #A4BDCD;
            --border-light: #eaf3f8;
            --text-primary: #004672;
            --text-secondary:rgb(10, 104, 142);
            --text-muted: #A4BDCD;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-weight: 400;
            line-height: 1.6;
        }

        .main-container {
            background: var(--surface);
            min-height: 100vh;
            margin: 0;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.2rem 0;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 2rem; 
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0.25rem 0 0 0;
            font-weight: 300;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 500px 1fr; /* narrower sidebar */
            min-height: calc(100vh - 70px);
            position: relative;
            height: calc(100vh - 70px);
        }
        
        .sidebar {
            background: var(--surface-alt);
            border-right: 1px solid var(--border);
            padding: 1rem 1rem 1rem 1rem; /* less padding */
            overflow-y: auto;
            height: 100%;
            min-width: 220px;
            max-width: 600px;
            resize: none;
        }
        
        .resizer {
            width: 6px;
            background: #e2e8f0;
            cursor: col-resize;
            position: absolute;
            left: 500px; /* initial, will be set by JS */
            top: 0;
            bottom: 0;
            z-index: 10;
            transition: background 0.2s;
        }
        
        .resizer:hover, .resizer.active {
            background: var(--primary);
        }

        .main-content {
            background: var(--surface);
            
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 100%;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
            padding: 1rem 1rem;
        }

        .sidebar-header {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 0.5rem 0.7rem;
            margin-bottom: 0.7rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
        }

        .sidebar-title {
            font-size: 1.08rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .topic-card {
            background: var(--surface);
            
            border-left: 3px solid var(--accent);
            border-radius: var(--radius);
            margin-bottom: 0.12rem;
            padding: 0.08rem 0.3rem 0.12rem 0.3rem;
            position: relative;
            
            display: flex;
            flex-direction: column;
            gap: 0.05rem;
            animation: fadeIn 0.3s ease;
        }
        .topic-card:hover{
            background: var(--surface) !important;
            box-shadow: var(--shadow);
            transform: translateY(-1px) scale(1.01);
            border: none;
            outline: none;
            z-index: 2;
            border-left: 4px solid var(--primary);
            border-radius: 0;
        }

        .topic-header {
            background: var(--surface-alt);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            flex-direction: row;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
            gap: 0.5rem;
            padding-right: 0.2rem;
        }

        .topic-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.98rem;
            margin: 0;
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .toggle-btn {
            background: var(--surface-alt);
            color: var(--text-secondary);
            border: none;
            min-width: 22px;
            width: 22px;
            height: 22px;
            border-radius: 75%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1rem;
            font-weight: 600;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }

        .toggle-btn:hover {
            background: var(--accent-dark);
            transform: scale(1.1);
        }

        .materials-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: var(--surface);
            display: block;
        }

        .materials-list.show {
            max-height: 1000px;
            display: block;
            background: #f8fafc;
            
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        .material-item {
            padding: 0.45rem 0.7rem;
            border-bottom: 1px solid var(--border-light);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.92rem;
            color: var(--text-primary);
        }

        .material-item:hover, .material-item.selected {
            background: #e8f0fe;
            color: var(--primary);
        }

        .material-item .file-badge {
            background: none;
            border: none;
            color: inherit;
            width: 18px;
            height: 18px;
            font-size: 0.82rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .material-title {
            font-weight: 500;
            flex: 1;
            color: inherit;
            text-decoration: none;
        }

        .material-title:hover {
            text-decoration: none;
            color: inherit;
        }

        .viewer-section {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
            flex: 1 1 0;
            display: flex;
            flex-direction: column;
            overflow: visible;
            margin-bottom: 2rem;
            min-height: 100%;
        }

        .viewer-header {
            background: var(--surface-alt);
            padding: 0.6rem 1rem;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .viewer-title {
            font-size: 1.08rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .viewer-content {
            flex: 1 1 0;
            width: 100%;
            height: 100%;
            min-height: 0;
            max-height: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            box-shadow: none;
            border: none;
        }

        .viewer-placeholder {
            width: 100%;
            max-width: 340px;
            margin: 0 auto;
            background: #f8fafc;
            border-radius: 16px;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
            padding: 1.2rem 1.2rem 1.5rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .viewer-placeholder i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .viewer-placeholder h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0.2rem 0 0.5rem 0;
        }
        .viewer-placeholder p {
            font-size: 0.97rem;
            color: var(--text-muted);
            margin: 0 0 1rem 0;
            text-align: center;
        }

        .viewer-content iframe,
        .viewer-content video {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 8px;
            background: #fff;
        }

        .loading-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
        }

        .loading-spinner {
            width: 28px;
            height: 28px;
            border: 2px solid var(--border);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 1rem;
            color: var(--text-muted);
            font-style: italic;
        }

        .empty-state i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            opacity: 0.5;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
                height: auto;
            }
            
            .sidebar {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1.5rem 0;
            }
            
            .header h1 {
                font-size: 1.75rem;
            }
            
            .sidebar, .main-content {
                padding: 1rem;
            }
            
            .viewer-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        .collapse-all-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            margin-left: 0.5rem;
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }
        .collapse-all-btn:hover {
            color: var(--surace);
            transform: scale(1.05);
            transition: color 0.2s, transform 0.2s;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--surface-alt);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        /* Focus States */
        *:focus {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .toggle-btn:focus,
        .back-btn:focus {
            outline: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .topic-card {
            animation: fadeIn 0.3s ease;
        }

        .simple-material-item {
            background: none;
            border: none;
            box-shadow: none;
            padding: 0.75rem 1.25rem;
            margin: 0.25rem 0;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            color: var(--text-primary);
            transition: background 0.2s;
        }

        .simple-material-item:hover, .simple-material-item.selected {
            background: #e8f0fe; /* even lighter blue for hover/selected */
            color: var(--accent-dark);
        }

        .simple-material-item .file-badge {
            background: none;
            border: none;
            color: inherit;
            width: 28px;
            height: 28px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
                <div class="header-content" style="display: flex; align-items: center; gap: 1.2rem;">
                    <img src="<?= base_url('uploads/NHPC_logo.png') ?>" alt="NHPC Logo" style="height: 40px; width: auto; object-fit: contain; display: block; box-shadow: 0 2px 8px rgba(255, 255, 255, 0.07); background: transparent; margin-left: 1rem;" />
                    <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="header-logo" style="height: 40px; width: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 1px; object-fit: contain;" />
                    <h1 style="display: flex; align-items: center;">
                        <span class="module-title">Module: <?= esc($moduleName) ?></span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="sidebar" id="sidebarPanel">
                <div class="topics-section" style="background: var(--surface); border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--border-light); overflow: hidden; padding: 0; min-height: 100%;">
                    <div class="topics-header" style="background: var(--primary-medium); color: #fff; padding: 0.6rem 1rem; border-bottom: 1px solid var(--border); font-weight: 600; display: flex; align-items: center; gap: 0.5rem; position: relative; border-radius: var(--radius) var(--radius) 0 0;">
                        <i class="fas fa-list-ul"></i>
                        <span>Topics & Materials</span>

                        <button class="collapse-all-btn" id="collapseAllBtn" title="Collapse All Modules" aria-label="Collapse All Modules">
                            <i class="fas fa-compress-alt"></i>
                        </button>
                    </div>
                    <div class="modules-content" style="padding: 0.5rem; max-height: none; min-height: 65vh;">
                        <?php if (!empty($groupedMaterials)): ?>
                            <?php foreach ($groupedMaterials as $topicName => $materials): ?>
                                <?php $safeId = md5($topicName); ?>
                                <div class="topic-card" id="card-<?= $safeId ?>" style="background: #f6fafd; border: none; outline: none; transition: background 0.18s; border-left: 4px solid var(--accent); border-radius: 0; font-size: 0.97rem; min-height: 32px; margin-bottom: 0.12rem;">
                                    <div class="topic-header" style="padding: 0.12rem 0.35rem 0.12rem 0.18rem; background: var(--surface-alt); border-bottom: none; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 0.98rem;">
                                        <div class="topic-title topic-name" style="font-weight: 600; color: var(--text-primary); font-size: 0.98rem; margin: 0; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" onclick="toggleTopic('<?= $safeId ?>')"><?= esc($topicName) ?></div>
                                        <button class="toggle-btn" id="toggle-icon-<?= $safeId ?>"
                                                aria-expanded="false" aria-label="Toggle materials"
                                                onclick="toggleTopic('<?= $safeId ?>')"
                                                style="background: none; color: var(--primary); border: none; width: auto; height: auto; border-radius: 0; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: color 0.2s; font-size: 1.08rem; padding: 0 0.12rem; font-weight: 700;">
                                            +
                                        </button>
                                    </div>
                                    <div class="materials-list" id="topic-materials-<?= $safeId ?>" style="padding: 0.08rem 0 0.08rem 1.1rem; background: var(--surface); border-top: none; max-height: 1000px; display: block; border-radius: 0; box-shadow: none;">
                                        <?php foreach ($materials as $file): ?>
                                            <?php
                                                $type = strtolower($file['file_type'] ?? '');
                                                switch ($type) {
                                                    case 'video':
                                                    case 'mp4':
                                                        $icon = 'fa-video';
                                                        $iconColor = '#2563eb';
                                                        break;
                                                    case 'pdf':
                                                        $icon = 'fa-file-pdf';
                                                        $iconColor = '#ef4444';
                                                        break;
                                                    case 'excel':
                                                    case 'xls':
                                                    case 'xlsx':
                                                        $icon = 'fa-file-excel';
                                                        $iconColor = '#10b981';
                                                        break;
                                                    case 'ppt':
                                                    case 'pptx':
                                                        $icon = 'fa-file-powerpoint';
                                                        $iconColor = '#f59e0b';
                                                        break;
                                                    case 'word':
                                                    case 'doc':
                                                    case 'docx':
                                                        $icon = 'fa-file-word';
                                                        $iconColor = '#3b82f6';
                                                        break;
                                                    case 'zip':
                                                    case 'rar':
                                                        $icon = 'fa-file-archive';
                                                        $iconColor = '#a3a3a3';
                                                        break;
                                                    case 'txt':
                                                        $icon = 'fa-file-alt';
                                                        $iconColor = '#64748b';
                                                        break;
                                                    case 'image':
                                                    case 'jpg':
                                                    case 'jpeg':
                                                    case 'png':
                                                    case 'gif':
                                                        $icon = 'fa-file-image';
                                                        $iconColor = '#10b981';
                                                        break;
                                                    case 'audio':
                                                    case 'mp3':
                                                    case 'wav':
                                                        $icon = 'fa-file-audio';
                                                        $iconColor = '#f59e42';
                                                        break;
                                                    default:
                                                        $icon = 'fa-file';
                                                        $iconColor = 'var(--text-muted)';
                                                }
                                            ?>
                                            <div class="material-item" onclick="loadMaterial('<?= esc($type) ?>', '<?= esc($file['file_path']) ?>', this)">
                                                <i class="fas <?= $icon ?>" style="color: <?= $iconColor ?>; font-size: 1.1rem;"></i>
                                                <span class="material-title" style="font-weight: 500; flex: 1 1 0; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color: inherit; text-decoration: none;"><?= esc($file['title']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h4>कोई सामग्री नहीं मिली</h4>
                                <p>No materials found for this module</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="resizer" id="resizerPanel" tabindex="0" aria-label="Resize sidebar"></div>
            <div class="main-content">
                <div class="viewer-section">
                    <div class="viewer-header">
                        <h4 class="viewer-title">
                            <i class="fas fa-eye"></i>
                            Material Viewer
                        </h4>
                    </div>
                    <div class="viewer-content" id="viewer">
                        <div class="viewer-placeholder">
                            <i class="fas fa-mouse-pointer"></i>
                            <h4>Select a material to view</h4>
                            <p>Choose any file from the topics on the left to preview it here. Supports PDFs, videos, documents, and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const materialServeUrl = "<?= site_url('materials/serve') ?>";

        function detectFileType(path) {
            if (!path) return 'unknown';
            const lower = path.toLowerCase();
            if (lower.endsWith('.pdf')) return 'pdf';
            if (lower.endsWith('.mp4') || lower.endsWith('.mov') || lower.endsWith('.avi') || lower.endsWith('.mkv')) return 'video';
            if (lower.endsWith('.xlsx') || lower.endsWith('.xls')) return 'excel';
            if (lower.endsWith('.ppt') || lower.endsWith('.pptx')) return 'ppt';
            if (lower.endsWith('.doc') || lower.endsWith('.docx')) return 'word';
            if (lower.endsWith('.zip') || lower.endsWith('.rar')) return 'zip';
            return 'other';
        }
        function normalizePath(path) {
            // Replace all backslashes with forward slashes
            path = path.replace(/\\/g, '/');
            // Ensure there is exactly one slash between uploads and materials
            path = path.replace(/uploads[\/]+materials[\/]+/i, 'uploads/materials/');
            // If missing, insert slashes between uploads, materials, and filename
            path = path.replace(/uploads([^/])/, 'uploads/$1');
            path = path.replace(/materials([^/])/, 'materials/$1');
            return path;
        }
        function loadMaterial(type, path, element = null) {
            type = detectFileType(path);
            const viewer = document.getElementById("viewer");
            
            // Remove selection from all material items
            document.querySelectorAll('.material-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            // Add selection to clicked item if available
            if (element) {
                element.classList.add('selected');
            }
            
            // Loading state
            viewer.innerHTML = `
                <div class="viewer-placeholder">
                    <div class="loading-spinner" style="border-top-color: var(--accent); width: 40px; height: 40px; margin-bottom: 1rem;"></div>
                    <h4>Loading content...</h4>
                </div>
            `;
            
            setTimeout(() => {
                const fileExt = path.split('.').pop().toLowerCase();
                const urlPath = normalizePath(path);
                // Helper for file type label
                function getFileTypeLabel(ext) {
                    switch(ext) {
                        case 'pdf': return 'PDF Document';
                        case 'mp4': case 'mov': case 'avi': case 'mkv': return 'Video File';
                        case 'xlsx': case 'xls': return 'Excel File';
                        case 'ppt': case 'pptx': return 'PowerPoint File';
                        case 'doc': case 'docx': return 'Word Document';
                        case 'zip': case 'rar': return 'Archive File';
                        case 'txt': return 'Text File';
                        case 'jpg': case 'jpeg': case 'png': case 'gif': return 'Image File';
                        case 'mp3': case 'wav': return 'Audio File';
                        default: return 'Downloadable File';
                    }
                }
                if (type === 'pdf') {
                    viewer.innerHTML = `
                        <iframe src="${materialServeUrl}?path=${encodeURIComponent(urlPath)}#toolbar=0" width="100%" height="500px" style="border:none;border-radius:var(--radius-sm);"></iframe>
                    `;
                } else if (type === 'video') {
                    viewer.innerHTML = `<video controls style="width:100%;height:100%;border-radius:var(--radius-sm);"><source src="${materialServeUrl}?path=${encodeURIComponent(urlPath)}" type="video/mp4"></video>`;
                } else {
                    // For all other types, show a styled card with file type label and prominent download button
                    const fileTypeLabel = getFileTypeLabel(fileExt);
                    viewer.innerHTML = `
                        <div style="background: #f1f5f9; border-radius: 12px; padding: 2.5rem 2rem 1.5rem 2rem; max-width: 400px; margin: 0 auto; box-shadow: var(--shadow); text-align: center;">
                            <i class="fas fa-file" style="font-size: 2.5rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                            <div style="font-size: 1.1rem; color: #64748b; font-weight: 600; margin-bottom: 0.5rem;">${fileTypeLabel}</div>
                            <a href="${materialServeUrl}?path=${encodeURIComponent(urlPath)}" download target="_blank" rel="noopener" class="back-btn" style="background: #64748b; color: #fff; border-radius: 8px; padding: 0.75rem 2rem; font-weight: 600; text-decoration: none; max-width: 250px; width: 100%; text-align: center; display: inline-block; margin-top: 1.2rem;">
                                <i class="fas fa-download me-2"></i>Download File
                            </a>
                        </div>
                    `;
                }
            }, 400);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Collapse all materials lists and set + sign
    document.querySelectorAll('.materials-list').forEach(function(list) {
        list.classList.remove('show');
        list.style.display = 'none';
    });
    document.querySelectorAll('.toggle-btn').forEach(function(btn) {
        btn.textContent = '+';
        btn.setAttribute('aria-expanded', 'false');
    });
    // Add click handler to topic header for toggling
    document.querySelectorAll('.topic-header').forEach(function(header) {
        header.addEventListener('click', function(e) {
            if (e.target.classList.contains('toggle-btn')) return;
            const parent = header.parentElement;
            if (parent && parent.id && parent.id.startsWith('card-')) {
                const id = parent.id.replace('card-', '');
                toggleTopic(id);
            }
        });
    });
});

function toggleTopic(id) {
    const materialsList = document.getElementById('topic-materials-' + id);
    const toggleIcon = document.getElementById('toggle-icon-' + id);
    if (!materialsList) return;
    if (materialsList.classList.contains('show')) {
        materialsList.classList.remove('show');
        materialsList.style.display = 'none';
        if (toggleIcon) {
            toggleIcon.textContent = '+';
            toggleIcon.setAttribute('aria-expanded', 'false');
        }
    } else {
        materialsList.classList.add('show');
        materialsList.style.display = 'block';
        if (toggleIcon) {
            toggleIcon.textContent = '−';
            toggleIcon.setAttribute('aria-expanded', 'true');
        }
    }
}
    </script>

    <script>
        // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            if (e.target.classList.contains('material-item')) {
                e.preventDefault();
                e.target.click();
            }
        }
    });

    // Remove auto-expand logic and ensure all topics are collapsed by default
    document.addEventListener('DOMContentLoaded', function() {
        // Collapse all materials lists and set + sign
        document.querySelectorAll('.materials-list').forEach(function(list) {
            list.classList.remove('show');
            list.style.display = 'none';
        });
        document.querySelectorAll('.toggle-btn').forEach(function(btn) {
            btn.textContent = '+';
            btn.setAttribute('aria-expanded', 'false');
        });
        // Add click handler to topic header for toggling
        document.querySelectorAll('.topic-header').forEach(function(header) {
            header.addEventListener('click', function(e) {
                if (e.target.classList.contains('toggle-btn')) return;
                const parent = header.parentElement;
                if (parent && parent.id && parent.id.startsWith('card-')) {
                    const id = parent.id.replace('card-', '');
                    toggleTopic(id);
                }
            });
        });
    });

    // Resizer logic for sidebar/main-content
    const sidebar = document.getElementById('sidebarPanel');
    const resizer = document.getElementById('resizerPanel');
    const contentWrapper = document.querySelector('.content-wrapper');
    let isResizing = false;
    let startX, startWidth;

    function syncResizer() {
        const sidebarWidth = sidebar.offsetWidth;
        resizer.style.left = sidebarWidth + 'px';
    }

    resizer.addEventListener('mousedown', function(e) {
        isResizing = true;
        startX = e.clientX;
        startWidth = sidebar.offsetWidth;
        document.body.style.cursor = 'col-resize';
        resizer.classList.add('active');
    });
    document.addEventListener('mousemove', function(e) {
        if (!isResizing) return;
        let newWidth = startWidth + (e.clientX - startX);
        newWidth = Math.max(180, Math.min(600, newWidth));
        sidebar.style.width = newWidth + 'px';
        contentWrapper.style.gridTemplateColumns = `${newWidth}px 1fr`;
        syncResizer();
    });
    document.addEventListener('mouseup', function() {
        if (isResizing) {
            isResizing = false;
            document.body.style.cursor = '';
            resizer.classList.remove('active');
        }
    });
    window.addEventListener('resize', syncResizer);
    document.addEventListener('DOMContentLoaded', syncResizer);
    setTimeout(syncResizer, 100);
    </script>
</body>
</html>