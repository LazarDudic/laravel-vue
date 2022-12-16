<?php

namespace Database\Seeders;

use App\Libraries\StaticHelpPageContent;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langSR = Language::where('lang_code', 'sr')->first();
        $langEN = Language::where('lang_code', 'en')->first();

        $langGroupID = '1';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'home',
            'route' => '/',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Digital Flos Template',
                "menuTitle" => 'Početna',
                "metaTitle" => 'Digital Flos Template',
                "metaDesc" => '',
                "content" => '',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'home',
            'route' => '/',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Digital Flos Template',
                "menuTitle" => 'Home',
                "metaTitle" => 'Digital Flos Template',
                "metaDesc" => '',
                "content" => '',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        $langGroupID = '2';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'login',
            'route' => '/prijava',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Prijavi se',
                "menuTitle" => 'Prijavi se',
                "metaTitle" => 'Prijavi se',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Unesite Email i lozinku</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'login',
            'route' => '/login',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Login',
                "menuTitle" => 'Login',
                "metaTitle" => 'Login',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Please insert your Email and password</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        $langGroupID = '3';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'register',
            'route' => '/registracija',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Registracija',
                "menuTitle" => 'Registracija',
                "metaTitle" => 'Registracija',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Popunite formu za registraciju</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'register',
            'route' => '/register',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Register',
                "menuTitle" => 'Register',
                "metaTitle" => 'Register',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Please fill in registration form</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        $langGroupID = '4';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'contact',
            'route' => '/kontakt',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Kontakt',
                "menuTitle" => 'Kontakt',
                "metaTitle" => 'Kontakt',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Stupite u kontakt sa nama!</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'contact',
            'route' => '/contact',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Contact',
                "menuTitle" => 'Contact',
                "metaTitle" => 'Contact',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Get in touch</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        $langGroupID = '5';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'forgot-password',
            'route' => '/zaboravili-ste-lozinku',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Promena šifre',
                "menuTitle" => 'Zaboravili ste lozinku',
                "metaTitle" => 'Promena šifre',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Zaboravili ste lozinku? Nema problema. Samo unesite svoju adresu e-pošte i poslaćemo vam e-poštom vezu za resetovanje lozinke koja će Vam omogućiti da odaberete novu.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'forgot-password',
            'route' => '/forgot-password',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Forgot a password',
                "menuTitle" => 'Forgot a password',
                "metaTitle" => 'Forgot a password',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Forgot a password? Not a problem. Please enter your email address and we will send email tou you with link where you can set your new password.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);

        $langGroupID = '6';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'reset-password',
            'route' => '/resetujte-lozinku',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Resetovanje šifre',
                "menuTitle" => 'Resetovanje šifre',
                "metaTitle" => 'Resetovanje šifre',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Upišite novu lozinku. Potvrdite novu lozinku. Kliknite na dugme Potvrdi i nova lozinka ce biti setovana.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'reset-password',
            'route' => '/reset-password',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Forgot a password',
                "menuTitle" => 'Forgot a password',
                "metaTitle" => 'Forgot a password',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Enter new passowrd. Confirm new password. Click on button Confirm and you will set your new password.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        $langGroupID = '7';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'verify-email',
            'route' => '/verifikacija-email',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Verifikacija email-a',
                "menuTitle" => 'Verifikacija email-a',
                "metaTitle" => 'Verifikacija email-a',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Hvala što ste se prijavili! Pre nego što počnete, možete li da verifikujete svoju adresu e-pošte klikom na link u emailu koji je upravo poslat? Ako niste primili e-poštu, rado ćemo Vam poslati drugu.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'verify-email',
            'route' => '/verify-email',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'no',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Email verification',
                "menuTitle" => 'Email verification',
                "metaTitle" => 'Email verification',
                "metaDesc" => '',
                "content" => '<p style="text-align: center; " class=""><font color="#000000"><span style="font-size: 1.125rem;">Thank you for Sing up! Please verify your Email address by clicking on the link we sent you in the email. If you do not receive the Email with the link in next few minutes please resend it.</span></font></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);



        $langGroupID = '8';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'terms',
            'route' => '/uslovi-koriscenja',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Uslovi Korišćenja',
                "menuTitle" => 'Uslovi Korišćenja',
                "metaTitle" => 'Uslovi Korišćenja',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'terms',
            'route' => '/terms',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Terms',
                "menuTitle" => 'Terms',
                "metaTitle" => 'Terms',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);



        $langGroupID = '9';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'privacy',
            'route' => '/politika-privatnosti',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Uslovi Korišćenja',
                "menuTitle" => 'Uslovi Korišćenja',
                "metaTitle" => 'Uslovi Korišćenja',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'privacy',
            'route' => '/privacy-policy',
            'can_delete' => 'no',
            'main_menu_show' => 'no',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'Privacy Policy',
                "menuTitle" => 'Privacy Policy',
                "metaTitle" => 'Privacy Policy',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);

        $langGroupID = '10';
        DB::table('pages')->insert([
            'lang_id' => $langSR->id,
            'lang_group_id' => $langGroupID,
            'name' => 'aboutus',
            'route' => '/o-nama',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'O nama',
                "menuTitle" => 'O nama',
                "metaTitle" => 'O nama',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
        DB::table('pages')->insert([
            'lang_id' => $langEN->id,
            'lang_group_id' => $langGroupID,
            'name' => 'aboutus',
            'route' => '/about-us',
            'can_delete' => 'no',
            'main_menu_show' => 'yes',
            'footer_menu_show' => 'yes',
            'json_rules' => json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE),
            'json_values' => json_encode((object)[
                "title" => 'About us',
                "menuTitle" => 'About us',
                "metaTitle" => 'About us',
                "metaDesc" => '',
                "content" => '<h3 style="text-align: center; "><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="font-size: 16px;">﻿</span><span style="color: inherit; font-family: inherit;">Lorem Ipsum</span><br></h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><h3 style="text-align: center; ">Lorem Ipsum</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p>',
                "socialImageID" => null,
            ], JSON_UNESCAPED_UNICODE),
        ]);
    }
}
