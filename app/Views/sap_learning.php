<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>NHPC- SAP Learning Portal</title>
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
            line-height: 1.5; /* slightly more compact */
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
            padding: 1.2rem 0; /* less vertical padding */
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
            font-size: 2rem; /* smaller */
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
            left: 500px; /* will be set dynamically in JS */
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
            padding: 1rem;
            display: flex;
            flex-direction: column;
            overflow: visible;
            height: auto;
        }
        
        .search-section {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 0.75rem 1rem 0.75rem 1rem; 
            box-shadow: var(--shadow-sm);
            margin-bottom: 0.75rem; 
            border: 1px solid var(--border-light);
        }
        
        .search-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 0.5rem;
        }
        
        .form-label {
            margin-bottom: 0.25rem;
            font-size: 0.82rem;
        }
        
        .form-control {
            padding: 0.5rem 0.75rem;
            font-size: 0.97rem;
        }
        
        .search-btn {
            padding: 0.35rem 0.75rem;
            font-size: 0.97rem;
            margin-top: 0.25rem;
            border-radius: 8px;
            background: var(--primary-medium);
            color: #fff;
            border: none;
            font-weight: 600;
            box-shadow: 0 2px 8px 0 rgba(59,130,246,0.08);
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background 0.18s, box-shadow 0.18s, color 0.18s;
        }
        .search-btn i {
            font-size: 1.15rem;
            margin-right: 0.5rem;
            color: #fff;
            display: inline-block;
        }
        .search-btn:hover, .search-btn:focus {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 16px 0 rgba(59,130,246,0.13);
            outline: none;
        }
        .search-btn[aria-busy="true"] {
            opacity: 0.7;
            pointer-events: none;
        }
        
        .results-section {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 0.75rem;
            border: 1px solid var(--border-light);
            overflow: hidden;
        }
        
        .results-header {
            background: var(--surface-alt);
            padding: 0.5rem 1rem;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .results-content {
            max-height: 350px;
            overflow-y: auto;
            padding: 0.5rem 0.5rem 0.5rem 0.5rem;
        }
        
        .modules-section {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
            overflow: hidden;
            padding: 0;
            min-height: 100%;
        }
        .modules-header {
            background: var(--primary-medium);
            color: #fff;
            padding: 0.6rem 1rem;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .module-title {
            font-weight: 500;
            color: var(--text-primary);
            font-size: 1.01rem;
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
        .modules-content {
            padding: 0.5rem;
            max-height: none;
            min-height: 65vh;
        }
        
        .module-card {
            margin-bottom: 0.12rem;
            
            border: none;
            outline: none;
            transition: background 0.18s;
            border-left: 4px solid var(--accent);
            border-radius: 0;
            font-size: 0.97rem;
            min-height: 32px;
        }
        /* Use :nth-of-type for more reliable alternate coloring */
        #modulesContainer > .module-card:nth-of-type(even) {
            background: #f6fafd;
        }
        #modulesContainer > .module-card:nth-of-type(odd) {
            background: #f0f4fa;
        }
        .module-card.selected,
        .module-card:focus {
            background: var(--surface-hover) !important;
            outline: none;
            border: none;
            border-left: 4px solid var(--primary);
            border-radius: 0;
        }

        .module-card:hover {
            background: var(--surface-hover) !important;
            box-shadow: var(--shadow);
            transform: translateY(-1px) scale(1.01);
            border: none;
            outline: none;
            z-index: 2;
            border-left: 4px solid var(--primary);
            border-radius: 0;
        }
        
        .module-header {
            padding: 0.12rem 0.35rem 0.12rem 0.18rem;
            background: var(--surface-alt);
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: 0.98rem;
        }
        
        .expand-btn {
            background: none;
            color: var(--primary);
            border: none;
            min-width: 22px;
            width: 22px;
            height: 22px;
            border-radius: 75%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: color 0.2s;
            font-size: 1.08rem;
            padding: 0 0.12rem;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }
        .expand-btn:hover {
            color: var(--primary-dark);
            background: none;
            transform: none;
        }
        
        .topics-list {
            background: var(--surface);
            padding-left: 0.7rem;
        }
        
        .topic-item {
            padding: 0.12rem 0.35rem 0.12rem 0.18rem;
            border-bottom: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.96rem;
        }
        .topic-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.96rem;
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .material-title {
            font-weight: 500;
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: inherit;
            text-decoration: none;
        }
        
        .materials-list {
            padding: 0.08rem 0 0.08rem 1.1rem;
            background: var(--surface);
            border-top: none;
        }
        
        .material-item {
            padding: 0.10rem 0.28rem;
            margin: 0.04rem 0.08rem;
            font-size: 0.95rem;
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
            font-weight: 500;
            margin: 0.2rem 0 0.5rem 0;
        }
        .viewer-placeholder p {
            font-size: 0.97rem;
            color: var(--text-muted);
            margin: 0 0 1rem 0;
            text-align: center;
        }
        .viewer-placeholder .download-btn, .viewer-placeholder button, .viewer-placeholder a.btn {
            font-size: 0.85rem;
            padding: 0.2rem 0.7rem;
            border-radius: 4px;
            background: #6c7280;
            color: #fff;
            border: none;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.04);
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        .viewer-placeholder .download-btn:hover, .viewer-placeholder button:hover, .viewer-placeholder a.btn:hover {
            background: var(--primary-dark);
            color: #fff;
        }
        .viewer-content iframe,
        .viewer-content video {
            width: 100% !important;
            height: 100% !important;
            min-height: 0 !important;
            max-height: none !important;
            border-radius: 0 !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            margin: 0 !important;
            padding: 0 !important;
            display: block;
            background: none;
        }
        
        .dropdown-menu {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem 0;
            max-height: 300px;
            overflow-y: auto;
            margin-top: 0.25rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        
        .dropdown-item:hover {
            background: var(--surface-hover);
            color: var(--primary);
        }
        
        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 0.5rem;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .empty-state {
            text-align: center;
            padding: 1rem;
            color: var(--text-muted);
            font-style: italic;
        }
        
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: var(--radius-sm);
            height: 60px;
            margin-bottom: 0.5rem;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Flip card styles for left panel (now for unified card) */
        .flip-card-container {
            perspective: 1200px;
            width: 100%;
            min-height: 420px;
            flex: 1 0 auto;
            position: relative;
        }
        .flip-card {
            width: 100%;
            height: 100%;
            min-height: 420px;
            position: relative;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }
        .flip-card.flipped {
            transform: rotateY(-180deg);
        }
        .flip-card-front {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0; left: 0;
            backface-visibility: hidden;
            z-index: 1;
            background: var(--surface); 
            border-radius: var(--radius);

        } 
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0; left: 0;
            backface-visibility: hidden;
            z-index: 1;
            background: var(--surface-alt); /* transparent card */
            border-radius: var(--radius);
           
            
        }
        .flip-card-back {
            transform: rotateY(-180deg);
            z-index: 1;
        }
        /* Ensure card fills sidebar */
        .sidebar .flip-card-container, .sidebar .flip-card, .sidebar .flip-card-front, .sidebar .flip-card-back {
            min-height: unset;
            height: 100%;
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
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 1rem 0;
            }
            
            .header h1 {
                font-size: 1.2rem;
            }
            
            .sidebar, .main-content {
                padding: 0.5rem;
            }
            
            .search-section, .modules-section {
                padding: 0.5rem;
            }
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
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
        
        .form-control:focus,
        .search-btn:focus,
        .expand-btn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
                <div class="header-content" style="display: flex; align-items: center; gap: 1.1rem;">
                    <img src="<?= base_url('uploads/NHPC_logo.png') ?>" alt="NHPC Logo" style="height: 40px; width: auto; object-fit: contain; display: block; box-shadow: 0 2px 8px rgba(255, 255, 255, 0.07); background: transparent; margin-left: 1rem;" />
                    <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="header-logo" style="height: 40px; width: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 1px; object-fit: contain; display: block;" />
                    <h1 style="margin: 0; font-size: 2rem; font-weight: 700; line-height: 1;">SAP Learning Portal</h1>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="sidebar" id="sidebarPanel">
                <div class="flip-card-container">
                    <div class="flip-card" id="sidebarFlipCard">
                        <div class="flip-card-front">
                            <div class="modules-section">
                                <div class="modules-header">
                                    <span>
                                        <i class="fas fa-layer-group"></i>
                                        उपलब्ध मॉड्यूल (Available Modules)
                                    </span>
                                    <button class="collapse-all-btn" id="collapseAllBtn" title="Collapse All Modules" aria-label="Collapse All Modules">
                                        <i class="fas fa-compress-alt"></i>
                                    </button>
                                    <i class="fas fa-search" id="flipToSearchBtn" title="Search Modules/Topics" style="font-size: 1.2rem; color: #fff; cursor: pointer; margin-left: auto;"></i>
                                </div>
                                <div class="modules-content">
                                    <div id="modulesContainer">
                                        <!-- Module list will be rendered here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div style="height:100%; display: flex; flex-direction: column; gap: 1.2rem; background: transparent; box-shadow: none; border: none;">
                                <div class="search-section" style="border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--border-light); background: rgba(255,255,255,0.85);">
                                    <div class="search-title" style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><i class="fas fa-search"></i> खोज केंद्र (Search Center)</span>
                                        <i class="fas fa-layer-group" id="flipToModulesBtn" style="font-size: 1.5rem; color: var(--primary); cursor: pointer; margin-left: auto;"></i>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="module" class="form-label">मॉड्यूल चुनें (Select Module)</label>
                                        <input type="text" class="form-control" id="module" autocomplete="off" 
                                            aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                            placeholder="Type to search modules...">
                                        <ul class="dropdown-menu" id="moduleList" aria-labelledby="module" role="listbox"></ul>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="topic" class="form-label">विषय चुनें (Select Topic)</label>
                                        <input type="text" class="form-control" id="topic" autocomplete="off" 
                                            aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                            placeholder="Type to search topics...">
                                        <ul class="dropdown-menu" id="topicList" aria-labelledby="topic" role="listbox"></ul>
                                    </div>
                                    <button class="search-btn" id="searchBtn" onclick="searchMaterials()" aria-busy="false">
                                        <i class="fas fa-search me-2"></i>
                                        खोजें (Search)
                                        <span id="searchSpinner" class="loading-spinner" style="display: none;"></span>
                                    </button>
                                </div>
                                <div class="results-section" style="border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--border-light); background: rgba(255,255,255,0.85);">
                                    <div class="results-header">
                                        <i class="fas fa-list-ul"></i>
                                        परिणाम (Results)
                                    </div>
                                    <div class="results-content">
                                        <div id="resultsList">
                                            <div class="empty-state">कोई खोज नहीं की गई (No search performed)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="resizer" id="resizerPanel" tabindex="0" aria-label="Resize sidebar"></div>
            <div class="main-content" style="overflow-y: auto; max-height: 100vh;">
                <!-- Removed search toggle and search panel -->
                <div class="viewer-section">
                    <div class="viewer-header">
                        <i class="fas fa-eye"></i>
                        सामग्री दर्शक (Material Viewer)
                    </div>
                    <div class="viewer-content" id="viewer">
                        <div class="viewer-placeholder">
                            <i class="fas fa-mouse-pointer"></i>
                            <h4>Select a material to view</h4>
                            <p>Choose any file from the topics on the left to preview it here.<br> 
                                Supports PDFs, videos, documents, and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrls = {
            fetchModules: "<?= site_url('sap/fetch-modules') ?>",
            fetchTopics: "<?= site_url('sap/fetch-topics') ?>",
            search: "<?= site_url('sap/search') ?>",
            modulesWithTopics: "<?= site_url('sap/fetch-modules-with-topics') ?>"
        };

        let modulesWithTopics = [];
        let availableModules = [];
        let availableTopics = [];

        function fetchAllModulesAndTopics() {
            fetch(baseUrls.modulesWithTopics)
                .then(response => response.json())
                .then(data => {
                    modulesWithTopics = data;
                    availableModules = data.map(m => m.name);
                    availableTopics = Array.from(new Set(data.flatMap(m => m.topics.map(t => t.name))));
                    setupDropdownWithFocusAndFilter('module', availableModules);
                    topicDropdownRenderFn = setupDropdownWithFocusAndFilter('topic', availableTopics, true);
                    setupContextSensitiveTopicDropdown();
                });
        }

        function setupContextSensitiveTopicDropdown() {
            const moduleInput = document.getElementById('module');
            const topicInput = document.getElementById('topic');

            function updateTopicDropdown() {
                const modVal = moduleInput.value.trim();
                const topicVal = topicInput.value.trim();
                let filteredTopics = availableTopics;

                // Requirement 1: only module filled and topic is empty
                if (modVal && !topicVal) {
                    const mod = modulesWithTopics.find(m => m.name.toLowerCase() === modVal.toLowerCase());
                    filteredTopics = mod ? mod.topics.map(t => t.name) : [];
                } else if(!modVal) {
                    filteredTopics = availableTopics;
                }
                // Requirement 2: module empty, show all topics
                else if (topicVal) {
                    filteredTopics = filteredTopics.filter(t => t.toLowerCase().includes(topicVal.toLowerCase()));
                }
                
                topicDropdownRenderFn && topicDropdownRenderFn(''); // always clear first
                topicDropdownRenderFn && topicDropdownRenderFn(topicVal);

                if (showDropdown && topicDropdownRenderFn) {
                    topicDropdownRenderFn(topicVal);
                }
            }

            // Listen for changes in both module and topic
            moduleInput.addEventListener('input', function() { updateTopicDropdown(); });
            topicInput.addEventListener('input', function() { updateTopicDropdown(); });
            topicInput.addEventListener('focus', function() { updateTopicDropdown(true); }); // <-- KEY!
        }

        function showDropdownOnFocus(inputId, dataList) {
            const input = document.getElementById(inputId);
            const list = document.getElementById(inputId + 'List');
            input.addEventListener('focus', function() {
                list.innerHTML = '';
                dataList.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'dropdown-item';
                    li.tabIndex = 0;
                    li.setAttribute('role', 'option');
                    li.textContent = item;
                    li.onclick = () => {
                        input.value = item;
                        list.innerHTML = '';
                        list.classList.remove('show');
                        input.setAttribute('aria-expanded', 'false');
                    };
                    li.onkeydown = e => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            input.value = item;
                            list.innerHTML = '';
                            list.classList.remove('show');
                            input.setAttribute('aria-expanded', 'false');
                        }
                    };
                    list.appendChild(li);
                });
                if (dataList.length > 0) {
                    list.classList.add('show');
                    input.setAttribute('aria-expanded', 'true');
                }
            });
        }
        let topicDropdownRenderFn = null;
        // Setup dropdown and filtering for the new search panel
        function setupDropdownWithFocusAndFilter(inputId, dataList, skipFocusHandler = false) {
            const input = document.getElementById(inputId);
            const list = document.getElementById(inputId + 'List');
            function renderDropdown(filter = '') {
                list.innerHTML = '';
                const filtered = filter
                    ? dataList.filter(item => item.toLowerCase().includes(filter.toLowerCase()))
                    : dataList;
                if (filtered.length === 0) {
                    list.innerHTML = '<li class="dropdown-item text-muted">No matches found</li>';
                } else {
                    filtered.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'dropdown-item';
                        li.tabIndex = 0;
                        li.setAttribute('role', 'option');
                        li.textContent = item;
                        li.onclick = () => {
                            input.value = item;
                            list.innerHTML = '';
                            list.classList.remove('show');
                            input.setAttribute('aria-expanded', 'false');
                        };
                        li.onkeydown = e => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                input.value = item;
                                list.innerHTML = '';
                                list.classList.remove('show');
                                input.setAttribute('aria-expanded', 'false');
                            }
                        };
                        list.appendChild(li);
                    });
                }
                if (filtered.length > 0) {
                    list.classList.add('show');
                    input.setAttribute('aria-expanded', 'true');
                } else {
                    list.classList.remove('show');
                    input.setAttribute('aria-expanded', 'false');
                }
            }

            // Only add default focus handler if not skipping
            if (!skipFocusHandler) {
                input.addEventListener('focus', function() {
                    renderDropdown('');
                });
            }
            input.addEventListener('input', function() {
                renderDropdown(this.value);
            });
            document.addEventListener('click', function(event) {
                if (!input.contains(event.target) && !list.contains(event.target)) {
                    list.classList.remove('show');
                    input.setAttribute('aria-expanded', 'false');
                }
            });
            list.addEventListener('mousedown', (e) => {
                e.preventDefault(); // Prevent input blur
            });
            return renderDropdown;
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetchAllModulesAndTopics();
            loadAvailableModules();

            // Setup dropdown and filtering for the new search panel
            fetch(baseUrls.modulesWithTopics)
                .then(response => response.json())
                .then(data => {
                    const availableModules = data.map(m => m.name);
                    const availableTopics = Array.from(new Set(data.flatMap(m => m.topics.map(t => t.name))));
                    setupDropdownWithFocusAndFilter('module', availableModules);
                    setupDropdownWithFocusAndFilter('topic', availableTopics, true);
                });

            // Collapse all modules functionality
            const collapseAllBtn = document.getElementById('collapseAllBtn');
            if (collapseAllBtn) {
                collapseAllBtn.addEventListener('click', function() {
                    // Collapse all topics lists (inside modules)
                    document.querySelectorAll('.topics-list').forEach(topicsList => {
                        topicsList.style.display = 'none';
                    });
                    // Reset all module expand icons and aria attributes
                    document.querySelectorAll('.module-header .expand-btn .expand-icon').forEach(icon => {
                        icon.textContent = '+';
                    });
                    document.querySelectorAll('.module-header .expand-btn').forEach(btn => {
                        btn.setAttribute('aria-expanded', 'false');
                    });
                    // Collapse all materials lists (inside topics)
                    document.querySelectorAll('.materials-list').forEach(materialsList => {
                        materialsList.style.display = 'none';
                    });
                    // Reset all topic expand icons and aria attributes
                    document.querySelectorAll('.topic-item .expand-btn.topic-btn .expand-icon').forEach(icon => {
                        icon.textContent = '+';
                    });
                    document.querySelectorAll('.topic-item .expand-btn.topic-btn').forEach(btn => {
                        btn.setAttribute('aria-expanded', 'false');
                    });
                });
            }

            // Keyboard navigation for accessibility
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && document.activeElement === document.getElementById('searchBtn')) {
                    searchMaterials();
                }
            });

            // Flip card logic for unified card
            const sidebarFlipCard = document.getElementById('sidebarFlipCard');
            const flipToSearchBtn = document.getElementById('flipToSearchBtn');
            const flipToModulesBtn = document.getElementById('flipToModulesBtn');
            function flipSidebarCard(toBack) {
                if (toBack) {
                    sidebarFlipCard.classList.add('flipped');
                } else {
                    sidebarFlipCard.classList.remove('flipped');
                }
            }
            if (flipToSearchBtn) {
                flipToSearchBtn.addEventListener('click', function() { flipSidebarCard(true); });
            }
            if (flipToModulesBtn) {
                flipToModulesBtn.addEventListener('click', function() { flipSidebarCard(false); });
            }
        });

        function loadAvailableModules() {
            fetch(baseUrls.modulesWithTopics)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => renderModules(data))
                .catch(error => {
                    console.error('Error loading modules:', error);
                    document.getElementById('modulesContainer').innerHTML =
                        '<div class="empty-state">त्रुटि: मॉड्यूल लोड नहीं हो सके (Error: Could not load modules)</div>';
                });
        }

        function renderModules(modules) {
            const container = document.getElementById('modulesContainer');
            if (!modules || !modules.length) {
                container.innerHTML = '<div class="empty-state">कोई मॉड्यूल उपलब्ध नहीं (No modules available)</div>';
                return;
            }
            container.innerHTML = '';
            modules.forEach(module => {
                const moduleEl = document.createElement('div');
                moduleEl.className = 'module-card';
                moduleEl.setAttribute('tabindex', '0');
                moduleEl.setAttribute('aria-label', `Module ${module.name} with ${module.topics.length} topics`);
                moduleEl.innerHTML = `
                    <div class="module-header" style="display:flex;flex-direction:row;align-items:center;gap:0.5rem;" onclick="toggleModuleTopics(this)">
                        <span class="module-title" style="display:block;">${module.name}</span>
                        <button class="expand-btn" aria-expanded="false" aria-label="Toggle topics">
                            <span class="expand-icon">+</span>
                        </button>
                    </div>
                    <div class="topics-list" style="display:none;">
                        ${module.topics.map(topicObj => `
                            <div class="topic-item" onclick="toggleTopicMaterials(this)">
                                <span class="topic-name">${topicObj.name}</span>
                                <button class="expand-btn topic-btn" aria-expanded="false" aria-label="Toggle materials">
                                    <span class="expand-icon">+</span>
                                </button>
                            </div>
                            <div class="materials-list" style="display:none;">
                                ${topicObj.materials?.map(material => {
                                    const type = (material.type || '').toLowerCase();
                                    const iconClass = getIconClassForType(type);
                                    const badgeClass = getBadgeClassForType(type);
                                    return `
                                        <div class="material-item" style="display:flex;align-items:center;gap:0.45rem;" onclick="loadMaterial('${type}', '${material.path}', this)" tabindex="0" role="button" aria-label="Open ${material.title} (${type})">
                                            <i class="fas ${iconClass}"></i>
                                            <span class="material-title">${material.title}</span>
                                        </div>
                                    `;
                                }).join('') || '<div class="empty-state small">No materials</div>'}
                            </div>
                        `).join('')}
                    </div>
                `;
                container.appendChild(moduleEl);
            });
            // Add bold logic for expanded module/topic and file hover
            // Highlight selected module title
            container.querySelectorAll('.module-header').forEach(header => {
                header.addEventListener('click', function () {
                    container.querySelectorAll('.module-title').forEach(el => el.style.fontWeight = 'normal');
                    const moduleTitle = header.querySelector('.module-title');
                    if (moduleTitle) moduleTitle.style.fontWeight = 'bold';
                });
            });

            // Highlight selected topic name
            container.querySelectorAll('.topic-item').forEach(topicItem => {
                topicItem.addEventListener('click', function () {
                    const topicsList = topicItem.closest('.topics-list');
                    if (topicsList) {
                        topicsList.querySelectorAll('.topic-name').forEach(el => el.style.fontWeight = 'normal');
                    }
                    const topicName = topicItem.querySelector('.topic-name');
                    if (topicName) topicName.style.fontWeight = 'bold';
                });
            });

            // Highlight material title on hover
            container.querySelectorAll('.material-item').forEach(materialItem => {
                materialItem.addEventListener('mouseenter', function () {
                    const materialTitle = materialItem.querySelector('.material-title');
                    if (materialTitle) materialTitle.style.fontWeight = 'bold';
                });
                materialItem.addEventListener('mouseleave', function () {
                    const materialTitle = materialItem.querySelector('.material-title');
                    if (materialTitle) materialTitle.style.fontWeight = 'normal';
                });
            });

        }

        function toggleModuleTopics(header) {
            const card = header.parentElement;
            const topicsList = card.querySelector('.topics-list');
            const btn = header.querySelector('.expand-btn');
            const icon = btn.querySelector('.expand-icon');
            const isExpanded = topicsList.style.display === 'block';
            topicsList.style.display = isExpanded ? 'none' : 'block';
            if (isExpanded) {
                icon.textContent = '+';
                btn.setAttribute('aria-expanded', 'false');
            } else {
                icon.textContent = '-';
                btn.setAttribute('aria-expanded', 'true');
            }
        }

        function toggleTopicMaterials(btn) {
            // Accept either the topic-item div or the button as argument
            let topicItem, btnEl;
            if (btn.classList.contains('topic-item')) {
                topicItem = btn;
                btnEl = topicItem.querySelector('.expand-btn.topic-btn');
            } else {
                btnEl = btn;
                topicItem = btn.closest('.topic-item');
            }
            const materialsList = topicItem.nextElementSibling;
            const icon = btnEl.querySelector('.expand-icon');
            const isExpanded = materialsList.style.display === 'block';
            materialsList.style.display = isExpanded ? 'none' : 'block';
            if (isExpanded) {
                icon.textContent = '+';
                btnEl.setAttribute('aria-expanded', 'false');
            } else {
                icon.textContent = '-';
                btnEl.setAttribute('aria-expanded', 'true');
            }
        }

        // Dropdown filtering for modules and topics with partial/fuzzy match and accessibility
        function setupDropdown(id, items) {
            const input = document.getElementById(id);
            const list = document.getElementById(id + "List");
            input.setAttribute('aria-owns', id + 'List');
            input.setAttribute('role', 'combobox');
            input.setAttribute('aria-autocomplete', 'list');
            input.setAttribute('aria-expanded', 'false');

            input.addEventListener("input", function() {
                const term = input.value.trim().toLowerCase();
                list.innerHTML = '';
                if (!term) {
                    list.classList.remove('show');
                    input.setAttribute('aria-expanded', 'false');
                    return;
                }
                const matches = items.filter(item => matchesSearch(item, term));
                if (matches.length === 0) {
                    list.innerHTML = '<li class="dropdown-item text-muted">No matches found</li>';
                } else {
                    matches.forEach((item, idx) => {
                        const li = document.createElement('li');
                        li.className = 'dropdown-item';
                        li.tabIndex = 0;
                        li.setAttribute('role', 'option');
                        li.setAttribute('aria-selected', 'false');
                        li.textContent = item;
                        li.onclick = () => {
                            input.value = item;
                            list.innerHTML = '';
                            list.classList.remove('show');
                            input.setAttribute('aria-expanded', 'false');
                        };
                        li.onkeydown = e => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                input.value = item;
                                list.innerHTML = '';
                                list.classList.remove('show');
                                input.setAttribute('aria-expanded', 'false');
                            }
                        };
                        list.appendChild(li);
                    });
                }
                list.classList.add('show');
                input.setAttribute('aria-expanded', 'true');
            });

            // Hide dropdown when clicking outside
            document.addEventListener("click", (event) => {
                if (!input.contains(event.target) && !list.contains(event.target)) {
                    list.classList.remove("show");
                    input.setAttribute('aria-expanded', 'false');
                }
            });

            list.addEventListener("mousedown", (e) => {
                e.preventDefault(); // Prevent input blur
            });
        }

        function fetchDropdownResults(term, input, list, url) {
            if (!term) {
                list.innerHTML = '<li class="dropdown-item text-muted">Type to search...</li>';
                return;
            }
            fetch(url + '?term=' + encodeURIComponent(term))
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!data || (Array.isArray(data) && data.length === 0)) {
                        list.innerHTML = '<li class="dropdown-item text-muted">No results found</li>';
                        return;
                    }
                    list.innerHTML = '';
                    (Array.isArray(data) ? data : Object.values(data)).forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'dropdown-item';
                        li.tabIndex = 0;
                        li.setAttribute('role', 'option');
                        li.textContent = item;
                        li.onclick = () => {
                            input.value = item;
                            list.innerHTML = '';
                        };
                        li.onkeydown = e => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                input.value = item;
                                list.innerHTML = '';
                            }
                        };
                        list.appendChild(li);
                    });
                })
                .catch(() => {
                    list.innerHTML = '<li class="dropdown-item text-danger">Error fetching results</li>';
                });
        }

        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Utility: Levenshtein distance for fuzzy matching
        function levenshtein(a, b) {
            const matrix = Array.from({ length: b.length + 1 }, (_, i) => [i]);
            for (let j = 0; j <= a.length; j++) matrix[0][j] = j;
            for (let i = 1; i <= b.length; i++) {
                for (let j = 1; j <= a.length; j++) {
                    if (b[i - 1] === a[j - 1]) {
                        matrix[i][j] = matrix[i - 1][j - 1];
                    } else {
                        matrix[i][j] = Math.min(
                            matrix[i - 1][j - 1] + 1,
                            matrix[i][j - 1] + 1,
                            matrix[i - 1][j] + 1
                        );
                    }
                }
            }
            return matrix[b.length][a.length];
        }

        // Enhanced search: partial and fuzzy match
        function matchesSearch(text, query) {
            if (!text || !query) return false;
            text = text.toLowerCase();
            query = query.toLowerCase();
            if (text.includes(query)) return true;
            if (levenshtein(text, query) <= 2) return true;
            return false;
        }

        function searchMaterials() {
            const moduleVal = document.getElementById("module").value.trim();
            const topicVal = document.getElementById("topic").value.trim();
            const resultsList = document.getElementById("resultsList");
            const spinner = document.getElementById("searchSpinner");
            const searchBtn = document.getElementById("searchBtn");

            if (!moduleVal && !topicVal) {
                resultsList.innerHTML = '<div class="empty-state">कृपया मॉड्यूल या विषय चुनें (Please select module or topic)</div>';
                return;
            }

            spinner.style.display = 'inline-block';
            searchBtn.setAttribute('aria-busy', 'true');

            // Use backend search endpoint for robust filtering
            const params = new URLSearchParams();
            if (moduleVal) params.append('module', moduleVal);
            if (topicVal) params.append('topic', topicVal);
            fetch(baseUrls.search + '?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    spinner.style.display = 'none';
                    searchBtn.setAttribute('aria-busy', 'false');
                    if (!Array.isArray(data) || data.length === 0) {
                        resultsList.innerHTML = '<div class="empty-state">कोई सामग्री नहीं मिली (No materials found)</div>';
                        return;
                    }
                    resultsList.innerHTML = '';
                    data.forEach(item => {
                        const type = detectFileType(item.path);
                        const iconClass = getIconClassForType(type);
                        const materialEl = document.createElement('div');
                        materialEl.className = 'material-item';
                        materialEl.onclick = () => loadMaterial(type, item.path, materialEl);
                        materialEl.setAttribute('tabindex', '0');
                        materialEl.setAttribute('role', 'button');
                        materialEl.setAttribute('aria-label', `Open ${item.title} (${type})`);
                        materialEl.innerHTML = `
                            <i class="fas ${iconClass}"></i>
                            <span class="material-title">${item.title}</span>
                        `;
                        resultsList.appendChild(materialEl);
                    });
                })
                .catch(error => {
                    spinner.style.display = 'none';
                    searchBtn.setAttribute('aria-busy', 'false');
                    resultsList.innerHTML = '<div class="empty-state">Search failed</div>';
                    console.error('Search failed:', error);
                });
        }

        function loadMaterial(type, path, element = null) {
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
                    <div class="loading-spinner" style="border-top-color: var(--primary); width: 40px; height: 40px; margin-bottom: 1rem;"></div>
                    <h4>सामग्री लोड हो रही है (Loading content)</h4>
                </div>
            `;
            
            setTimeout(() => {
                const isDrive = path && path.includes("drive.google.com");
                const fileExt = path.split('.').pop().toLowerCase();
                // Normalize path for URLs
                const urlPath = normalizePath(path);
                if (isDrive) {
                    const match = path.match(/\/d\/([^\/]+)\//);
                    const fileId = match?.[1];
                    viewer.innerHTML = fileId
                        ? `<iframe src="https://drive.google.com/file/d/${fileId}/preview" allowfullscreen style="width:100%;height:100%;border:none;border-radius:var(--radius-sm);"></iframe>`
                        : `<div class="empty-state text-danger">Invalid Google Drive link format.</div>`;
                } else if (type === 'pdf') {
                    const downloadUrl = `<?= site_url('materials/serve') ?>?path=${encodeURIComponent(urlPath)}`;
                    viewer.innerHTML = `
                        <div class="pdf-viewer-wrapper" style="position:relative;width:100%;height:100%;">
                            <iframe id="pdfIframe" src="${downloadUrl}#toolbar=0" allowfullscreen style="width:100%;height:100%;border:none;border-radius:var(--radius-sm);"></iframe>
                            <div class="pdf-options-bar" style="position:absolute;top:0;left:0;width:100%;height:44px;z-index:10;display:flex;justify-content:flex-end;align-items:center;padding:0 18px;background:linear-gradient(90deg,rgba(20,30,40,0.92) 0%,rgba(20,30,40,0.65) 100%);box-shadow:0 2px 8px 0 rgba(0,0,0,0.10);">
                                <button class="pdf-btn" title="Full Screen" aria-label="Full Screen" style="background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer;padding:0.3rem 0.7rem;display:flex;align-items:center;">
                                    <!-- Minimal fullscreen icon (SVG) -->
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="5" height="1.5" rx="0.75" fill="white"/><rect x="3" y="3" width="1.5" height="5" rx="0.75" fill="white"/><rect x="14" y="3" width="5" height="1.5" rx="0.75" fill="white"/><rect x="17.5" y="3" width="1.5" height="5" rx="0.75" fill="white"/><rect x="3" y="17.5" width="5" height="1.5" rx="0.75" fill="white"/><rect x="3" y="14" width="1.5" height="5" rx="0.75" fill="white"/><rect x="14" y="17.5" width="5" height="1.5" rx="0.75" fill="white"/><rect x="17.5" y="14" width="1.5" height="5" rx="0.75" fill="white"/></svg>
                                </button>
                                <a class="pdf-btn" title="Download PDF" aria-label="Download PDF" href="${downloadUrl}" download style="background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer;padding:0.3rem 0.7rem;display:flex;align-items:center;">
                                    <!-- Minimal download icon (SVG) -->
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 4v10.2M11 14.2l-3.5-3.5M11 14.2l3.5-3.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="4" y="17" width="14" height="1.5" rx="0.75" fill="white"/></svg>
                                </a>
                            </div>
                        </div>
                    `;
                    // Fullscreen logic
                    setTimeout(function() {
                        const fsBtn = viewer.querySelector('.pdf-btn[title="Full Screen"]');
                        const iframe = viewer.querySelector('#pdfIframe');
                        if (fsBtn && iframe) {
                            fsBtn.onclick = function() {
                                if (iframe.requestFullscreen) {
                                    iframe.requestFullscreen();
                                } else if (iframe.webkitRequestFullscreen) {
                                    iframe.webkitRequestFullscreen();
                                } else if (iframe.msRequestFullscreen) {
                                    iframe.msRequestFullscreen();
                                }
                            };
                        }
                    }, 100);
                } else if (type === 'video' || type === 'mp4') {
                    viewer.innerHTML = `<video controls style="width:100%;height:100%;border-radius:var(--radius-sm);"><source src="<?= site_url('materials/serve') ?>?path=${encodeURIComponent(urlPath)}" type="video/mp4"></video>`;
                } else {
                    // For all other types, show a styled card with file type and download button
                    const fileTypeLabel = type ? type.toUpperCase() : 'FILE';
                    viewer.innerHTML = `
                        <div style="background: #f6fafd; border-radius: 16px; padding: 2.5rem 2rem 1.5rem 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04); max-width: 420px; margin: 0 auto;">
                            <div style="font-size: 3rem; color: #6b7280; margin-bottom: 0.5rem;">
                                <i class="fas ${getIconClassForType(type)}"></i>
                            </div>
                            <div style="font-size: 1.15rem; color: #374151; font-weight: 500; letter-spacing: 0.04em; margin-bottom: 0.25rem;">
                                ${fileTypeLabel} FILE
                            </div>
                            <div style="font-size: 0.98rem; color: #64748b; margin-bottom: 1.5rem;">
                                This file type is not viewable online. Please download to open.
                            </div>
                            <a href=\"<?= site_url('materials/serve') ?>?path=${encodeURIComponent(urlPath)}\" download target="_blank" rel="noopener" style="display: inline-block; background: #6b7280; color: #fff; border-radius: 10px; padding: 0.5rem 1rem; font-weight: 600; text-decoration: none; font-size: 0.97rem; letter-spacing: 0.04em; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: background 0.2s;">
                                <i class="fas fa-download me-2"></i>DOWNLOAD FILE
                            </a>
                        </div>
                    `;
                }
                viewer.setAttribute('tabindex', '0');
                viewer.focus();
            }, 500);
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

        function detectFileType(path) {
            if (!path) return 'unknown';

            const lower = path.toLowerCase();

            if (lower.includes('drive.google.com')) {
                if (lower.includes('.mp4') || lower.includes('.mov')) return 'video';
                if (lower.includes('.xlsx') || lower.includes('.xls')) return 'excel';
                if (lower.includes('.ppt') || lower.includes('.pptx')) return 'ppt';
                if (lower.includes('.doc') || lower.includes('.docx')) return 'word';
                if (lower.includes('.zip') || lower.includes('.rar')) return 'zip';
                return 'pdf';
            }

            if (lower.endsWith('.pdf')) return 'pdf';
            if (lower.endsWith('.mp4') || lower.endsWith('.mov') || lower.endsWith('.avi') || lower.endsWith('.mkv')) return 'video';
            if (lower.endsWith('.xlsx') || lower.endsWith('.xls')) return 'excel';
            if (lower.endsWith('.ppt') || lower.endsWith('.pptx')) return 'ppt';
            if (lower.endsWith('.doc') || lower.endsWith('.docx')) return 'word';
            if (lower.endsWith('.zip') || lower.endsWith('.rar')) return 'zip';

            return 'unknown';
        }

        function getIconClassForType(type) {
            switch ((type || '').toLowerCase()) {
                case 'pdf': return 'fa-file-pdf text-danger';
                case 'video':
                case 'mp4': return 'fa-video text-primary'; // Use video camera icon for video/mp4
                case 'excel': return 'fa-file-excel text-success';
                case 'ppt': return 'fa-file-powerpoint text-warning';
                case 'word': return 'fa-file-word text-info';
                case 'zip': return 'fa-file-archive text-secondary';
                case 'txt': return 'fa-file-alt text-muted';
                case 'image': return 'fa-file-image text-success';
                case 'audio': return 'fa-file-audio text-primary';
                default: return 'fa-file text-muted';
            }
        }

        function getBadgeClassForType(type) {
            switch (type.toLowerCase()) {
                case 'pdf': return 'badge-pdf';
                case 'video': return 'badge-video';
                case 'excel': return 'badge-excel';
                case 'ppt': return 'badge-ppt';
                case 'word': return 'badge-word';
                case 'zip': return 'badge-zip';
                default: return 'badge-default';
            }
        }

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

        function toggleSearchPanel() {
            const panel = document.getElementById('searchPanel');
            panel.style.display = (panel.style.display === 'none' || panel.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>