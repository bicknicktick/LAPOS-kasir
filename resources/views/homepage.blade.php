<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOS - Modern Point of Sale System</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        
        /* Homepage Container */
        .homepage-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10000;
            transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .homepage-container.slide-out {
            transform: translateX(-100%);
        }
        
        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 60px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        /* Logo */
        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 800;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        h1 {
            color: white;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .subtitle {
            color: #94a3b8;
            font-size: 18px;
            margin-bottom: 40px;
            font-weight: 400;
        }
        
        /* Enter Button */
        .enter-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px 60px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .enter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }
        
        .enter-btn:active {
            transform: translateY(0);
        }
        
        .enter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .enter-btn:hover::before {
            left: 100%;
        }
        
        /* Footer Links */
        .footer-links {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            position: relative;
        }
        
        .footer-links a:hover {
            color: #94a3b8;
        }
        
        .footer-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s;
        }
        
        .footer-links a:hover::after {
            width: 100%;
        }
        
        /* Powered By */
        .powered-by {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: #475569;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .powered-by a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .powered-by a:hover {
            color: #764ba2;
        }
        
        /* Particles Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particle-float 10s infinite;
        }
        
        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
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
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modal-slide-in 0.3s ease-out;
        }
        
        @keyframes modal-slide-in {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .modal p {
            color: #94a3b8;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .modal-close:hover {
            color: white;
        }
        
        /* Scrollbar */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <!-- Homepage -->
    <div class="homepage-container" id="homepage">
        <!-- Particles Background -->
        <div class="particles" id="particles"></div>
        
        <div class="glass-card">
            <div class="logo">L</div>
            <h1>LAPOS</h1>
            <p class="subtitle">Modern Point of Sale System</p>
            <button class="enter-btn" onclick="enterApp()">
                Enter Application
            </button>
            
            <div class="footer-links">
                <a href="#" onclick="openModal('about'); return false;">About</a>
                <a href="#" onclick="openModal('privacy'); return false;">Privacy Policy</a>
                <a href="#" onclick="openModal('terms'); return false;">Terms of Service</a>
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
            <p>LAPOS is a modern, elegant Point of Sale system designed for retail businesses of all sizes. Built with cutting-edge technology and a focus on user experience, LAPOS makes managing your sales, inventory, and customer transactions effortless.</p>
            
            <p><strong>Key Features:</strong></p>
            <p>• Real-time inventory management<br>
            • Fast and secure checkout process<br>
            • Support for multiple payment methods<br>
            • Currency redenomination ready<br>
            • Professional reporting system<br>
            • Clean and intuitive interface</p>
            
            <p><strong>Developer:</strong><br>
            Created with ❤️ by <a href="https://e.bitzy.id" target="_blank" style="color: #667eea;">e.bitzy.id</a></p>
            
            <p><strong>Support Development:</strong><br>
            If you find LAPOS useful, consider supporting our work:<br>
            <a href="https://paypal.me/bitzyid" target="_blank" style="color: #667eea;">Donate via PayPal</a></p>
        </div>
    </div>
    
    <!-- Privacy Policy Modal -->
    <div class="modal" id="privacy-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('privacy')">&times;</button>
            <h2>Privacy Policy</h2>
            <p><strong>Last updated: November 2024</strong></p>
            
            <p>At LAPOS, we take your privacy seriously. This Privacy Policy explains how we collect, use, and protect your information when you use our Point of Sale system.</p>
            
            <p><strong>Information We Collect:</strong><br>
            • Transaction data for record keeping<br>
            • Product inventory information<br>
            • Basic business information for system configuration</p>
            
            <p><strong>How We Use Your Information:</strong><br>
            • To process sales transactions<br>
            • To generate reports and analytics<br>
            • To maintain accurate inventory records<br>
            • To improve system performance</p>
            
            <p><strong>Data Security:</strong><br>
            We implement industry-standard security measures to protect your data. All sensitive information is encrypted and stored securely.</p>
            
            <p><strong>Contact:</strong><br>
            For privacy concerns, contact us at privacy@e.bitzy.id</p>
        </div>
    </div>
    
    <!-- Terms of Service Modal -->
    <div class="modal" id="terms-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('terms')">&times;</button>
            <h2>Terms of Service</h2>
            <p><strong>Last updated: November 2024</strong></p>
            
            <p><strong>1. Acceptance of Terms</strong><br>
            By using LAPOS, you agree to be bound by these Terms of Service.</p>
            
            <p><strong>2. License</strong><br>
            LAPOS is provided as-is for commercial and personal use. You may modify the software for your own needs.</p>
            
            <p><strong>3. Limitations</strong><br>
            • The software is provided "as is" without warranties<br>
            • We are not liable for any losses arising from use of the software<br>
            • Users are responsible for compliance with local regulations</p>
            
            <p><strong>4. Support</strong><br>
            Community support is available through our GitHub repository. Premium support options may be available.</p>
            
            <p><strong>5. Updates</strong><br>
            We may update these terms from time to time. Continued use constitutes acceptance of new terms.</p>
            
            <p><strong>6. Contact</strong><br>
            For questions about these terms, contact legal@e.bitzy.id</p>
        </div>
    </div>
    
    <script>
        // Generate particles
        function generateParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (10 + Math.random() * 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        // Enter application with slide animation
        function enterApp() {
            const homepage = document.getElementById('homepage');
            homepage.classList.add('slide-out');
            
            setTimeout(() => {
                window.location.href = '{{ route("transactions.create") }}';
            }, 1000);
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
        
        // Initialize
        generateParticles();
    </script>
</body>
</html>
