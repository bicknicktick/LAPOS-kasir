<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOS - Point of Sale System</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
            overflow: hidden;
        }
        
        /* Homepage Container */
        .homepage-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f6fa 0%, #e8ecef 100%);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10000;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .homepage-container.slide-out {
            transform: translateX(-100%);
        }
        
        /* Main Card */
        .main-card {
            background: white;
            border-radius: 16px;
            padding: 60px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e4e8;
        }
        
        /* Logo */
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: #2c3e50;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 800;
            color: white;
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }
        
        h1 {
            color: #2c3e50;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 40px;
            font-weight: 400;
        }
        
        /* Enter Button */
        .enter-btn {
            background: #16a085;
            color: white;
            border: none;
            padding: 16px 50px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(22, 160, 133, 0.3);
        }
        
        .enter-btn:hover {
            background: #138d75;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(22, 160, 133, 0.4);
        }
        
        .enter-btn:active {
            transform: translateY(0);
        }
        
        /* Footer Links */
        .footer-links {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: #95a5a6;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #2c3e50;
        }
        
        /* Powered By */
        .powered-by {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: #95a5a6;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .powered-by a {
            color: #16a085;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .powered-by a:hover {
            color: #138d75;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 20000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .modal.show {
            display: flex;
            opacity: 1;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modal-slide-in 0.3s ease-out;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes modal-slide-in {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .modal p {
            color: #7f8c8d;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        .modal strong {
            color: #2c3e50;
        }
        
        .modal a {
            color: #16a085;
            text-decoration: none;
        }
        
        .modal a:hover {
            text-decoration: underline;
        }
        
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #95a5a6;
            font-size: 28px;
            cursor: pointer;
            transition: color 0.3s;
            line-height: 1;
        }
        
        .modal-close:hover {
            color: #2c3e50;
        }
        
        /* Scrollbar */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .modal-content::-webkit-scrollbar-track {
            background: #f5f6fa;
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb {
            background: #bdc3c7;
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #95a5a6;
        }
        
        /* Version Badge */
        .version {
            display: inline-block;
            background: #ecf0f1;
            color: #7f8c8d;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Homepage -->
    <div class="homepage-container" id="homepage">
        <div class="main-card">
            <div class="logo">L</div>
            <h1>LAPOS</h1>
            <p class="subtitle">Modern Point of Sale System</p>
            <span class="version">v1.0.0</span>
            
            <div style="margin-top: 40px;">
                <button class="enter-btn" onclick="enterApp()">
                    Enter Application
                </button>
            </div>
            
            <div class="footer-links">
                <a href="#" onclick="openModal('about'); return false;">About</a>
                <a href="#" onclick="openModal('privacy'); return false;">Privacy</a>
                <a href="#" onclick="openModal('terms'); return false;">Terms</a>
            </div>
        </div>
        
        <div class="powered-by">
            Powered by <a href="https://e.bitzy.id" target="_blank">e.bitzy.id</a>
        </div>
    </div>
    
    <!-- About Modal -->
    <div class="modal" id="about-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('about')">&times;</button>
            <h2>About LAPOS</h2>
            <p>LAPOS is a modern Point of Sale system designed for retail businesses. Built with Laravel and focused on simplicity and efficiency.</p>
            
            <p><strong>Key Features:</strong></p>
            <p>• Real-time inventory management<br>
            • Fast checkout process<br>
            • Multiple payment methods<br>
            • Currency redenomination support<br>
            • Professional reporting<br>
            • Clean interface</p>
            
            <p><strong>Developer:</strong><br>
            Created by <a href="https://e.bitzy.id" target="_blank">e.bitzy.id</a></p>
            
            <p><strong>Support:</strong><br>
            <a href="https://paypal.me/bitzyid" target="_blank">Donate via PayPal</a></p>
        </div>
    </div>
    
    <!-- Privacy Policy Modal -->
    <div class="modal" id="privacy-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('privacy')">&times;</button>
            <h2>Privacy Policy</h2>
            <p><strong>Last updated: November 2024</strong></p>
            
            <p>LAPOS respects your privacy. This policy explains how we handle your information.</p>
            
            <p><strong>Information Collection:</strong><br>
            • Transaction data for business records<br>
            • Product inventory information<br>
            • Basic configuration data</p>
            
            <p><strong>Data Usage:</strong><br>
            • Process sales transactions<br>
            • Generate business reports<br>
            • Maintain inventory accuracy</p>
            
            <p><strong>Security:</strong><br>
            All data is stored locally and encrypted. We implement standard security practices.</p>
            
            <p><strong>Contact:</strong><br>
            privacy@e.bitzy.id</p>
        </div>
    </div>
    
    <!-- Terms Modal -->
    <div class="modal" id="terms-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('terms')">&times;</button>
            <h2>Terms of Service</h2>
            <p><strong>Last updated: November 2024</strong></p>
            
            <p><strong>1. Acceptance</strong><br>
            By using LAPOS, you agree to these terms.</p>
            
            <p><strong>2. License</strong><br>
            LAPOS is provided under MIT License for commercial and personal use.</p>
            
            <p><strong>3. Limitations</strong><br>
            • Software provided "as is"<br>
            • No warranties expressed or implied<br>
            • Users responsible for local compliance</p>
            
            <p><strong>4. Support</strong><br>
            Community support via GitHub repository.</p>
            
            <p><strong>5. Contact</strong><br>
            legal@e.bitzy.id</p>
        </div>
    </div>
    
    <script>
        // Enter application with slide animation
        function enterApp() {
            const homepage = document.getElementById('homepage');
            homepage.classList.add('slide-out');
            
            setTimeout(() => {
                window.location.href = '{{ route("transactions.create") }}';
            }, 800);
        }
        
        // Modal functions
        function openModal(type) {
            const modal = document.getElementById(type + '-modal');
            modal.classList.add('show');
        }
        
        function closeModal(type) {
            const modal = document.getElementById(type + '-modal');
            modal.classList.remove('show');
        }
        
        // Close modal on outside click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });
        
        // ESC key to close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>
