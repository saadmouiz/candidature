@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #ef4444;
        --primary-hover: #dc2626;
        --primary-light: #fee2e2;
        --background: #f9fafb;
        --card-bg: #ffffff;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-light: #9ca3af;
        --border-color: #e5e7eb;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    body {
        background-color: var(--background);
        color: var(--text-primary);
        font-family: system-ui, -apple-system, sans-serif;
    }

    .scanner-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
    }

    .back-link:hover {
        background-color: #f3f4f6;
        color: var(--text-primary);
        text-decoration: none;
    }

    .main-card {
        background-color: var(--card-bg);
        border-radius: 0.75rem;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .scanner-header {
        padding: 1.5rem;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .scanner-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .scanner-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .scanner-content {
        padding: 1.5rem;
    }

    .video-container {
        position: relative;
        background-color: #000;
        border-radius: 0.5rem;
        overflow: hidden;
        margin-bottom: 1rem;
        max-width: 100%;
        width: 100%;
        aspect-ratio: 4/3;
    }

    #video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .scanner-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 200px;
        height: 200px;
        border: 2px solid var(--primary);
        border-radius: 0.5rem;
        pointer-events: none;
    }

    .scanner-overlay::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 2px solid rgba(239, 68, 68, 0.3);
        border-radius: 0.5rem;
        animation: scanner-pulse 2s infinite;
    }

    @keyframes scanner-pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.05); }
        100% { opacity: 1; transform: scale(1); }
    }

    .scanner-status {
        text-align: center;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .status-waiting {
        background-color: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    .status-error {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .status-success {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    .control-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .btn {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        font-size: 0.875rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
    }

    .btn-secondary {
        background-color: #f3f4f6;
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .instructions {
        background-color: var(--primary-light);
        border-left: 4px solid var(--primary);
        padding: 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .instructions h3 {
        margin: 0 0 0.5rem 0;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--primary);
    }

    .instructions ul {
        margin: 0;
        padding-left: 1rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .scanner-container {
            padding: 1rem;
        }
        
        .control-buttons {
            flex-direction: column;
        }
        
        .video-container {
            aspect-ratio: 1;
        }
    }
</style>
@endsection

@section('content')
<div class="scanner-container">
    <div class="page-header">
        <a href="{{ route('beneficiaire.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la liste</span>
        </a>
    </div>
    
    <div class="main-card">
        <div class="scanner-header">
            <h1 class="scanner-title">Scanner QR Code</h1>
            <p class="scanner-subtitle">Confirmez la présence d'un bénéficiaire en scannant son code QR</p>
        </div>
        
        <div class="scanner-content">
            <div class="instructions">
                <h3>Instructions :</h3>
                <ul>
                    <li>Positionnez le code QR devant la caméra</li>
                    <li>Assurez-vous que l'éclairage est suffisant</li>
                    <li>Le scanner détectera automatiquement le code</li>
                </ul>
            </div>
            
            <div class="video-container">
                <video id="video" autoplay muted playsinline></video>
                <div class="scanner-overlay"></div>
            </div>
            
            <div id="scanner-status" class="scanner-status status-waiting">
                <i class="fas fa-camera"></i>
                Initialisation de la caméra...
            </div>
            
            <div class="control-buttons">
                <button id="startBtn" class="btn btn-primary" onclick="startScanner()">
                    <i class="fas fa-play"></i>
                    Démarrer le scanner
                </button>
                <button id="stopBtn" class="btn btn-secondary hidden" onclick="stopScanner()">
                    <i class="fas fa-stop"></i>
                    Arrêter le scanner
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
<script>
let video = document.getElementById('video');
let canvas = document.createElement('canvas');
let context = canvas.getContext('2d');
let animationId = null;
let stream = null;
let isScanning = false;

function updateStatus(message, type = 'waiting') {
    const statusDiv = document.getElementById('scanner-status');
    statusDiv.className = `scanner-status status-${type}`;
    
    let icon;
    switch(type) {
        case 'success': icon = 'fas fa-check-circle'; break;
        case 'error': icon = 'fas fa-exclamation-triangle'; break;
        default: icon = 'fas fa-camera'; break;
    }
    
    statusDiv.innerHTML = `<i class="${icon}"></i> ${message}`;
}

async function startScanner() {
    try {
        updateStatus('Demande d\'accès à la caméra...', 'waiting');
        
        // Try different camera constraints
        const constraints = [
            { video: { facingMode: 'environment' } }, // Back camera
            { video: { facingMode: 'user' } }, // Front camera
            { video: true } // Any camera
        ];
        
        let streamAcquired = false;
        for (const constraint of constraints) {
            try {
                stream = await navigator.mediaDevices.getUserMedia(constraint);
                streamAcquired = true;
                break;
            } catch (err) {
                console.log('Failed with constraint:', constraint, err);
                continue;
            }
        }
        
        if (!streamAcquired) {
            throw new Error('Aucune caméra disponible');
        }
        
        video.srcObject = stream;
        
        video.addEventListener('loadedmetadata', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            updateStatus('Caméra activée - Positionnez le code QR dans le cadre', 'waiting');
            isScanning = true;
            scanQRCode();
            
            document.getElementById('startBtn').classList.add('hidden');
            document.getElementById('stopBtn').classList.remove('hidden');
        });
        
    } catch (error) {
        console.error('Error accessing camera:', error);
        let message = 'Erreur d\'accès à la caméra';
        
        if (error.name === 'NotAllowedError') {
            message = 'Accès à la caméra refusé. Cliquez sur l\'icône de caméra dans la barre d\'adresse et autorisez l\'accès.';
        } else if (error.name === 'NotFoundError') {
            message = 'Aucune caméra trouvée sur cet appareil.';
        } else if (error.name === 'NotSupportedError') {
            message = 'Caméra non supportée. Utilisez HTTPS ou localhost pour accéder à la caméra.';
        } else if (error.name === 'NotReadableError') {
            message = 'Caméra déjà utilisée par une autre application.';
        } else if (window.location.protocol !== 'https:' && window.location.hostname !== 'localhost') {
            message = 'HTTPS requis pour accéder à la caméra. Utilisez localhost ou HTTPS.';
        }
        
        updateStatus(message, 'error');
        
        // Show additional help for common issues
        showCameraHelp(error.name);
    }
}

function stopScanner() {
    isScanning = false;
    
    if (animationId) {
        cancelAnimationFrame(animationId);
        animationId = null;
    }
    
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
    
    video.srcObject = null;
    updateStatus('Scanner arrêté', 'waiting');
    
    document.getElementById('startBtn').classList.remove('hidden');
    document.getElementById('stopBtn').classList.add('hidden');
}

function showCameraHelp(errorType) {
    // Create or update help message
    let helpDiv = document.getElementById('camera-help');
    if (!helpDiv) {
        helpDiv = document.createElement('div');
        helpDiv.id = 'camera-help';
        helpDiv.className = 'camera-help mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg';
        document.querySelector('.scanner-content').appendChild(helpDiv);
    }
    
    let helpContent = '';
    if (errorType === 'NotAllowedError') {
        helpContent = `
            <h4 class="font-semibold text-yellow-800 mb-2">Comment autoriser l'accès à la caméra :</h4>
            <ul class="text-sm text-yellow-700 space-y-1">
                <li>• <strong>Chrome :</strong> Cliquez sur l'icône 🔒 ou 📷 dans la barre d'adresse</li>
                <li>• <strong>Firefox :</strong> Cliquez sur l'icône de bouclier dans la barre d'adresse</li>
                <li>• Sélectionnez "Autoriser" pour la caméra</li>
                <li>• Rechargez la page si nécessaire</li>
            </ul>
        `;
    } else if (errorType === 'NotSupportedError' || (window.location.protocol !== 'https:' && window.location.hostname !== 'localhost')) {
        helpContent = `
            <h4 class="font-semibold text-yellow-800 mb-2">Problème de sécurité :</h4>
            <ul class="text-sm text-yellow-700 space-y-1">
                <li>• Les navigateurs modernes nécessitent HTTPS pour la caméra</li>
                <li>• Accédez au site via <code>https://</code> ou <code>localhost</code></li>
                <li>• Ou demandez à l'administrateur de configurer SSL</li>
            </ul>
        `;
    }
    
    if (helpContent) {
        helpDiv.innerHTML = helpContent;
        helpDiv.style.display = 'block';
        
        // Hide help after 10 seconds
        setTimeout(() => {
            if (helpDiv) {
                helpDiv.style.display = 'none';
            }
        }, 10000);
    }
}

function scanQRCode() {
    if (!isScanning) return;
    
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);
        
        if (code) {
            console.log('QR Code detected:', code.data);
            
            // More robust token extraction
            let token = null;
            console.log('Raw QR data:', code.data);
            
            // Try different patterns to extract the token
            if (code.data.includes('/qr-attendance/')) {
                // Extract from full URL
                const match = code.data.match(/\/qr-attendance\/([a-zA-Z0-9]+)/);
                if (match && match[1]) {
                    token = match[1];
                    console.log('Extracted token from URL:', token);
                }
            } else if (/^[a-zA-Z0-9]{20,}$/.test(code.data)) {
                // Direct token (at least 20 characters)
                token = code.data;
                console.log('Using direct token:', token);
            }
            
            if (token && token.length >= 20) {
                updateStatus('Code QR détecté - Vérification...', 'success');
                isScanning = false;
                confirmAttendance(token);
            } else {
                updateStatus('Format de QR code non reconnu', 'error');
                console.log('Invalid QR format. Token:', token, 'Length:', token ? token.length : 0);
                setTimeout(() => {
                    updateStatus('Recherche d\'un code QR...', 'waiting');
                }, 2000);
            }
        }
    }
    
    if (isScanning) {
        animationId = requestAnimationFrame(scanQRCode);
    }
}

async function confirmAttendance(token) {
    try {
        console.log('Attempting to confirm attendance for token:', token);
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }
        
        const response = await fetch(`/qr-attendance/${token}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        console.log('Server response:', result);
        
        if (result.success) {
            updateStatus(`Présence confirmée pour ${result.beneficiaire.prenom} ${result.beneficiaire.nom}`, 'success');
            
            // Redirect after 3 seconds
            setTimeout(() => {
                window.location.href = `/admin/beneficiaires/${result.beneficiaire.id}`;
            }, 3000);
        } else {
            updateStatus(result.message || 'Erreur lors de la confirmation', 'error');
            setTimeout(() => {
                isScanning = true;
                updateStatus('Recherche d\'un code QR...', 'waiting');
            }, 3000);
        }
    } catch (error) {
        console.error('Error confirming attendance:', error);
        let errorMessage = 'Erreur de connexion';
        
        if (error.message.includes('HTTP error')) {
            errorMessage = 'Erreur serveur - Vérifiez votre connexion';
        } else if (error.name === 'TypeError') {
            errorMessage = 'Erreur réseau - Impossible de joindre le serveur';
        }
        
        updateStatus(errorMessage, 'error');
        setTimeout(() => {
            isScanning = true;
            updateStatus('Recherche d\'un code QR...', 'waiting');
        }, 3000);
    }
}

// Auto start scanner when page loads
window.addEventListener('load', () => {
    startScanner();
});

// Stop scanner when page is about to unload
window.addEventListener('beforeunload', () => {
    stopScanner();
});
</script>
@endsection 