/**
 * ============================================
 * Translation System - Système de traduction
 * ============================================
 * Ce script gère le changement de langue FR/AR
 * ============================================
 */

(function() {
    'use strict';
    
    // Traductions stockées
    const translations = {
        'fr': {
            // Navbar
            'nav_home': 'Accueil',
            'nav_expertises': 'Expertises',
            'nav_projects': 'Projets',
            'nav_about': 'A propos',
            'nav_gallery': 'Galerie',
            'nav_contact': 'Contact',
            
            // Hero Section
            'hero_eyebrow': ' Marrakech',
            'hero_title': 'Atlas <span class="hero-brand">Cera</span> : bâtir, rénover, sublimer.',
            'hero_subtitle': 'De la conception à la livraison, nous transformons vos idées en réalités architecturales d\'exception.',
            'hero_cta_primary': 'Parler de votre projet',
            'hero_cta_secondary': 'Voir nos projets',
            'hero_stat_projects': 'Chantiers livrés',
            'hero_stat_years': 'Ans d\'expérience',
            'hero_stat_clients': 'Clients satisfaits',
            
            // Expertises
            'expertises_eyebrow': 'Expertises',
            'expertises_title': 'Des solutions complètes pour vos projets',
            'expertises_subtitle': 'Nos équipes accompagnent promoteurs, hôteliers, institutions et particuliers exigeants à travers tout le Royaume.',
            'expertise_construction_title': 'Construction globale',
            'expertise_construction_desc': 'Gestion intégrale de vos chantiers, du gros œuvre aux VRD, avec un suivi rigoureux et transparent.',
            'expertise_construction_item1': 'Planification & pilotage BIM',
            'expertise_construction_item2': 'Structures béton & métal',
            'expertise_construction_item3': 'Conformité normes marocaines',
            'expertise_renovation_title': 'Rénovation haut de gamme',
            'expertise_renovation_desc': 'Modernisation des villas, riads, bureaux et hôtels tout en respectant l\'âme architecturale.',
            'expertise_renovation_item1': 'Diagnostic structurel',
            'expertise_renovation_item2': 'Optimisation énergétique',
            'expertise_renovation_item3': 'Réaménagement sur-mesure',
            'expertise_decoration_title': 'Décoration intérieure & extérieure',
            'expertise_decoration_desc': 'Designers, menuisiers et ateliers de finition pour matérialiser votre identité de marque.',
            'expertise_decoration_item1': 'Concepts créatifs 3D',
            'expertise_decoration_item2': 'Matières nobles & artisanat',
            'expertise_decoration_item3': 'Aménagement paysager',
            
            // About
            'about_eyebrow': 'Pourquoi Atlas Cera ?',
            'about_title': 'Allier excellence technique et signature marocaine',
            'about_subtitle': 'Nous croyons que chaque projet mérite une attention artisanale, soutenue par des outils numériques de pointe. Notre approche collaborative associe architectes, décorateurs et artisans marocains certifiés.',
            'about_pillar1_title': 'Engagement qualité',
            'about_pillar1_desc': 'Contrôles hebdomadaires, reporting photo et garantis décennales.',
            'about_pillar2_title': 'Respect des délais',
            'about_pillar2_desc': 'Méthodologie Lean Construction et partenaires fidélisés.',
            'about_pillar3_title': 'Approche durable',
            'about_pillar3_desc': 'Matériaux locaux, gestion des déchets et optimisation énergétique.',
            
            // Projects
            'projects_eyebrow': 'Réalisations',
            'projects_title': 'Quelques projets récents',
            'projects_subtitle': 'Des espaces imaginés et construits avec passion dans tout le Maroc.',
            
            // Process
            'process_eyebrow': 'Méthodologie',
            'process_title': 'Un accompagnement clair en 5 étapes',
            'process_step1_title': 'Immersion',
            'process_step1_desc': 'Visite des lieux, étude du cahier des charges et chiffrage transparent.',
            'process_step2_title': 'Design & BIM',
            'process_step2_desc': 'Modélisation 3D, choix des matériaux et validation des prototypes.',
            'process_step3_title': 'Préparation',
            'process_step3_desc': 'Planning détaillé, sélection des artisans et logistique sur site.',
            'process_step4_title': 'Exécution',
            'process_step4_desc': 'Suivi chantier, contrôles qualité et comptes-rendus hebdomadaires.',
            'process_step5_title': 'Livraison',
            'process_step5_desc': 'Réception, garanties, formation des équipes et maintenance.',
            
            // Testimonials
            'testimonials_eyebrow': 'Ils nous font confiance',
            'testimonials_title': 'Témoignages clients',
            
            // Contact
            'contact_eyebrow': 'Contact',
            'contact_title': 'Parlons de votre projet',
            'contact_subtitle': 'Nous intervenons partout au Maroc. Réponse sous 48h ouvrées.',
            'contact_form_name': 'Nom complet*',
            'contact_form_email': 'Email professionnel*',
            'contact_form_phone': 'Téléphone',
            'contact_form_project_type': 'Type de projet',
            'contact_form_select': 'Sélectionner',
            'contact_form_project_construction': 'Construction neuve',
            'contact_form_project_renovation': 'Rénovation complète',
            'contact_form_project_decoration': 'Décoration & aménagement',
            'contact_form_message': 'Message*',
            'contact_form_submit': 'Envoyer',
            'contact_success_title': 'Message envoyé avec succès !',
            'contact_error_title': 'Erreur',
            
            // Footer
            'footer_text': 'Construction • Rénovation • Décoration',
            
            // Gallery
            'gallery_eyebrow': 'Galerie Photos',
            'gallery_title': 'Nos Réalisations en Images',
            'gallery_subtitle': 'Découvrez nos projets de construction, rénovation et décoration à travers le Maroc',
            'gallery_empty': 'Aucune image disponible pour le moment.',
        },
        'ar': {
            // Navbar
            'nav_home': 'الرئيسية',
            'nav_expertises': 'الخبرات',
            'nav_projects': 'المشاريع',
            'nav_about': 'من نحن',
            'nav_gallery': 'المعرض',
            'nav_contact': 'اتصل بنا',
            
            // Hero Section
            'hero_eyebrow': 'منذ 2001 — مراكش',
            'hero_title': 'أطلس <span class="hero-brand">سيرا</span> : بناء، تجديد، تجميل.',
            'hero_subtitle': 'من التصميم إلى التسليم، نحول أفكارك إلى واقع معماري استثنائي.',
            'hero_cta_primary': 'التحدث عن مشروعك',
            'hero_cta_secondary': 'رؤية مشاريعنا',
            'hero_stat_projects': 'مشروع تم إنجازه',
            'hero_stat_years': 'سنة من الخبرة',
            'hero_stat_clients': 'عميل راضٍ',
            
            // Expertises
            'expertises_eyebrow': 'الخبرات',
            'expertises_title': 'حلول شاملة لمشاريعك',
            'expertises_subtitle': 'ترافق فرقنا المطورين والفنادق والمؤسسات والأفراد المتطلبين في جميع أنحاء المملكة.',
            'expertise_construction_title': 'البناء الشامل',
            'expertise_construction_desc': 'إدارة متكاملة لمواقعك، من الأعمال الكبرى إلى الطرق والبنية التحتية، مع متابعة صارمة وشفافة.',
            'expertise_construction_item1': 'التخطيط وإدارة BIM',
            'expertise_construction_item2': 'الهياكل الخرسانية والمعدنية',
            'expertise_construction_item3': 'الامتثال للمعايير المغربية',
            'expertise_renovation_title': 'التجديد الفاخر',
            'expertise_renovation_desc': 'تحديث الفيلات والرياض والمكاتب والفنادق مع احترام الروح المعمارية.',
            'expertise_renovation_item1': 'التشخيص الهيكلي',
            'expertise_renovation_item2': 'تحسين الطاقة',
            'expertise_renovation_item3': 'إعادة التصميم حسب الطلب',
            'expertise_decoration_title': 'الديكور الداخلي والخارجي',
            'expertise_decoration_desc': 'المصممون والنجارون وورش التشطيب لتجسيد هويتك التجارية.',
            'expertise_decoration_item1': 'مفاهيم إبداعية ثلاثية الأبعاد',
            'expertise_decoration_item2': 'المواد النبيلة والحرف اليدوية',
            'expertise_decoration_item3': 'تنسيق الحدائق',
            
            // About
            'about_eyebrow': 'لماذا أطلس سيرا؟',
            'about_title': 'الجمع بين التميز التقني والتوقيع المغربي',
            'about_subtitle': 'نؤمن بأن كل مشروع يستحق اهتمامًا حرفيًا، مدعومًا بأدوات رقمية متطورة. نهجنا التعاوني يجمع المهندسين المعماريين والمصممين والحرفيين المغاربة المعتمدين.',
            'about_pillar1_title': 'التزام بالجودة',
            'about_pillar1_desc': 'ضوابط أسبوعية، تقارير صورية وضمانات عشرية.',
            'about_pillar2_title': 'احترام المواعيد',
            'about_pillar2_desc': 'منهجية Lean Construction وشركاء مخلصون.',
            'about_pillar3_title': 'نهج مستدام',
            'about_pillar3_desc': 'مواد محلية، إدارة النفايات وتحسين الطاقة.',
            
            // Projects
            'projects_eyebrow': 'الإنجازات',
            'projects_title': 'بعض المشاريع الأخيرة',
            'projects_subtitle': 'مساحات متخيلة ومبنية بشغف في جميع أنحاء المغرب.',
            
            // Process
            'process_eyebrow': 'المنهجية',
            'process_title': 'مرافقة واضحة في 5 خطوات',
            'process_step1_title': 'الانغماس',
            'process_step1_desc': 'زيارة الأماكن، دراسة دفتر الشروط وتسعير شفاف.',
            'process_step2_title': 'التصميم و BIM',
            'process_step2_desc': 'النمذجة ثلاثية الأبعاد، اختيار المواد والتحقق من النماذج الأولية.',
            'process_step3_title': 'التحضير',
            'process_step3_desc': 'التخطيط التفصيلي، اختيار الحرفيين واللوجستيات في الموقع.',
            'process_step4_title': 'التنفيذ',
            'process_step4_desc': 'متابعة الموقع، ضوابط الجودة والتقارير الأسبوعية.',
            'process_step5_title': 'التسليم',
            'process_step5_desc': 'الاستلام، الضمانات، تدريب الفرق والصيانة.',
            
            // Testimonials
            'testimonials_eyebrow': 'يثقون بنا',
            'testimonials_title': 'شهادات العملاء',
            
            // Contact
            'contact_eyebrow': 'اتصل بنا',
            'contact_title': 'دعنا نتحدث عن مشروعك',
            'contact_subtitle': 'نعمل في جميع أنحاء المغرب. رد في غضون 48 ساعة عمل.',
            'contact_form_name': 'الاسم الكامل*',
            'contact_form_email': 'البريد الإلكتروني المهني*',
            'contact_form_phone': 'الهاتف',
            'contact_form_project_type': 'نوع المشروع',
            'contact_form_select': 'اختر',
            'contact_form_project_construction': 'بناء جديد',
            'contact_form_project_renovation': 'تجديد كامل',
            'contact_form_project_decoration': 'الديكور والتجهيز',
            'contact_form_message': 'الرسالة*',
            'contact_form_submit': 'إرسال',
            'contact_success_title': 'تم إرسال الرسالة بنجاح!',
            'contact_error_title': 'خطأ',
            
            // Footer
            'footer_text': 'البناء • التجديد • الديكور',
            
            // Gallery
            'gallery_eyebrow': 'معرض الصور',
            'gallery_title': 'إنجازاتنا بالصور',
            'gallery_subtitle': 'اكتشف مشاريعنا في البناء والتجديد والديكور في جميع أنحاء المغرب',
            'gallery_empty': 'لا توجد صور متاحة في الوقت الحالي.',
        }
    };
    
    // Langue actuelle (par défaut: français)
    let currentLang = localStorage.getItem('site_language') || 'fr';
    
        // Fonction pour changer la langue
        function changeLanguage(lang) {
            if (!translations[lang]) return;
            
            currentLang = lang;
            localStorage.setItem('site_language', lang);
            
            // Prevent navbar layout shift by maintaining fixed positions
            const navbar = document.getElementById('mainNavbar');
            if (navbar) {
                // Store current navbar state
                navbar.style.willChange = 'auto';
                navbar.style.transform = 'none';
            }
            
            // Changer l'attribut lang et dir du HTML
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
            
            // Ajouter une classe pour le style RTL
            if (lang === 'ar') {
                document.documentElement.classList.add('rtl');
                document.body.classList.add('rtl');
            } else {
                document.documentElement.classList.remove('rtl');
                document.body.classList.remove('rtl');
            }
            
            // Traduire tous les éléments avec data-translate
            document.querySelectorAll('[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[lang][key]) {
                    // Preserve layout for navbar links
                    if (element.closest('.nav-links')) {
                        const currentWidth = element.offsetWidth;
                        element.textContent = translations[lang][key];
                        // Force reflow to maintain position
                        void element.offsetWidth;
                    } else {
                        // Use innerHTML for elements that may contain HTML (like hero_title with span)
                        if (translations[lang][key].includes('<span') || translations[lang][key].includes('<')) {
                            element.innerHTML = translations[lang][key];
                        } else {
                            element.textContent = translations[lang][key];
                        }
                    }
                }
            });
            
            // Traduire les placeholders
            document.querySelectorAll('[data-translate-placeholder]').forEach(element => {
                const key = element.getAttribute('data-translate-placeholder');
                if (translations[lang][key]) {
                    element.placeholder = translations[lang][key];
                }
            });
            
            // Traduire les valeurs des options select
            document.querySelectorAll('select option[data-translate-option]').forEach(element => {
                const key = element.getAttribute('data-translate-option');
                if (translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            // Traduire les labels avec span
            document.querySelectorAll('label span[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            // Mettre à jour le switch de langue
            const langSwitch = document.getElementById('langSwitch');
            if (langSwitch) {
                langSwitch.setAttribute('data-lang', lang);
            }
            
            // Ensure navbar stays fixed after language change
            if (navbar) {
                requestAnimationFrame(() => {
                    navbar.style.position = 'fixed';
                    navbar.style.top = '0';
                    navbar.style.left = '0';
                    navbar.style.right = '0';
                    navbar.style.width = '100%';
                    navbar.style.zIndex = '99999';
                });
            }
        }
    
    // Initialisation
    function init() {
        // Appliquer la langue sauvegardée
        changeLanguage(currentLang);
        
        // Écouter les clics sur le switch de langue
        const langSwitch = document.getElementById('langSwitch');
        if (langSwitch) {
            // Set initial data-lang attribute
            langSwitch.setAttribute('data-lang', currentLang);
            
            langSwitch.addEventListener('click', function() {
                // Toggle entre FR et AR
                const currentLangValue = this.getAttribute('data-lang') || 'fr';
                const newLang = currentLangValue === 'fr' ? 'ar' : 'fr';
                changeLanguage(newLang);
            });
        }
    }
    
    // Attendre que le DOM soit chargé
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Exposer la fonction pour utilisation externe
    window.changeLanguage = changeLanguage;
    window.getCurrentLanguage = () => currentLang;
    
})();

