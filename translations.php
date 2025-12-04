<?php
/**
 * Translation system for Atlas Cera website
 * Supports Arabic and French languages
 */

// Get current language from session or default to French
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr'; // Default language
}

$lang = $_SESSION['lang'];

// Translation arrays
$translations = [
    'fr' => [
        // Navigation
        'nav_home' => 'Accueil',
        'nav_expertises' => 'Expertises',
        'nav_projects' => 'Projets',
        'nav_about' => 'A propos',
        'nav_gallery' => 'Galerie',
        'nav_contact' => 'Contact',
        
        // Hero section
        'hero_since' => 'Depuis 2001 — Marrakech',
        'hero_title' => 'Atlas <span class="hero-brand">Cera</span> : bâtir, rénover, sublimer.',
        'hero_cta_primary' => 'Parler de votre projet',
        'hero_cta_secondary' => 'Voir nos projets',
        
        // Expertises section
        'expertises_eyebrow' => 'Expertises',
        'expertises_title' => 'Des solutions complètes pour vos projets',
        'expertises_desc' => 'Nos équipes accompagnent promoteurs, hôteliers, institutions et particuliers exigeants à travers tout le Royaume.',
        'expertises_construction_title' => 'Construction globale',
        'expertises_construction_desc' => 'Gestion intégrale de vos chantiers, du gros œuvre aux VRD, avec un suivi rigoureux et transparent.',
        'expertises_construction_item1' => 'Planification & pilotage BIM',
        'expertises_construction_item2' => 'Structures béton & métal',
        'expertises_construction_item3' => 'Conformité normes marocaines',
        'expertises_renovation_title' => 'Rénovation haut de gamme',
        'expertises_renovation_desc' => 'Modernisation des villas, riads, bureaux et hôtels tout en respectant l\'âme architecturale.',
        'expertises_renovation_item1' => 'Diagnostic structurel',
        'expertises_renovation_item2' => 'Optimisation énergétique',
        'expertises_renovation_item3' => 'Réaménagement sur-mesure',
        'expertises_decoration_title' => 'Décoration intérieure & extérieure',
        'expertises_decoration_desc' => 'Designers, menuisiers et ateliers de finition pour matérialiser votre identité de marque.',
        'expertises_decoration_item1' => 'Concepts créatifs 3D',
        'expertises_decoration_item2' => 'Matières nobles & artisanat',
        'expertises_decoration_item3' => 'Aménagement paysager',
        
        // Values section
        'values_eyebrow' => 'Pourquoi Atlas Cera ?',
        'values_title' => 'Allier excellence technique et signature marocaine',
        'values_desc' => 'Nous croyons que chaque projet mérite une attention artisanale, soutenue par des outils numériques de pointe. Notre approche collaborative associe architectes, décorateurs et artisans marocains certifiés.',
        'values_quality_title' => 'Engagement qualité',
        'values_quality_desc' => 'Contrôles hebdomadaires, reporting photo et garantis décennales.',
        'values_deadline_title' => 'Respect des délais',
        'values_deadline_desc' => 'Méthodologie Lean Construction et partenaires fidélisés.',
        'values_sustainable_title' => 'Approche durable',
        'values_sustainable_desc' => 'Matériaux locaux, gestion des déchets et optimisation énergétique.',
        'values_gallery_badge_expertise' => 'Expertise',
        'values_gallery_badge_quality' => 'Qualité',
        'values_gallery_badge_precision' => 'Précision',
        'values_gallery_badge_excellence' => 'Excellence',
        'values_gallery_installation' => 'Installation précise',
        'values_gallery_installation_desc' => 'Nos artisans maîtrisent les techniques de pose les plus avancées',
        'values_gallery_tools' => 'Outils professionnels',
        'values_gallery_laser' => 'Niveau laser',
        'values_gallery_finishes' => 'Finitions parfaites',
        'values_gallery_finishes_desc' => 'Chaque détail compte pour un résultat impeccable',
        
        // Projects section
        'projects_eyebrow' => 'Réalisations',
        'projects_title' => 'Quelques projets récents',
        'projects_desc' => 'Des espaces imaginés et construits avec passion dans tout le Maroc.',
        'project_villa_title' => 'Villa Aïn Diab',
        'project_villa_desc' => 'Construction complète d\'une villa contemporaine de 1 200 m² avec patio central et piscine miroir.',
        'project_riad_title' => 'Riad Dar Lalla',
        'project_riad_desc' => 'Rénovation patrimoniale avec intégration domotique et zellige sur mesure.',
        'project_office_title' => 'Siège Noor Invest',
        'project_office_desc' => 'Plateaux de bureaux flexibles, certification HQE et espaces lounges pour les collaborateurs.',
        'project_hotel_title' => 'Hôtel Royal Agadir',
        'project_hotel_desc' => 'Rénovation complète d\'un hôtel 5 étoiles avec spa, restaurants et suites de luxe.',
        'project_residential_title' => 'Complexe Résidentiel Atlas',
        'project_residential_desc' => 'Construction d\'un complexe résidentiel de 50 appartements avec espaces communs premium.',
        'project_store_title' => 'Boutique Concept Store',
        'project_store_desc' => 'Aménagement et décoration d\'un concept store moderne avec matériaux locaux et design contemporain.',
        'project_location_casablanca' => 'Casablanca',
        'project_location_marrakech' => 'Marrakech',
        'project_location_rabat' => 'Rabat',
        'project_location_agadir' => 'Agadir',
        'project_location_tanger' => 'Tanger',
        
        // Gallery section
        'gallery_eyebrow' => 'Galerie Photos',
        'gallery_title' => 'Nos Réalisations en Images',
        'gallery_desc' => 'Découvrez nos projets de construction, rénovation et décoration à travers le Maroc',
        'gallery_empty' => 'Aucune image disponible pour le moment.',
        'gallery_page_title' => 'Nos Réalisations en Images',
        'gallery_page_empty_title' => 'Aucune image disponible',
        'gallery_page_empty_desc' => 'La galerie sera bientôt mise à jour avec nos dernières réalisations.',
        'gallery_close' => 'Fermer',
        'gallery_prev' => 'Image précédente',
        'gallery_next' => 'Image suivante',
        
        // Process section
        'process_eyebrow' => 'Méthodologie',
        'process_title' => 'Un accompagnement clair en 5 étapes',
        'process_step1_num' => '01',
        'process_step1_title' => 'Immersion',
        'process_step1_desc' => 'Visite des lieux, étude du cahier des charges et chiffrage transparent.',
        'process_step2_num' => '02',
        'process_step2_title' => 'Design & BIM',
        'process_step2_desc' => 'Modélisation 3D, choix des matériaux et validation des prototypes.',
        'process_step3_num' => '03',
        'process_step3_title' => 'Préparation',
        'process_step3_desc' => 'Planning détaillé, sélection des artisans et logistique sur site.',
        'process_step4_num' => '04',
        'process_step4_title' => 'Exécution',
        'process_step4_desc' => 'Suivi chantier, contrôles qualité et comptes-rendus hebdomadaires.',
        'process_step5_num' => '05',
        'process_step5_title' => 'Livraison',
        'process_step5_desc' => 'Réception, garanties, formation des équipes et maintenance.',
        
        // Testimonials section
        'testimonials_eyebrow' => 'Ils nous font confiance',
        'testimonials_title' => 'Témoignages clients',
        'testimonial1_text' => '"Atlas Cera a transformé notre resort en un temps record avec une qualité irréprochable. Communication fluide du début à la fin."',
        'testimonial1_author' => 'Salma B. — Directrice hôtelière',
        'testimonial2_text' => '"Une équipe passionnée qui propose toujours plusieurs options créatives tout en respectant les budgets."',
        'testimonial2_author' => 'Youssef R. — Promoteur immobilier',
        'testimonial3_text' => '"Nous avons centralisé notre patrimoine de boutiques sous un seul contractant. Atlas Cera maîtrise parfaitement la décoration retail."',
        'testimonial3_author' => 'Imane K. — Retail Manager',
        
        // Contact section
        'contact_eyebrow' => 'Contact',
        'contact_title' => 'Parlons de votre projet',
        'contact_desc' => 'Nous intervenons partout au Maroc. Réponse sous 48h ouvrées.',
        'contact_form_name' => 'Nom complet*',
        'contact_form_email' => 'Email professionnel*',
        'contact_form_phone' => 'Téléphone',
        'contact_form_project_type' => 'Type de projet',
        'contact_form_project_select' => 'Sélectionner',
        'contact_form_project_construction' => 'Construction neuve',
        'contact_form_project_renovation' => 'Rénovation complète',
        'contact_form_project_decoration' => 'Décoration & aménagement',
        'contact_form_message' => 'Message*',
        'contact_form_submit' => 'Envoyer',
        'contact_office_title' => 'Bureaux',
        'contact_office_address' => 'lot iguider N 48 av allal el fassi <br>Marrakech',
        'contact_calls_title' => 'Appels',
        'contact_email_title' => 'Email',
        'contact_social_title' => 'Réseaux',
        'contact_alert_success_title' => 'Message envoyé avec succès !',
        'contact_alert_error_title' => 'Erreur',
        'contact_alert_error_validation' => 'Merci de compléter les champs requis et d\'indiquer un email valide.',
        'contact_alert_success_message' => 'Merci {name}, votre message a été enregistré{email_status}',
        'contact_alert_success_email_sent' => ' et envoyé.',
        'contact_alert_success_email_not_sent' => '.',
        'contact_alert_error_save' => 'Votre message n\'a pas pu être enregistré. Merci d\'appeler le 0524308038.',
        
        // Footer
        'footer_tagline' => 'Construction • Rénovation • Décoration',
        
        // Meta
        'meta_description' => 'Atlas Cera - Expert marocain en construction, rénovation et décoration intérieure & extérieure.',
        'meta_title' => 'Atlas Cera | Construction & Décoration au Maroc',
        'meta_gallery_description' => 'Galerie Photos - Atlas Cera - Nos réalisations en construction, rénovation et décoration.',
        'meta_gallery_title' => 'Galerie | Atlas Cera',
    ],
    'ar' => [
        // Navigation
        'nav_home' => 'الرئيسية',
        'nav_expertises' => 'الخبرات',
        'nav_projects' => 'المشاريع',
        'nav_about' => 'من نحن',
        'nav_gallery' => 'المعرض',
        'nav_contact' => 'اتصل بنا',
        
        // Hero section
        'hero_since' => 'منذ 2001 — مراكش',
        'hero_title' => 'أطلس <span class="hero-brand">سيرا</span>: بناء، تجديد، إبداع.',
        'hero_cta_primary' => 'تحدث عن مشروعك',
        'hero_cta_secondary' => 'شاهد مشاريعنا',
        
        // Expertises section
        'expertises_eyebrow' => 'الخبرات',
        'expertises_title' => 'حلول شاملة لمشاريعك',
        'expertises_desc' => 'ترافق فرقنا المطورين، أصحاب الفنادق، المؤسسات والأفراد المطالبين في جميع أنحاء المملكة.',
        'expertises_construction_title' => 'البناء الشامل',
        'expertises_construction_desc' => 'إدارة متكاملة لمواقعك، من الأعمال الأساسية إلى البنية التحتية، مع متابعة دقيقة وشفافة.',
        'expertises_construction_item1' => 'التخطيط والإدارة باستخدام BIM',
        'expertises_construction_item2' => 'الهياكل الخرسانية والمعدنية',
        'expertises_construction_item3' => 'الامتثال للمعايير المغربية',
        'expertises_renovation_title' => 'التجديد الفاخر',
        'expertises_renovation_desc' => 'تحديث الفيلات، الرياض، المكاتب والفنادق مع الحفاظ على الروح المعمارية.',
        'expertises_renovation_item1' => 'التشخيص الهيكلي',
        'expertises_renovation_item2' => 'تحسين الطاقة',
        'expertises_renovation_item3' => 'إعادة التصميم حسب الطلب',
        'expertises_decoration_title' => 'الديكور الداخلي والخارجي',
        'expertises_decoration_desc' => 'مصممون، نجارون وورشات التشطيب لتحقيق هوية علامتك التجارية.',
        'expertises_decoration_item1' => 'مفاهيم إبداعية ثلاثية الأبعاد',
        'expertises_decoration_item2' => 'مواد نبيلة وحرف يدوية',
        'expertises_decoration_item3' => 'تنسيق المناظر الطبيعية',
        
        // Values section
        'values_eyebrow' => 'لماذا أطلس سيرا؟',
        'values_title' => 'الجمع بين التميز التقني والهوية المغربية',
        'values_desc' => 'نؤمن بأن كل مشروع يستحق عناية حرفية، مدعومة بأدوات رقمية متطورة. نهجنا التعاوني يجمع بين المهندسين المعماريين، المصممين والحرفيين المغاربة المعتمدين.',
        'values_quality_title' => 'الالتزام بالجودة',
        'values_quality_desc' => 'مراقبة أسبوعية، تقارير صورية وضمانات عشرية.',
        'values_deadline_title' => 'احترام المواعيد',
        'values_deadline_desc' => 'منهجية Lean Construction وشركاء موثوقون.',
        'values_sustainable_title' => 'نهج مستدام',
        'values_sustainable_desc' => 'مواد محلية، إدارة النفايات وتحسين الطاقة.',
        'values_gallery_badge_expertise' => 'الخبرة',
        'values_gallery_badge_quality' => 'الجودة',
        'values_gallery_badge_precision' => 'الدقة',
        'values_gallery_badge_excellence' => 'التميز',
        'values_gallery_installation' => 'تركيب دقيق',
        'values_gallery_installation_desc' => 'حرفيوننا يتقنون تقنيات التركيب الأكثر تقدماً',
        'values_gallery_tools' => 'أدوات احترافية',
        'values_gallery_laser' => 'مستوى ليزر',
        'values_gallery_finishes' => 'تشطيبات مثالية',
        'values_gallery_finishes_desc' => 'كل التفاصيل مهمة لنتيجة لا تشوبها شائبة',
        
        // Projects section
        'projects_eyebrow' => 'الإنجازات',
        'projects_title' => 'بعض المشاريع الأخيرة',
        'projects_desc' => 'مساحات متخيلة ومبنية بشغف في جميع أنحاء المغرب.',
        'project_villa_title' => 'فيلا عين الدياب',
        'project_villa_desc' => 'بناء كامل لفيلا معاصرة بمساحة 1200 م² مع فناء مركزي وبركة مرآة.',
        'project_riad_title' => 'رياض دار للا',
        'project_riad_desc' => 'تجديد تراثي مع تكامل ذكي وزلّيج حسب الطلب.',
        'project_office_title' => 'مقر نور إنفست',
        'project_office_desc' => 'مساحات مكتبية مرنة، شهادة HQE ومساحات استراحة للمتعاونين.',
        'project_hotel_title' => 'فندق رويال أغادير',
        'project_hotel_desc' => 'تجديد كامل لفندق 5 نجوم مع سبا، مطاعم وأجنحة فاخرة.',
        'project_residential_title' => 'مجمع أطلس السكني',
        'project_residential_desc' => 'بناء مجمع سكني من 50 شقة مع مساحات مشتركة متميزة.',
        'project_store_title' => 'متجر كونسبت',
        'project_store_desc' => 'تجهيز وديكور متجر حديث مع مواد محلية وتصميم معاصر.',
        'project_location_casablanca' => 'الدار البيضاء',
        'project_location_marrakech' => 'مراكش',
        'project_location_rabat' => 'الرباط',
        'project_location_agadir' => 'أغادير',
        'project_location_tanger' => 'طنجة',
        
        // Gallery section
        'gallery_eyebrow' => 'معرض الصور',
        'gallery_title' => 'إنجازاتنا بالصور',
        'gallery_desc' => 'اكتشف مشاريعنا في البناء، التجديد والديكور في جميع أنحاء المغرب',
        'gallery_empty' => 'لا توجد صور متاحة في الوقت الحالي.',
        'gallery_page_title' => 'إنجازاتنا بالصور',
        'gallery_page_empty_title' => 'لا توجد صور متاحة',
        'gallery_page_empty_desc' => 'سيتم تحديث المعرض قريباً بأحدث إنجازاتنا.',
        'gallery_close' => 'إغلاق',
        'gallery_prev' => 'الصورة السابقة',
        'gallery_next' => 'الصورة التالية',
        
        // Process section
        'process_eyebrow' => 'المنهجية',
        'process_title' => 'مرافقة واضحة في 5 خطوات',
        'process_step1_num' => '01',
        'process_step1_title' => 'الانغماس',
        'process_step1_desc' => 'زيارة الموقع، دراسة المتطلبات وتقدير شفاف.',
        'process_step2_num' => '02',
        'process_step2_title' => 'التصميم و BIM',
        'process_step2_desc' => 'النمذجة ثلاثية الأبعاد، اختيار المواد والتحقق من النماذج الأولية.',
        'process_step3_num' => '03',
        'process_step3_title' => 'التحضير',
        'process_step3_desc' => 'تخطيط مفصل، اختيار الحرفيين واللوجستيات في الموقع.',
        'process_step4_num' => '04',
        'process_step4_title' => 'التنفيذ',
        'process_step4_desc' => 'متابعة الموقع، مراقبة الجودة وتقارير أسبوعية.',
        'process_step5_num' => '05',
        'process_step5_title' => 'التسليم',
        'process_step5_desc' => 'الاستلام، الضمانات، تدريب الفرق والصيانة.',
        
        // Testimonials section
        'testimonials_eyebrow' => 'يثقون بنا',
        'testimonials_title' => 'شهادات العملاء',
        'testimonial1_text' => '"حولت أطلس سيرا منتجعنا في وقت قياسي بجودة لا تشوبها شائبة. تواصل سلس من البداية إلى النهاية."',
        'testimonial1_author' => 'سلمى ب. — مديرة فندقية',
        'testimonial2_text' => '"فريق شغوف يقترح دائماً عدة خيارات إبداعية مع احترام الميزانيات."',
        'testimonial2_author' => 'يوسف ر. — مطور عقاري',
        'testimonial3_text' => '"ركزنا تراثنا من المتاجر تحت مقاول واحد. أطلس سيرا تتقن تماماً ديكور التجزئة."',
        'testimonial3_author' => 'إيمان ك. — مديرة التجزئة',
        
        // Contact section
        'contact_eyebrow' => 'اتصل بنا',
        'contact_title' => 'تحدث عن مشروعك',
        'contact_desc' => 'نعمل في جميع أنحاء المغرب. رد خلال 48 ساعة عمل.',
        'contact_form_name' => 'الاسم الكامل*',
        'contact_form_email' => 'البريد الإلكتروني المهني*',
        'contact_form_phone' => 'الهاتف',
        'contact_form_project_type' => 'نوع المشروع',
        'contact_form_project_select' => 'اختر',
        'contact_form_project_construction' => 'بناء جديد',
        'contact_form_project_renovation' => 'تجديد كامل',
        'contact_form_project_decoration' => 'ديكور وتجهيز',
        'contact_form_message' => 'الرسالة*',
        'contact_form_submit' => 'إرسال',
        'contact_office_title' => 'المكاتب',
        'contact_office_address' => 'قطعة إكيدر رقم 48 شارع علال الفاسي <br>مراكش',
        'contact_calls_title' => 'المكالمات',
        'contact_email_title' => 'البريد الإلكتروني',
        'contact_social_title' => 'الشبكات',
        'contact_alert_success_title' => 'تم إرسال الرسالة بنجاح!',
        'contact_alert_error_title' => 'خطأ',
        'contact_alert_error_validation' => 'يرجى إكمال الحقول المطلوبة وإدخال بريد إلكتروني صحيح.',
        'contact_alert_success_message' => 'شكراً {name}، تم حفظ رسالتك{email_status}',
        'contact_alert_success_email_sent' => ' وإرسالها.',
        'contact_alert_success_email_not_sent' => '.',
        'contact_alert_error_save' => 'لم يتم حفظ رسالتك. يرجى الاتصال على 0524308038.',
        
        // Footer
        'footer_tagline' => 'بناء • تجديد • ديكور',
        
        // Meta
        'meta_description' => 'أطلس سيرا - خبير مغربي في البناء، التجديد والديكور الداخلي والخارجي.',
        'meta_title' => 'أطلس سيرا | البناء والديكور في المغرب',
        'meta_gallery_description' => 'معرض الصور - أطلس سيرا - إنجازاتنا في البناء، التجديد والديكور.',
        'meta_gallery_title' => 'المعرض | أطلس سيرا',
    ]
];

/**
 * Translation function
 * @param string $key Translation key
 * @param array $params Optional parameters to replace in translation
 * @return string Translated text
 */
function t($key, $params = []) {
    global $translations, $lang;
    
    if (!isset($translations[$lang][$key])) {
        // Fallback to French if translation not found
        if (isset($translations['fr'][$key])) {
            $text = $translations['fr'][$key];
        } else {
            return $key; // Return key if no translation found
        }
    } else {
        $text = $translations[$lang][$key];
    }
    
    // Replace parameters
    if (!empty($params)) {
        foreach ($params as $param => $value) {
            $text = str_replace('{' . $param . '}', $value, $text);
        }
    }
    
    return $text;
}

/**
 * Get current language
 * @return string Current language code
 */
function getCurrentLang() {
    global $lang;
    return $lang;
}

/**
 * Check if current language is Arabic
 * @return bool
 */
function isArabic() {
    return getCurrentLang() === 'ar';
}

/**
 * Get HTML direction attribute
 * @return string 'rtl' for Arabic, 'ltr' for others
 */
function getDir() {
    return isArabic() ? 'rtl' : 'ltr';
}

/**
 * Get HTML lang attribute
 * @return string Language code
 */
function getLangAttr() {
    return getCurrentLang();
}

