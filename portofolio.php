<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Profesional | Candra Argadinata, S.Kom</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #10b981; /* Emerald Green */
            --secondary: #059669; /* Forest Green */
            --dark: #064e3b; /* Dark Green */
            --bg-darker: #022c22; /* Deep Forest Black-Green */
            --glass: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-light: #ecfdf5;
            --text-muted: #a7f3d0;
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-darker);
            color: var(--text-light);
            overflow-x: hidden;
        }

        /* Latar Belakang Cahaya Hijau Statis */
        .bg-glow {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.15) 0%, transparent 60%);
            z-index: -1;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 25px; }

        /* Navigation */
        nav {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            background: rgba(2, 44, 34, 0.85); /* Nav Hijau Gelap */
            backdrop-filter: blur(15px);
            padding: 12px 40px;
            border-radius: 50px;
            border: 1px solid var(--glass-border);
            display: flex; gap: 30px; z-index: 9999;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        nav a {
            color: var(--text-muted); text-decoration: none; font-weight: 600;
            font-size: 13px; transition: 0.3s; text-transform: uppercase; letter-spacing: 1.5px;
        }

        nav a:hover { color: var(--primary); }

        /* Hero */
        header {
            height: 100vh; display: flex; align-items: center; justify-content: center;
            text-align: center; position: relative;
        }

        .profile-wrapper {
            position: relative; width: 170px; height: 170px; margin: 0 auto 35px;
        }

        .profile-img {
            width: 100%; height: 100%; border-radius: 50%; 
            object-fit: cover; border: 2px solid var(--glass-border); padding: 5px;
            z-index: 2; position: relative; background: var(--dark);
        }

        .profile-wrapper::after {
            content: ''; position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 50%; z-index: 1; filter: blur(25px); opacity: 0.5;
        }

        header h1 { font-size: 62px; font-weight: 800; letter-spacing: -2.5px; line-height: 1; margin-bottom: 15px; }
        header .badge { 
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 700;
            margin-bottom: 15px; display: inline-block; color: white;
        }

        /* Sections */
        section { padding: 120px 0; }
        .tag-line { color: var(--primary); font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 3px; display: block; margin-bottom: 10px; }
        h2.judul-seksi { font-size: 42px; font-weight: 800; margin-bottom: 50px; letter-spacing: -1.5px; }

        /* Glass Card */
        .kartu-utama {
            background: var(--glass);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            padding: 60px; border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }

        .kartu-utama p { font-size: 20px; color: var(--text-muted); line-height: 1.8; text-align: justify; }

        /* Skills Grid */
        .grid-keahlian {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;
        }

        .item-skill {
            background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.01) 100%);
            border: 1px solid var(--glass-border);
            padding: 40px; border-radius: 30px; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .item-skill:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--primary);
            background: rgba(255,255,255,0.1);
        }

        .icon-box {
            width: 60px; height: 60px; background: rgba(16, 185, 129, 0.15);
            border-radius: 18px; display: flex; align-items: center; justify-content: center;
            margin-bottom: 25px;
        }

        .item-skill i { font-size: 32px; color: var(--primary); }
        .item-skill h3 { font-size: 24px; font-weight: 700; margin-bottom: 15px; color: #fff; }
        .item-skill p { color: var(--text-muted); font-size: 16px; line-height: 1.6; opacity: 0.8; }

        /* Buttons */
        .cta-container { display: flex; justify-content: center; gap: 20px; margin-top: 40px; }
        .btn {
            padding: 18px 45px; border-radius: 50px; text-decoration: none;
            font-weight: 800; transition: 0.4s; font-size: 15px; display: flex; align-items: center; gap: 10px;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4); background: var(--secondary); }

        .btn-outline { border: 1px solid var(--glass-border); color: white; }
        .btn-outline:hover { background: var(--glass); transform: translateY(-5px); }

        footer { padding: 60px 0; text-align: center; border-top: 1px solid var(--glass-border); color: var(--text-muted); font-size: 14px; opacity: 0.7; }

        @media (max-width: 768px) {
            header h1 { font-size: 40px; }
            nav { width: 90%; padding: 12px 20px; gap: 15px; }
            .grid-keahlian { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="bg-glow"></div>

    <nav data-aos="fade-down" data-aos-duration="1000">
        <a href="Beranda.php">Home</a>
        <a href="#about">About</a>
        <a href="#skills">Skills</a>
        <a href="#contact">Contact</a>
    </nav>

    <header>
        <div class="container" data-aos="zoom-in" data-aos-duration="1200">
            <div class="profile-wrapper">
                <img src="gambar/candra.png" alt="Candra Argadinata" class="profile-img">
            </div>
            <span class="badge">IPK 3.80 | Lulusan Berprestasi</span>
            <h1>Candra Argadinata, <span style="color: var(--primary);">S.Kom</span></h1>
            <p style="color: var(--text-muted); font-size: 22px; max-width: 700px; margin: 0 auto;">Guru Informatika & Expert dalam Pengembangan Solusi Digital</p>
        </div>
    </header>

    <section id="about">
        <div class="container">
            <div class="kartu-utama" data-aos="fade-up">
                <span class="tag-line">Profil Profesional</span>
                <h2 class="judul-seksi">Inovasi Teknologi & Pendidikan</h2>
                <p>
                    Lulusan Teknik Informatika berprestasi (IPK 3.80) dengan keahlian mendalam dalam pengembangan perangkat lunak, UI/UX Design, dan Desain Grafis. Berpengalaman praktis dalam seluruh siklus pembuatan aplikasi, mulai dari konseptualisasi UI/UX hingga pengembangan fungsional. Memiliki rekam jejak dalam menciptakan solusi pembelajaran interaktif yang efektif dan mahir dalam Editor Video serta aplikasi Microsoft Office.
                </p>
            </div>
        </div>
    </section>

    <section id="skills">
        <div class="container">
            <div style="text-align: center; margin-bottom: 70px;">
                <span class="tag-line">Keahlian Utama</span>
                <h2 class="judul-seksi">Kompetensi Inti</h2>
            </div>
            
            <div class="grid-keahlian">
                <div class="item-skill" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box"><i class='bx bx-code-alt'></i></div>
                    <h3>Pengembangan Perangkat Lunak</h3>
                    <p>Mahir dalam seluruh siklus pembuatan aplikasi, mulai dari pengembangan fungsional hingga implementasi kode yang efisien.</p>
                </div>

                <div class="item-skill" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box"><i class='bx bx-user-voice'></i></div>
                    <h3>UI/UX Design</h3>
                    <p>Berpengalaman mendalam dalam konseptualisasi pengalaman pengguna dan perancangan antarmuka aplikasi yang intuitif.</p>
                </div>

                <div class="item-skill" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box"><i class='bx bx-paint-roll'></i></div>
                    <h3>Desain Grafis</h3>
                    <p>Menciptakan solusi visual kreatif dan estetis untuk mendukung komunikasi digital dan kebutuhan branding profesional.</p>
                </div>

                <div class="item-skill" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon-box"><i class='bx bx-unite'></i></div>
                    <h3>Pembelajaran Interaktif</h3>
                    <p>Mampu menciptakan solusi edukasi digital yang efektif untuk meningkatkan keterlibatan dan pemahaman siswa.</p>
                </div>

                <div class="item-skill" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon-box"><i class='bx bx-video-plus'></i></div>
                    <h3>Editor Video</h3>
                    <p>Keahlian teknis dalam penyuntingan video profesional untuk keperluan dokumentasi, edukasi, maupun konten kreatif.</p>
                </div>

                <div class="item-skill" data-aos="fade-up" data-aos-delay="600">
                    <div class="icon-box"><i class='bx bx-file-blank'></i></div>
                    <h3>Microsoft Office Expert</h3>
                    <p>Penguasaan tingkat lanjut pada Word, Excel, dan PowerPoint untuk manajemen data dan produktivitas administratif.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="kartu-utama" data-aos="zoom-in" style="text-align: center;">
                <h2 class="judul-seksi" style="margin-bottom: 20px;">Mari Berhubungan</h2>
                <p style="text-align: center; margin-bottom: 40px;">Tersedia untuk kolaborasi proyek IT, desain kreatif, atau pelatihan komputer profesional.</p>
                <div class="cta-container">
                    <a href="https://wa.me/6285776821436" class="btn btn-primary">
                        <i class='bx bxl-whatsapp'></i> WhatsApp
                    </a>
                    <a href="mailto:candra.argadinata1234@gmail.com" class="btn btn-outline">
                        <i class='bx bx-envelope'></i> Email
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Candra Argadinata, S.Kom. | Les Komputer Mari Belajar.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            once: true,
            easing: 'ease-in-out'
        });
    </script>
</body>
</html>