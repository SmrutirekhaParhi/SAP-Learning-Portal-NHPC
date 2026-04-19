<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>NHPC Admin- SAP_Edit Module - <?= esc($moduleName) ?></title>
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
            margin: 0.5rem 0 0 0;
            font-weight: 300;
        }

        .header a {
            color: var(--secondary);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            transition: background 0.2s ease;
        }
        .content-section > .container-fluid > form > .section-card:first-child {
            margin: 1rem 0.7rem 0.7rem 0.7rem;
        }
        .section-card {
            background: var(--surface-alt);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
            overflow: hidden;
            margin-bottom: 0.4rem;
        }
        .section-header {
            background: var(--primary-medium);
            
            border-bottom: 2px solid var(--accent);
            display: flex;
            align-items: center;
            gap: 0.2rem;
            justify-content: space-between;
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--surface);
            margin: 0;
            letter-spacing: 0.01em;
            font-family: 'Inter', sans-serif;
            padding: 0.5rem 0.5rem 0.5rem 0.95rem;
        }
        .section-content {
            padding-bottom: 0.5rem;
        }
        .module-name-card {
            background: #fff;
            border-radius: 0 0 var(--radius-sm) var(--radius-sm);
            box-shadow: 0 1px 4px rgba(30, 64, 175, 0.07), 0 1.5px 4px rgba(0,0,0,0.04);
            padding: 0.38rem 0.6rem 0.5rem 0.6rem;
            margin-bottom: 0.09rem;
            position: relative;
            transition: box-shadow 0.18s, border-color 0.18s;
            font-size: 0.85rem;
            min-height: 28px;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .module-name-card:hover {
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.13), 0 1px 4px rgba(0,0,0,0.07);
        }
        .module-name-card label.form-label {
            font-size: 1.02rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.08rem;
            letter-spacing: 0.01em;
            font-family: 'Inter', sans-serif;
        }
        .module-name-card input.form-control {
            border-radius: 6px;
            border: 1.5px solid #c7d6f3;
            padding: 0.22rem 0.5rem;
            font-size: 1.02rem;
            background: #f8fafc;
            color: #1e293b;
            margin-bottom: 0.05rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .module-name-card input.form-control:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 2px #dbeafe;
        }

        .sap-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1.5px 6px rgba(66,174,216,0.13);
            border: none;
            border-left: 3px solid var(--accent);
            margin-bottom: 0.18rem;
            padding: 0.12rem 0.5rem 0.18rem 0.5rem;
            position: relative;
            transition: box-shadow 0.18s, border-left-color 0.18s, background 0.18s;
            display: flex;
            flex-direction: column;
            gap: 0.08rem;
        }
        .sap-card:hover {
            border-left-color: var(--primary);
            box-shadow: var(--shadow);
            background: #f6fafd !important;
            transform: translateY(-1px);
        }
        .sap-card.disabled {
            opacity: 0.5;
            pointer-events: none;
            background-color: var(--surface-alt);
            border-left-color: var(--accent);
        }
        .card-header-bar {
            background: transparent;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            min-height: 0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0;
        }
        .card-content {
            padding: 0.01rem 0 0.01rem 0;
        }

        /* Fixed: Better status badge positioning */
        .status-badge {
            background: var(--accent);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-badge.deleted {
            background: var(--danger);
        }

        .status-badge.new {
            background: var(--success);
        }

        .status-badge.active {
            background: var(--accent);
        }

        /* Fixed: Consistent action buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .delete-btn, .remove-btn {
            background: none;
            border: 2px solid transparent;
            color: #ef4444;
            border-radius: 10px;
            padding: 0.18rem 0.28rem;
            font-size: 1.08rem;
            transition: border 0.2s, background 0.2s, color 0.2s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            min-height: 24px;
            box-shadow: none;
            outline: none;
        }

        .delete-btn:hover, .remove-btn:hover {
            border-color: #ef4444;
            background: #fee2e2;
            color: #b91c1c;
        }

        .delete-btn i, .remove-btn i {
            font-size: 1.08rem;
            color: inherit;
            box-shadow: none !important;
            text-decoration: none !important;
            border-bottom: none !important;
            display: block;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.04rem;
            display: block;
            font-size: 0.92rem;
            text-transform: uppercase;
            letter-spacing: 0.01em;
            font-family: 'Inter', sans-serif;
        }

        .form-control, .form-select {
            border: 2px solid var(--accent);
            border-radius: 6px;
            padding: 0.13rem 0.32rem;
            font-size: 1.02rem;
            transition: all 0.2s ease;
            background: var(--surface);
            color: #1e293b;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(66,174,216,0.13);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #42AED8 0%, #004672 100%);
            border: none;
            color: white;
            padding: 0.38rem 1.2rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 1.08rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.015em;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #004672 0%, #42AED8 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: white;
            padding: 0.11rem 0.22rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.15rem;
            font-size: 0.92rem;
            min-height: 24px;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: linear-gradient(135deg, #42AED8 0%, #004672 100%);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        .btn-outline.btn-success {
            border-color: var(--accent);
            color: var(--primary);
            font-size: 0.82rem;
            padding: 0.2rem 0.2rem;
            min-height: 15px;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline.btn-success:hover {
            border-color: var(--primary);
            color: white;
            background: linear-gradient(135deg, #42AED8 0%, #004672 100%);
        }

        .warning-text {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .topics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.32rem;
            margin-top: 0.08rem;
            font-size: 1.01rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 0.7rem 0;
            }
            .header h1 {
                font-size: 2rem;
            }
            .content-section {
                padding: 0.18rem;
            }
            .section-content {
                padding: 1rem;
            }
            .topics-grid {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }

        /* Focus States */
        *:focus {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .form-control:focus,
        .form-select:focus,
        .btn-primary:focus,
        .btn-outline:focus {
            outline: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .topic-card,
        .material-card {
            animation: fadeIn 0.3s ease;
            margin: 0 0 0.5rem 0.5rem;
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

        .save-btn-top {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.1rem;
            margin-bottom: 0.7rem;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Error message display -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
                <div class="header-content" style="display: flex; align-items: center; justify-content: space-between; gap: 1.1rem;">
                    <div style="display: flex; align-items: center; gap: 1.1rem;">
                        <img src="<?= base_url('uploads/NHPC_logo.png') ?>" alt="NHPC Logo" style="height: 40px; width: auto; object-fit: contain; display: block; box-shadow: 0 2px 8px rgba(255, 255, 255, 0.07); background: transparent; margin-left: 1rem;" />
                        <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="header-logo" style="height: 40px; width: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 1px; object-fit: contain; display: block;" />
                        <h1 style="margin: 0; font-size: 2rem; font-weight: 700; line-height: 1;">Admin- Edit Module</h1>
                    </div>
                    
                </div>
            </div>
        </div>

        

        <!-- Main Content -->
        <div class="content-section">
    
            <div class="container-fluid">
                <form action="<?= site_url('admin/update/' . urlencode($moduleName)) ?>" method="post" onsubmit="return validateFileTypes(this)">
                    
                    <!-- Unified Module & Topics Section -->
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-list-ul"></i>
                                Module Information
                            </h2>
                        </div>
                        <div class="section-content">
                            <!-- Module Name Input moved here -->
                            <div class="module-name-card mb-4">
                                <label class="form-label">
                                    <i class="fas fa-tag me-2"></i>
                                    Module Name
                                </label>
                                <input type="text" name="module_name" class="form-control" 
                                       value="<?= esc($moduleName) ?>" required 
                                       oninput="showModuleNameWarning(this)">
                                <div id="moduleNameWarning" class="warning-text d-none">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Please Note: Changing the module name may cause issues if a module with this name already exists.
                                </div>
                            </div>
                            <button type="button" class="btn-outline btn-success" onclick="addNewTopic()" title="Add New Topic" aria-label="Add New Topic" style="margin: 0rem 0rem 0.5rem 0.5rem; border-color: var(--primary); padding: 0.2rem 0.5rem; font-size: 0.875rem;">
                                <i class="fas fa-plus"></i>
                                Add New Topic
                            </button>
                            <div class="topics-grid" id="topicContainer">
                                <?php foreach ($groupedMaterials as $topicName => $materials): ?>
                                    <?php $safeKey = md5($topicName); ?>
                                    <div class="sap-card <?= ($materials[0]['status'] ?? '') === 'deleted' ? 'disabled' : '' ?> topic-card" id="topic-card-<?= $safeKey ?>">
                                        <div class="card-header-bar" style="background: transparent; border-bottom: none; border-radius: 12px 12px 0 0; min-height: 0; display: flex; justify-content: flex-end; align-items: center; padding: 0;">
                                            <div class="action-buttons">
                                                <button type="button" class="delete-btn" onclick="markTopicForDeletion('<?= esc($topicName) ?>', this)" title="Delete Topic" aria-label="Delete Topic">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-content" style="padding: 0 0 0 0;">
                                            <div class="mb-3" style="margin-bottom: 0.7rem !important;">
                                                <label class="form-label" style="font-size: 0.9rem; font-weight: 600; color: var(--primary); letter-spacing: 0.03em; display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.18rem;">
                                                    <i class="fas fa-bookmark" style="color: var(--primary); font-size: 0.9rem;"></i>
                                                    TOPIC NAME
                                                </label>
                                                <input type="text" name="topics[<?= esc($topicName) ?>][name]" class="form-control" value="<?= esc($topicName) ?>">
                                            </div>
                                            <?php foreach ($materials as $file): ?>
                                                <?php
                                                    $type = strtolower($file['file_type'] ?? '');
                                                    $icon = 'fa-file';
                                                    $iconColor = 'var(--text-muted)';
                                                    if ($file['status'] === 'deleted') {
                                                        $icon = 'fa-trash';
                                                        $iconColor = '#ef4444';
                                                    } else {
                                                        switch ($type) {
                                                            case 'pdf':
                                                                $icon = 'fa-file-pdf';
                                                                $iconColor = '#ef4444';
                                                                break;
                                                            case 'excel':
                                                                $icon = 'fa-file-excel';
                                                                $iconColor = '#10b981';
                                                                break;
                                                            case 'video':
                                                                $icon = 'fa-video';
                                                                $iconColor = '#2563eb';
                                                                break;
                                                            case 'zip':
                                                                $icon = 'fa-file-archive';
                                                                $iconColor = '#f59e0b';
                                                                break;
                                                            default:
                                                                $icon = 'fa-file';
                                                                $iconColor = 'var(--text-muted)';
                                                        }
                                                    }
                                                ?>
                                                <div class="sap-card <?= $file['status'] === 'deleted' ? 'disabled' : '' ?> material-card" id="file-block-<?= $file['id'] ?>">
                                                    <div class="card-header-bar" style="background: transparent; border-bottom: none; border-radius: 10px 10px 0 0; min-height: 0; display: flex; justify-content: flex-end; align-items: center; padding: 0;">
                                                        <div class="action-buttons">
                                                            <button type="button" class="remove-btn" onclick="markForDeletion('<?= esc($topicName) ?>', <?= $file['id'] ?>, this)" title="Delete File" aria-label="Delete File">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-content" style="padding: 0 0 0 0;">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" style="font-size: 0.9rem; font-weight: 700; color: var(--primary); letter-spacing: 0.03em; display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.18rem;">
                                                                    <i class="fas fa-file" style="color: var(--primary); font-size: 0.9rem;"></i>
                                                                    FILE TITLE
                                                                </label>
                                                                <input type="text" name="topics[<?= esc($topicName) ?>][materials][<?= $file['id'] ?>][title]" class="form-control" value="<?= esc($file['title']) ?>" >
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" style="font-size: 0.9rem; font-weight: 700; color: var(--primary); letter-spacing: 0.03em; display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.18rem;">
                                                                    <i class="fas fa-link" style="color: var(--primary); font-size: 0.9rem;"></i>
                                                                    FILE PATH
                                                                </label>
                                                                <input type="text" name="topics[<?= esc($topicName) ?>][materials][<?= $file['id'] ?>][file_path]" class="form-control" value="<?= esc($file['file_path']) ?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <button type="button" class="btn-outline btn-success mt-3" onclick="addFileToExistingTopic('<?= esc($topicName) ?>', '<?= $safeKey ?>')">
                                                <i class="fas fa-plus"></i>
                                                Add File
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center" style="margin-top: 1.5rem; margin-bottom: 1.1rem;">
                            <button type="submit" class="btn-primary" style="min-width: 220px; font-size: 1.18rem; border-radius: 6px; padding: 0.38rem 1.2rem; border-color: var(--accent)">
                                Update Module
                            </button>
                        </div>
                    </div>

                    <!-- Hidden inputs for deletions -->
                    <div id="deleteMarkers"></div>
                    <!-- Save button centered below the unified card -->
                    
                </form>
            </div>
        </div>
    </div>

    <script>
        let newTopicIndex = 0;
        let newFileIndex = 0;

        function markForDeletion(topic, fileId, button) {
            if (confirm('Are you sure you want to delete this file?')) {
                const fieldName = `topics[${topic}][materials][${fileId}][delete]`;
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = fieldName;
                input.value = '1';
                document.getElementById('deleteMarkers').appendChild(input);

                const block = document.getElementById('file-block-' + fileId);
                block.classList.add('disabled');
                block.querySelectorAll('input, button, select').forEach(el => el.disabled = true);
                
                // Update status badge
                const statusBadge = block.querySelector('.status-badge');
                if (statusBadge) {
                    statusBadge.innerHTML = '<i class="fas fa-trash"></i> Deleted';
                    statusBadge.classList.remove('active');
                    statusBadge.classList.add('deleted');
                }
            }
        }

        function markTopicForDeletion(topicName, button) {
            if (confirm('Are you sure you want to delete this topic and all its files?')) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `topics[${topicName}][delete]`;
                input.value = '1';
                document.getElementById('deleteMarkers').appendChild(input);

                const card = button.closest('.topic-card');
                card.classList.add('disabled');
                card.querySelectorAll('input, select, button').forEach(el => el.disabled = true);
                
                // Update status badge
                const statusBadge = card.querySelector('.status-badge');
                if (statusBadge) {
                    statusBadge.innerHTML = '<i class="fas fa-trash"></i> Deleted';
                    statusBadge.classList.remove('active');
                    statusBadge.classList.add('deleted');
                }
            }
        }

        function addNewTopic() {
            const index = newTopicIndex++;
            const html = `
                <div class="sap-card topic-card">
                    <div class="card-header-bar">
                        <div class="action-buttons">
                            <button type="button" class="remove-btn" onclick="this.closest('.topic-card').remove()" title="Remove Topic" aria-label="Remove Topic">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-bookmark"></i>
                                TOPIC NAME
                            </label>
                            <input type="text" name="new_topics[${index}][name]" class="form-control" placeholder="Enter topic name" required>
                        </div>
                        <div id="newTopicFiles_${index}"></div>
                        <button type="button" class="btn-outline btn-success mt-3" onclick="addFileToNewTopic(${index})">
                            <i class="fas fa-plus"></i>
                            Add File
                        </button>
                    </div>
                </div>`;
            document.getElementById('topicContainer').insertAdjacentHTML('beforeend', html);
        }

        function addFileToNewTopic(topicIdx) {
            const container = document.getElementById(`newTopicFiles_${topicIdx}`);
            const index = container.children.length;
            const html = `
                <div class="sap-card material-card">
                    <div class="card-header-bar">
                        <div class="action-buttons">
                            <button type="button" class="remove-btn" onclick="this.closest('.material-card').remove()" title="Remove File" aria-label="Remove File">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-file me-2"></i>
                                    File Title
                                </label>
                                <input type="text" name="new_topics[${topicIdx}][files][${index}][title]" class="form-control" placeholder="Enter file title" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-link me-2"></i>
                                    File Path
                                </label>
                                <input type="text" name="new_topics[${topicIdx}][files][${index}][file_path]" class="form-control" placeholder="e.g. uploads/materials/filename.pdf" required>
                            </div>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addFileToExistingTopic(topicName, safeKey) {
            const topicCard = document.getElementById(`topic-card-${safeKey}`);
            const index = newFileIndex++;
            const html = `
                <div class="sap-card material-card">
                    <div class="card-header-bar">
                        <div class="action-buttons">
                            <button type="button" class="remove-btn" onclick="this.closest('.material-card').remove()" title="Remove File" aria-label="Remove File">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-file me-2"></i>
                                    File Title
                                </label>
                                <input type="text" name="new_files[${topicName}][${index}][title]" class="form-control" placeholder="Enter file title" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-link me-2"></i>
                                    File Path
                                </label>
                                <input type="text" name="new_files[${topicName}][${index}][file_path]" class="form-control" placeholder="e.g. uploads/materials/filename.pdf" required>
                            </div>
                        </div>
                    </div>
                </div>`;
            // Insert before the "Add File" button
            const addButton = topicCard.querySelector('.btn-outline.btn-success');
            addButton.insertAdjacentHTML('beforebegin', html);
        }

        function showModuleNameWarning(input) {
            const warning = document.getElementById('moduleNameWarning');
            if (input.value !== "<?= esc($moduleName) ?>") {
                warning.classList.remove('d-none');
            } else {
                warning.classList.add('d-none');
            }
        }

        function validateFileTypes(form) {
            // Only allow file paths matching uploads\materials\*.pdf
            const fileInputs = form.querySelectorAll('input[name$="[file_path]"]');
            let valid = true;
            let firstInvalid = null;
            const regex = /[^\\\/]+\.(pdf|docx|ppt|pptx|mp4|zip|xls|xlsx)$/i;
            fileInputs.forEach(function(input) {
                if (!regex.test(input.value.trim())) {
                    valid = false;
                    firstInvalid = firstInvalid || input;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            if (!valid) {
                showFilePathError();
                if (firstInvalid) firstInvalid.focus();
                return false;
            }
            hideFilePathError();
            return true;
        }

        function showFilePathError() {
            let notif = document.getElementById('filePathErrorNotif');
            if (!notif) {
                notif = document.createElement('div');
                notif.id = 'filePathErrorNotif';
                notif.className = 'alert alert-danger';
                notif.style.margin = '0.5rem 0';
                notif.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>File path not supported. Only paths like <b>uploads\\materials\\sample.(pdf/mp4/xlsx/zip/...)</b> are allowed.';
                const form = document.querySelector('form');
                form.parentNode.insertBefore(notif, form);
            } else {
                notif.style.display = '';
            }
        }

        function hideFilePathError() {
            let notif = document.getElementById('filePathErrorNotif');
            if (notif) notif.style.display = 'none';
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.type === 'submit') {
                e.preventDefault();
                e.target.click();
            }
        });
    </script>
</body>
</html>