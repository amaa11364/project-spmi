<?php $__env->startSection('title', 'Upload Dokumen SPMI'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --primary-brown: #996600;
        --secondary-brown: #b37400;
        --dark-brown: #7a5200;
        --light-brown: #fff9e6;
        --success-green: #28a745;
        --info-blue: #17a2b8;
        --warning-yellow: #ffc107;
        --danger-red: #dc3545;
        --light-gray: #f8f9fa;
        --dark-gray: #343a40;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .upload-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 20px 30px -10px rgba(153, 102, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .header-title i {
        font-size: 2.2rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.75rem;
        border-radius: 18px;
        backdrop-filter: blur(10px);
    }

    .header-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-left: 4rem;
    }

    /* Main Card */
    .upload-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .upload-card:hover {
        box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border-bottom: 2px solid #e9ecef;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--dark-gray);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header h3 i {
        color: var(--primary-brown);
        background: var(--light-brown);
        padding: 0.5rem;
        border-radius: 12px;
    }

    .card-body {
        padding: 2rem;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: var(--primary-brown);
        font-size: 0.9rem;
    }

    .text-danger {
        color: var(--danger-red);
    }

    .form-control, .form-select {
        width: 100%;
        padding: 0.85rem 1.2rem;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: white;
        color: var(--dark-gray);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 4px rgba(153, 102, 0, 0.1);
    }

    .form-control::placeholder {
        color: #adb5bd;
    }

    /* Row Layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -0.75rem;
    }

    .col-md-6 {
        width: 50%;
        padding: 0 0.75rem;
    }

    /* Tahapan Selector */
    .tahapan-selector {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 2px solid #e9ecef;
    }

    .tahapan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .tahapan-option {
        position: relative;
    }

    .tahapan-option input[type="radio"] {
        display: none;
    }

    .tahapan-option label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.25rem 1rem;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .tahapan-option input[type="radio"]:checked + label {
        border-color: var(--primary-brown);
        background: var(--light-brown);
        box-shadow: 0 10px 20px -8px rgba(153, 102, 0, 0.3);
        transform: translateY(-2px);
    }

    .tahapan-option label i {
        font-size: 1.8rem;
        margin-bottom: 0.75rem;
        color: var(--primary-brown);
        background: var(--light-brown);
        padding: 0.75rem;
        border-radius: 14px;
        transition: all 0.2s ease;
    }

    .tahapan-option input[type="radio"]:checked + label i {
        background: var(--primary-brown);
        color: white;
    }

    .tahapan-option label span {
        font-weight: 600;
        color: var(--dark-gray);
        font-size: 0.9rem;
    }

    /* Dynamic Fields */
    .dynamic-fields {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border: 2px dashed #e9ecef;
        transition: all 0.3s ease;
    }

    .dynamic-fields-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        color: var(--dark-gray);
        font-weight: 600;
        font-size: 1rem;
    }

    .dynamic-fields-title i {
        color: var(--primary-brown);
    }

    .field-group {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* File Upload */
    .file-upload-area {
        border: 3px dashed #e9ecef;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .file-upload-area:hover {
        border-color: var(--primary-brown);
        background: var(--light-brown);
    }

    .file-upload-area i {
        font-size: 3rem;
        color: var(--primary-brown);
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .file-upload-area h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 0.5rem;
    }

    .file-upload-area p {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .file-upload-area small {
        color: #adb5bd;
        font-size: 0.8rem;
    }

    .file-info {
        display: none;
        background: var(--light-brown);
        border-radius: 16px;
        padding: 1rem;
        margin-top: 1rem;
        align-items: center;
        gap: 1rem;
        border: 2px solid var(--primary-brown);
    }

    .file-info.show {
        display: flex;
    }

    .file-info i {
        font-size: 2rem;
        color: var(--primary-brown);
        margin: 0;
    }

    .file-details {
        flex: 1;
    }

    .file-name {
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 0.25rem;
    }

    .file-size {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .file-remove {
        color: var(--danger-red);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .file-remove:hover {
        background: rgba(220, 53, 69, 0.1);
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
        color: white;
        border: none;
        border-radius: 18px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        box-shadow: 0 10px 20px -5px rgba(153, 102, 0, 0.4);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -5px rgba(153, 102, 0, 0.5);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .submit-btn i {
        font-size: 1.2rem;
    }

    .submit-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .upload-container {
            margin: 1rem auto;
            padding: 0 1rem;
        }

        .header-card {
            padding: 1.5rem;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .header-title i {
            font-size: 1.8rem;
            padding: 0.5rem;
        }

        .header-subtitle {
            margin-left: 0;
        }

        .card-header, .card-body {
            padding: 1.5rem;
        }

        .tahapan-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .file-upload-area {
            padding: 1.5rem;
        }

        .col-md-6 {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .tahapan-grid {
            grid-template-columns: 1fr;
        }

        .dynamic-fields {
            padding: 1rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="upload-container">
    <!-- Header Card -->
    <div class="header-card">
        <div class="header-content">
            <div class="header-title">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Upload Dokumen SPMI</span>
            </div>
            <div class="header-subtitle">
                Unggah dokumen mutu sesuai tahapan SPMI yang dipilih
            </div>
        </div>
    </div>

    <!-- Upload Form Card -->
    <div class="upload-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-file-alt"></i>
                Form Upload Dokumen
            </h3>
        </div>
        <div class="card-body">
            <form id="uploadForm" action="<?php echo e(route('user.upload-dokumen.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Hidden field untuk jenis upload -->
                <input type="hidden" name="jenis_upload" value="file">

                <!-- Tahapan Selector -->
                <div class="tahapan-selector">
                    <label class="form-label">
                        <i class="fas fa-layer-group"></i>
                        Pilih Tahapan SPMI
                    </label>
                    <div class="tahapan-grid">
                        <div class="tahapan-option">
                            <input type="radio" name="tahapan" id="tahapan-penetapan" value="penetapan" checked>
                            <label for="tahapan-penetapan">
                                <i class="fas fa-folder-open"></i>
                                <span>Penetapan</span>
                            </label>
                        </div>
                        <div class="tahapan-option">
                            <input type="radio" name="tahapan" id="tahapan-pelaksanaan" value="pelaksanaan">
                            <label for="tahapan-pelaksanaan">
                                <i class="fas fa-play-circle"></i>
                                <span>Pelaksanaan</span>
                            </label>
                        </div>
                        <div class="tahapan-option">
                            <input type="radio" name="tahapan" id="tahapan-evaluasi" value="evaluasi">
                            <label for="tahapan-evaluasi">
                                <i class="fas fa-chart-line"></i>
                                <span>Evaluasi</span>
                            </label>
                        </div>
                        <div class="tahapan-option">
                            <input type="radio" name="tahapan" id="tahapan-pengendalian" value="pengendalian">
                            <label for="tahapan-pengendalian">
                                <i class="fas fa-tasks"></i>
                                <span>Pengendalian</span>
                            </label>
                        </div>
                        <div class="tahapan-option">
                            <input type="radio" name="tahapan" id="tahapan-peningkatan" value="peningkatan">
                            <label for="tahapan-peningkatan">
                                <i class="fas fa-chart-bar"></i>
                                <span>Peningkatan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Field Umum -->
                <div class="form-group">
                    <label class="form-label" for="nama_dokumen">
                        <i class="fas fa-heading"></i>
                        Nama Dokumen <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="nama_dokumen" name="nama_dokumen" 
                           placeholder="Contoh: Kebijakan SPMI 2024" 
                           value="<?php echo e(old('nama_dokumen')); ?>" required>
                    <?php $__errorArgs = ['nama_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color: var(--danger-red);"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Unit Kerja & IKU -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="unit_kerja_id">
                                <i class="fas fa-building"></i>
                                Unit Kerja <span class="text-danger">*</span>
                            </label>
                            <select class="form-select <?php $__errorArgs = ['unit_kerja_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="unit_kerja_id" name="unit_kerja_id" required>
                                <option value="">Pilih Unit Kerja</option>
                                <?php $__currentLoopData = $unitKerjas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($unit->id); ?>" <?php echo e(old('unit_kerja_id') == $unit->id ? 'selected' : ''); ?>>
                                        <?php echo e($unit->nama ?? $unit->nama_unit); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['unit_kerja_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small style="color: var(--danger-red);"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="iku_id">
                                <i class="fas fa-chart-line"></i>
                                IKU Terkait
                            </label>
                            <select class="form-select <?php $__errorArgs = ['iku_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="iku_id" name="iku_id">
                                <option value="">Pilih IKU</option>
                                <?php $__currentLoopData = $ikus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($iku->id); ?>" <?php echo e(old('iku_id') == $iku->id ? 'selected' : ''); ?>>
                                        <?php echo e($iku->kode ?? ''); ?> <?php echo e($iku->nama ?? $iku->nama_iku); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['iku_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small style="color: var(--danger-red);"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Fields Container -->
                <div class="dynamic-fields" id="dynamicFields">
                    <div class="dynamic-fields-title">
                        <i class="fas fa-cog"></i>
                        <span>Field Tambahan <span id="tahapanLabel">(Penetapan)</span></span>
                    </div>
                    <div id="fieldContainer">
                        
                    </div>
                </div>

                <!-- File Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file"></i>
                        Upload File <span class="text-danger">*</span>
                    </label>
                    <div class="file-upload-area" onclick="document.getElementById('file_dokumen').click()">
                        <input type="file" id="file_dokumen" name="file_dokumen" style="display: none;" 
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png" required>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h4>Klik untuk memilih file</h4>
                        <p>atau drag and drop file di sini</p>
                        <small>Maksimal 10MB. Format: PDF, DOC, XLS, PPT, JPG, PNG</small>
                    </div>
                    <div class="file-info" id="fileInfo">
                        <i class="fas fa-file-pdf"></i>
                        <div class="file-details">
                            <div class="file-name" id="fileName"></div>
                            <div class="file-size" id="fileSize"></div>
                        </div>
                        <div class="file-remove" onclick="removeFile()">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <?php $__errorArgs = ['file_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color: var(--danger-red);"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Hidden Field untuk Keterangan -->
                <input type="hidden" name="keterangan" id="keterangan" value="Upload dokumen SPMI">

                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-upload"></i>
                    <span>Upload Dokumen</span>
                </button>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Field definitions for each tahapan
    const fieldDefinitions = {
        penetapan: [
            { type: 'select', name: 'kode_penetapan', label: 'Kode Penetapan', icon: 'fa-barcode', required: true,
              options: [
                { value: 'SPMI-PEN-001', label: 'SPMI-PEN-001 - Kebijakan Mutu' },
                { value: 'SPMI-PEN-002', label: 'SPMI-PEN-002 - Manual Mutu' },
                { value: 'SPMI-PEN-003', label: 'SPMI-PEN-003 - Standar Mutu' }
              ] },
            { type: 'number', name: 'tahun_penetapan', label: 'Tahun Penetapan', icon: 'fa-calendar', placeholder: '2024', required: true },
            { type: 'select', name: 'status_penetapan', label: 'Status Penetapan', icon: 'fa-tag', required: true,
              options: [
                { value: 'aktif', label: 'Aktif' },
                { value: 'revisi', label: 'Revisi' },
                { value: 'kadaluarsa', label: 'Kadaluarsa' }
              ] }
        ],
        pelaksanaan: [
            { type: 'text', name: 'keterangan_pelaksanaan', label: 'Keterangan Dokumen', icon: 'fa-info-circle', placeholder: 'Deskripsi singkat tentang dokumen ini', required: true }
        ],
        evaluasi: [
            { type: 'text', name: 'periode_evaluasi', label: 'Periode Evaluasi', icon: 'fa-clock', placeholder: 'Contoh: Semester Ganjil 2024', required: true },
            { type: 'textarea', name: 'hasil_evaluasi', label: 'Hasil Evaluasi', icon: 'fa-chart-bar', placeholder: 'Ringkasan hasil evaluasi...', rows: 3, required: true }
        ],
        pengendalian: [
            { type: 'text', name: 'sumber_temuan', label: 'Sumber Temuan', icon: 'fa-search', placeholder: 'Contoh: Audit Mutu Internal', required: true },
            { type: 'select', name: 'prioritas', label: 'Prioritas', icon: 'fa-exclamation-triangle', required: true,
              options: [
                { value: 'tinggi', label: 'Tinggi' },
                { value: 'sedang', label: 'Sedang' },
                { value: 'rendah', label: 'Rendah' }
              ] },
            { type: 'date', name: 'target_selesai', label: 'Target Selesai', icon: 'fa-calendar-check', required: true }
        ],
        peningkatan: [
            { type: 'text', name: 'program_peningkatan', label: 'Program Peningkatan', icon: 'fa-chart-line', placeholder: 'Nama program peningkatan', required: true },
            { type: 'number', name: 'anggaran', label: 'Anggaran (Rp)', icon: 'fa-money-bill', placeholder: '0', required: true },
            { type: 'select', name: 'jenis_peningkatan', label: 'Jenis Peningkatan', icon: 'fa-tag', required: true,
              options: [
                { value: 'strategis', label: 'Strategis' },
                { value: 'operasional', label: 'Operasional' },
                { value: 'perbaikan', label: 'Perbaikan' }
              ] }
        ]
    };

    // Element references
    const tahapanRadios = document.querySelectorAll('input[name="tahapan"]');
    const fieldContainer = document.getElementById('fieldContainer');
    const tahapanLabel = document.getElementById('tahapanLabel');
    const fileInput = document.getElementById('file_dokumen');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');

    // Tahapan labels for display
    const tahapanLabels = {
        penetapan: 'Penetapan',
        pelaksanaan: 'Pelaksanaan',
        evaluasi: 'Evaluasi',
        pengendalian: 'Pengendalian',
        peningkatan: 'Peningkatan'
    };

    // Function to render dynamic fields
    function renderFields(tahapan) {
        const fields = fieldDefinitions[tahapan] || [];
        tahapanLabel.textContent = `(${tahapanLabels[tahapan]})`;
        
        if (fields.length === 0) {
            fieldContainer.innerHTML = '';
            return;
        }

        let html = '<div class="field-group">';
        
        fields.forEach(field => {
            html += `<div class="form-group">`;
            html += `<label class="form-label" for="${field.name}">`;
            html += `<i class="fas ${field.icon}"></i> ${field.label}`;
            if (field.required) html += ` <span class="text-danger">*</span>`;
            html += `</label>`;

            if (field.type === 'select') {
                html += `<select class="form-control" id="${field.name}" name="${field.name}" ${field.required ? 'required' : ''}>`;
                html += `<option value="">Pilih ${field.label}</option>`;
                field.options.forEach(option => {
                    html += `<option value="${option.value}">${option.label}</option>`;
                });
                html += `</select>`;
            } else if (field.type === 'textarea') {
                html += `<textarea class="form-control" id="${field.name}" name="${field.name}" 
                          placeholder="${field.placeholder}" rows="${field.rows || 3}" 
                          ${field.required ? 'required' : ''}></textarea>`;
            } else {
                html += `<input type="${field.type}" class="form-control" id="${field.name}" 
                          name="${field.name}" placeholder="${field.placeholder || ''}" 
                          ${field.required ? 'required' : ''}>`;
            }
            
            html += `</div>`;
        });

        html += '</div>';
        fieldContainer.innerHTML = html;
    }

    // Event listeners for tahapan changes
    tahapanRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            renderFields(e.target.value);
        });
    });

    // File input handling
    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            
            // Format file size
            let size = file.size;
            if (size < 1024) {
                fileSize.textContent = size + ' bytes';
            } else if (size < 1024 * 1024) {
                fileSize.textContent = (size / 1024).toFixed(2) + ' KB';
            } else {
                fileSize.textContent = (size / (1024 * 1024)).toFixed(2) + ' MB';
            }
            
            fileInfo.classList.add('show');
            
            // Update icon based on file type
            const icon = fileInfo.querySelector('i:first-child');
            const extension = file.name.split('.').pop().toLowerCase();
            
            if (extension === 'pdf') {
                icon.className = 'fas fa-file-pdf';
                icon.style.color = '#dc3545';
            } else if (['doc', 'docx'].includes(extension)) {
                icon.className = 'fas fa-file-word';
                icon.style.color = '#17a2b8';
            } else if (['xls', 'xlsx'].includes(extension)) {
                icon.className = 'fas fa-file-excel';
                icon.style.color = '#28a745';
            } else if (['ppt', 'pptx'].includes(extension)) {
                icon.className = 'fas fa-file-powerpoint';
                icon.style.color = '#ffc107';
            } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                icon.className = 'fas fa-file-image';
                icon.style.color = '#996600';
            } else {
                icon.className = 'fas fa-file-alt';
                icon.style.color = '#6c757d';
            }
        }
    });

    // Remove file function
    function removeFile() {
        fileInput.value = '';
        fileInfo.classList.remove('show');
    }

    // Drag and drop handling
    const uploadArea = document.querySelector('.file-upload-area');
    
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#996600';
        uploadArea.style.background = '#fff9e6';
    });

    uploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#e9ecef';
        uploadArea.style.background = '#f8fafc';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#e9ecef';
        uploadArea.style.background = '#f8fafc';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    // Form submission with loading state
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupload...';
        submitBtn.disabled = true;
        
        // Re-enable after 10 seconds as safety (form will submit normally)
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }, 10000);
    });

    // Initialize with default tahapan (penetapan)
    renderFields('penetapan');

    // Show old values if validation error
    <?php if(old('tahapan')): ?>
        const oldTahapan = "<?php echo e(old('tahapan')); ?>";
        document.querySelector(`input[name="tahapan"][value="${oldTahapan}"]`).checked = true;
        renderFields(oldTahapan);
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/user/upload-dokumen.blade.php ENDPATH**/ ?>