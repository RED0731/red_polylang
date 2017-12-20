<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Don't access directly
};

/**
 * The list of predefined languages
 * For WordPress locales, see https://translate.wordpress.org/
 * For W3C locales, see http://www.iana.org/assignments/language-subtag-registry/language-subtag-registry
 * See also #33511
 * Facebook locales used to be available at https://www.facebook.com/translations/FacebookLocales.xml
 *
 * For each language:
 * [code]     => ISO 639-1 language code
 * [locale]   => WordPress locale
 * [name]     => name
 * [dir]      => text direction
 * [flag]     => flag code
 * [w3c]      => W3C locale
 * [facebook] => Facebook locale
 * [show]     => whether to show in the predefined list
 */
$languages = array(
	'af' => array(
		'code'     => 'af',
		'locale'   => 'af',
		'name'     => 'Afrikaans',
		'dir'      => 'ltr',
		'flag'     => 'za',
		'facebook' => 'af_ZA',
		'show'     => true,
	),
	'ak' => array(
		'facebook' => 'ak_GH',
	),
	'am' => array(
		'facebook' => 'am_ET',
	),
	'ar' => array(
		'code'     => 'ar',
		'locale'   => 'ar',
		'name'     => 'العربية',
		'dir'      => 'rtl',
		'flag'     => 'arab',
		'facebook' => 'ar_AR',
		'show'     => true,
	),
	'arq' => array(
		'facebook' => 'ar_AR',
	),
	'ary' => array(
		'code'     => 'ar',
		'locale'   => 'ary',
		'name'     => 'العربية المغربية',
		'dir'      => 'rtl',
		'flag'     => 'ma',
		'facebook' => 'ar_AR',
		'show'     => true,
	),
	'as' => array(
		'code'     => 'as',
		'locale'   => 'as',
		'name'     => 'অসমীয়া',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'as_IN',
		'show'     => true,
	),
	'az' => array(
		'code'     => 'az',
		'locale'   => 'az',
		'name'     => 'Azərbaycan',
		'dir'      => 'ltr',
		'flag'     => 'az',
		'facebook' => 'az_AZ',
		'show'     => true,
	),
	'azb' => array(
		'code'     => 'az',
		'locale'   => 'azb',
		'name'     => 'گؤنئی آذربایجان',
		'dir'      => 'rtl',
		'flag'     => 'az',
		'show'     => true,
	),
	'bel' => array(
		'code'     => 'be',
		'locale'   => 'bel',
		'name'     => 'Беларуская мова',
		'dir'      => 'ltr',
		'flag'     => 'by',
		'w3c'      => 'be',
		'facebook' => 'be_BY',
		'show'     => true,
	),
	'bg_BG' => array(
		'code'     => 'bg',
		'locale'   => 'bg_BG',
		'name'     => 'български',
		'dir'      => 'ltr',
		'flag'     => 'bg',
		'facebook' => 'bg_BG',
		'show'     => true,
	),
	'bn_BD' => array(
		'code'     => 'bn',
		'locale'   => 'bn_BD',
		'name'     => 'বাংলা',
		'dir'      => 'ltr',
		'flag'     => 'bd',
		'facebook' => 'bn_IN',
		'show'     => true,
	),
	'bo' => array(
		'code'     => 'bo',
		'locale'   => 'bo',
		'name'     => 'བོད་ཡིག',
		'dir'      => 'ltr',
		'flag'     => 'tibet',
		'show'     => true,
	),
	'bre' => array(
		'w3c'      => 'br',
		'facebook' => 'br_FR',
	),
	'bs_BA' => array(
		'code'     => 'bs',
		'locale'   => 'bs_BA',
		'name'     => 'Bosanski',
		'dir'      => 'ltr',
		'flag'     => 'ba',
		'facebook' => 'bs_BA',
		'show'     => true,
	),
	'ca' => array(
		'code'     => 'ca',
		'locale'   => 'ca',
		'name'     => 'Català',
		'dir'      => 'ltr',
		'flag'     => 'catalonia',
		'facebook' => 'ca_ES',
		'show'     => true,
	),
	'ceb' => array(
		'code'     => 'ceb',
		'locale'   => 'ceb',
		'name'     => 'Cebuano',
		'dir'      => 'ltr',
		'flag'     => 'ph',
		'facebook' => 'cx_PH',
		'show'     => true,
	),
	'co' => array(
		'facebook' => 'co_FR',
	),
	'cs_CZ' => array(
		'code'     => 'cs',
		'locale'   => 'cs_CZ',
		'name'     => 'Čeština',
		'dir'      => 'ltr',
		'flag'     => 'cz',
		'facebook' => 'cs_CZ',
		'show'     => true,
	),
	'cy' => array(
		'code'     => 'cy',
		'locale'   => 'cy',
		'name'     => 'Cymraeg',
		'dir'      => 'ltr',
		'flag'     => 'wales',
		'facebook' => 'cy_GB',
		'show'     => true,
	),
	'da_DK' => array(
		'code'     => 'da',
		'locale'   => 'da_DK',
		'name'     => 'Dansk',
		'dir'      => 'ltr',
		'flag'     => 'dk',
		'facebook' => 'da_DK',
		'show'     => true,
	),
	'de_CH' => array(
		'code'     => 'de',
		'locale'   => 'de_CH',
		'name'     => 'Deutsch',
		'dir'      => 'ltr',
		'flag'     => 'ch',
		'facebook' => 'de_DE',
		'show'     => true,
	),
	'de_CH_informal' => array(
		'code'     => 'de',
		'locale'   => 'de_CH_informal',
		'name'     => 'Deutsch',
		'dir'      => 'ltr',
		'flag'     => 'ch',
		'w3c'      => 'de-CH',
		'facebook' => 'de_DE',
		'show'     => true,
	),
	'de_DE' => array(
		'code'     => 'de',
		'locale'   => 'de_DE',
		'name'     => 'Deutsch',
		'dir'      => 'ltr',
		'flag'     => 'de',
		'facebook' => 'de_DE',
		'show'     => true,
	),
	'de_DE_formal' => array(
		'code'     => 'de',
		'locale'   => 'de_DE_formal',
		'name'     => 'Deutsch',
		'dir'      => 'ltr',
		'flag'     => 'de',
		'w3c'      => 'de-DE',
		'facebook' => 'de_DE',
		'show'     => true,
	),
	'dzo' => array(
		'code'     => 'dz',
		'locale'   => 'dzo',
		'name'     => 'རྫོང་ཁ',
		'dir'      => 'ltr',
		'flag'     => 'bt',
		'w3c'      => 'dz',
		'show'     => true,
	),
	'el' => array(
		'code'     => 'el',
		'locale'   => 'el',
		'name'     => 'Ελληνικά',
		'dir'      => 'ltr',
		'flag'     => 'gr',
		'facebook' => 'el_GR',
		'show'     => true,
	),
	'en_AU' => array(
		'code'     => 'en',
		'locale'   => 'en_AU',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'au',
		'facebook' => 'en_US',
		'show'     => true,
	),
	'en_CA' => array(
		'code'     => 'en',
		'locale'   => 'en_CA',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'ca',
		'facebook' => 'en_US',
		'show'     => true,
	),
	'en_GB' => array(
		'code'     => 'en',
		'locale'   => 'en_GB',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'gb',
		'facebook' => 'en_GB',
		'show'     => true,
	),
	'en_NZ' => array(
		'code'     => 'en',
		'locale'   => 'en_NZ',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'nz',
		'facebook' => 'en_US',
		'show'     => true,
	),
	'en_US' => array(
		'code'     => 'en',
		'locale'   => 'en_US',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'us',
		'facebook' => 'en_US',
		'show'     => true,
	),
	'en_ZA' => array(
		'code'     => 'en',
		'locale'   => 'en_ZA',
		'name'     => 'English',
		'dir'      => 'ltr',
		'flag'     => 'za',
		'facebook' => 'en_US',
		'show'     => true,
	),
	'eo' => array(
		'code'     => 'eo',
		'locale'   => 'eo',
		'name'     => 'Esperanto',
		'dir'      => 'ltr',
		'flag'     => 'esperanto',
		'facebook' => 'eo_EO',
		'show'     => true,
	),
	'es_AR' => array(
		'code'     => 'es',
		'locale'   => 'es_AR',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'ar',
		'show'     => true,
		'facebook' => 'es_LA',
	),
	'es_CL' => array(
		'code'     => 'es',
		'locale'   => 'es_CL',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'cl',
		'facebook' => 'es_CL',
		'show'     => true,
	),
	'es_CO' => array(
		'code'     => 'es',
		'locale'   => 'es_CO',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'co',
		'facebook' => 'es_CO',
		'show'     => true,
	),
	'es_ES' => array(
		'code'     => 'es',
		'locale'   => 'es_ES',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'es',
		'facebook' => 'es_ES',
		'show'     => true,
	),
	'es_GT' => array(
		'code'     => 'es',
		'locale'   => 'es_GT',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'gt',
		'facebook' => 'es_LA',
		'show'     => true,
	),
	'es_MX' => array(
		'code'     => 'es',
		'locale'   => 'es_MX',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'mx',
		'facebook' => 'es_MX',
		'show'     => true,
	),
	'es_PE' => array(
		'code'     => 'es',
		'locale'   => 'es_PE',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 'pe',
		'facebook' => 'es_LA',
		'show'     => true,
	),
	'es_VE' => array(
		'code'     => 'es',
		'locale'   => 'es_VE',
		'name'     => 'Español',
		'dir'      => 'ltr',
		'flag'     => 've',
		'facebook' => 'es_VE',
		'show'     => true,
	),
	'et' => array(
		'code'     => 'et',
		'locale'   => 'et',
		'name'     => 'Eesti',
		'dir'      => 'ltr',
		'flag'     => 'ee',
		'facebook' => 'et_EE',
		'show'     => true,
	),
	'eu' => array(
		'code'     => 'eu',
		'locale'   => 'eu',
		'name'     => 'Euskara',
		'dir'      => 'ltr',
		'flag'     => 'basque',
		'facebook' => 'eu_ES',
		'show'     => true,
	),
	'fa_AF' => array(
		'code'     => 'fa',
		'locale'   => 'fa_AF',
		'name'     => 'فارسی',
		'dir'      => 'rtl',
		'flag'     => 'af',
		'show'     => true,
	),
	'fa_IR' => array(
		'code'     => 'fa',
		'locale'   => 'fa_IR',
		'name'     => 'فارسی',
		'dir'      => 'rtl',
		'flag'     => 'ir',
		'facebook' => 'fa_IR',
		'show'     => true,
	),
	'fi' => array(
		'code'     => 'fi',
		'locale'   => 'fi',
		'name'     => 'Suomi',
		'dir'      => 'ltr',
		'flag'     => 'fi',
		'facebook' => 'fi_FI',
		'show'     => true,
	),
	'fo' => array(
		'code'     => 'fo',
		'locale'   => 'fo',
		'name'     => 'Føroyskt',
		'dir'      => 'ltr',
		'flag'     => 'fo',
		'facebook' => 'fo_FO',
		'show'     => true,
	),
	'fr_BE' => array(
		'code'     => 'fr',
		'locale'   => 'fr_BE',
		'name'     => 'Français',
		'dir'      => 'ltr',
		'flag'     => 'be',
		'show'     => true,
	),
	'fr_CA' => array(
		'code'     => 'fr',
		'locale'   => 'fr_CA',
		'name'     => 'Français',
		'dir'      => 'ltr',
		'flag'     => 'quebec',
		'facebook' => 'fr_CA',
		'show'     => true,
	),
	'fr_FR' => array(
		'code'     => 'fr',
		'locale'   => 'fr_FR',
		'name'     => 'Français',
		'dir'      => 'ltr',
		'flag'     => 'fr',
		'facebook' => 'fr_FR',
		'show'     => true,
	),
	'fuc' => array(
		'facebook' => 'ff_NG',
	),
	'fy' => array(
		'code'     => 'fy',
		'locale'   => 'fy',
		'name'     => 'Frysk',
		'dir'      => 'ltr',
		'flag'     => 'nl',
		'facebook' => 'fy_NL',
		'show'     => true,
	),
	'ga' => array(
		'facebook' => 'ga_IE',
	),
	'gd' => array(
		'code'     => 'gd',
		'locale'   => 'gd',
		'name'     => 'Gàidhlig',
		'dir'      => 'ltr',
		'flag'     => 'scotland',
		'show'     => true,
	),
	'gl_ES' => array(
		'code'     => 'gl',
		'locale'   => 'gl_ES',
		'name'     => 'Galego',
		'dir'      => 'ltr',
		'flag'     => 'galicia',
		'facebook' => 'gl_ES',
		'show'     => true,
	),
	'gn' => array(
		'facebook' => 'gn_PY',
	),
	'gu' => array(
		'code'     => 'gu',
		'locale'   => 'gu',
		'name'     => 'ગુજરાતી',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'gu_IN',
		'show'     => true,
	),
	'haz' => array(
		'code'     => 'haz',
		'locale'   => 'haz',
		'name'     => 'هزاره گی',
		'dir'      => 'rtl',
		'flag'     => 'af',
		'show'     => true,
	),
	'he_IL' => array(
		'code'     => 'he',
		'locale'   => 'he_IL',
		'name'     => 'עברית',
		'dir'      => 'rtl',
		'flag'     => 'il',
		'facebook' => 'he_IL',
		'show'     => true,
	),
	'hi_IN' => array(
		'code'     => 'hi',
		'locale'   => 'hi_IN',
		'name'     => 'हिन्दी',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'hi_IN',
		'show'     => true,
	),
	'hr' => array(
		'code'     => 'hr',
		'locale'   => 'hr',
		'name'     => 'Hrvatski',
		'dir'      => 'ltr',
		'flag'     => 'hr',
		'facebook' => 'hr_HR',
		'show'     => true,
	),
	'hu_HU' => array(
		'code'     => 'hu',
		'locale'   => 'hu_HU',
		'name'     => 'Magyar',
		'dir'      => 'ltr',
		'flag'     => 'hu',
		'facebook' => 'hu_HU',
		'show'     => true,
	),
	'hy' => array(
		'code'     => 'hy',
		'locale'   => 'hy',
		'name'     => 'Հայերեն',
		'dir'      => 'ltr',
		'flag'     => 'am',
		'facebook' => 'hy_AM',
		'show'     => true,
	),
	'id_ID' => array(
		'code'     => 'id',
		'locale'   => 'id_ID',
		'name'     => 'Bahasa Indonesia',
		'dir'      => 'ltr',
		'flag'     => 'id',
		'facebook' => 'id_ID',
		'show'     => true,
	),
	'ido' => array(
		'w3c'      => 'io',
	),
	'is_IS' => array(
		'code'     => 'is',
		'locale'   => 'is_IS',
		'name'     => 'Íslenska',
		'dir'      => 'ltr',
		'flag'     => 'is',
		'facebook' => 'is_IS',
		'show'     => true,
	),
	'it_IT' => array(
		'code'     => 'it',
		'locale'   => 'it_IT',
		'name'     => 'Italiano',
		'dir'      => 'ltr',
		'flag'     => 'it',
		'facebook' => 'it_IT',
		'show'     => true,
	),
	'ja' => array(
		'code'     => 'ja',
		'locale'   => 'ja',
		'name'     => '日本語',
		'dir'      => 'ltr',
		'flag'     => 'jp',
		'facebook' => 'ja_JP',
		'show'     => true,
	),
	'jv_ID' => array(
		'code'     => 'jv',
		'locale'   => 'jv_ID',
		'name'     => 'Basa Jawa',
		'dir'      => 'ltr',
		'flag'     => 'id',
		'facebook' => 'jv_ID',
		'show'     => true,
	),
	'ka_GE' => array(
		'code'     => 'ka',
		'locale'   => 'ka_GE',
		'name'     => 'ქართული',
		'dir'      => 'ltr',
		'flag'     => 'ge',
		'facebook' => 'ka_GE',
		'show'     => true,
	),
	'kab' => array(
		'code'     => 'kab',
		'locale'   => 'kab',
		'name'     => 'Taqbaylit',
		'dir'      => 'ltr',
		'flag'     => 'dz',
		'show'     => true,
	),
	'kin' => array(
		'w3c'      => 'rw',
		'facebook' => 'rw_RW',
	),
	'kk' => array(
		'code'     => 'kk',
		'locale'   => 'kk',
		'name'     => 'Қазақ тілі',
		'dir'      => 'ltr',
		'flag'     => 'kz',
		'facebook' => 'kk_KZ',
		'show'     => true,
	),
	'km' => array(
		'code'     => 'km',
		'locale'   => 'km',
		'name'     => 'ភាសាខ្មែរ',
		'dir'      => 'ltr',
		'flag'     => 'kh',
		'facebook' => 'km_KH',
		'show'     => true,
	),
	'kn' => array(
		'facebook' => 'kn_IN',
	),
	'ko_KR' => array(
		'code'     => 'ko',
		'locale'   => 'ko_KR',
		'name'     => '한국어',
		'dir'      => 'ltr',
		'flag'     => 'kr',
		'facebook' => 'ko_KR',
		'show'     => true,
	),
	'ckb' => array(
		'code'     => 'ku',
		'locale'   => 'ckb',
		'name'     => 'کوردی',
		'dir'      => 'rtl',
		'flag'     => 'kurdistan',
		'facebook' => 'cb_IQ',
		'show'     => true,
	),
	'ku' => array(
		'facebook' => 'ku_TR',
	),
	'ky_KY' => array(
		'facebook' => 'ky_KG',
	),
	'la' => array(
		'facebook' => 'la_VA',
	),
	'li' => array(
		'facebook' => 'li_NL',
	),
	'lin' => array(
		'facebook' => 'ln_CD',
	),
	'lo' => array(
		'code'     => 'lo',
		'locale'   => 'lo',
		'name'     => 'ພາສາລາວ',
		'dir'      => 'ltr',
		'flag'     => 'la',
		'facebook' => 'lo_LA',
		'show'     => true,
	),
	'lt_LT' => array(
		'code'     => 'lt',
		'locale'   => 'lt_LT',
		'name'     => 'Lietuviškai',
		'dir'      => 'ltr',
		'flag'     => 'lt',
		'facebook' => 'lt_LT',
		'show'     => true,
	),
	'lv' => array(
		'code'     => 'lv',
		'locale'   => 'lv',
		'name'     => 'Latviešu valoda',
		'dir'      => 'ltr',
		'flag'     => 'lv',
		'facebook' => 'lv_LV',
		'show'     => true,
	),
	'mk_MK' => array(
		'code'     => 'mk',
		'locale'   => 'mk_MK',
		'name'     => 'македонски јазик',
		'dir'      => 'ltr',
		'flag'     => 'mk',
		'show'     => true,
	),
	'mg_MG' => array(
		'facebook' => 'mg_MG',
	),
	'mk_MK' => array(
		'facebook' => 'mk_MK',
	),
	'ml_IN' => array(
		'code'     => 'ml',
		'locale'   => 'ml_IN',
		'name'     => 'മലയാളം',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'ml_IN',
		'show'     => true,
	),
	'mn' => array(
		'code'     => 'mn',
		'locale'   => 'mn',
		'name'     => 'Монгол хэл',
		'dir'      => 'ltr',
		'flag'     => 'mn',
		'facebook' => 'mn_MN',
		'show'     => true,
	),
	'mr' => array(
		'code'     => 'mr',
		'locale'   => 'mr',
		'name'     => 'मराठी',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'mr_IN',
		'show'     => true,
	),
	'mri' => array(
		'w3c'      => 'mi',
		'facebook' => 'mi_NZ',
	),
	'ms_MY' => array(
		'code'     => 'ms',
		'locale'   => 'ms_MY',
		'name'     => 'Bahasa Melayu',
		'dir'      => 'ltr',
		'flag'     => 'my',
		'facebook' => 'ms_MY',
		'show'     => true,
	),
	'my_MM' => array(
		'code'     => 'my',
		'locale'   => 'my_MM',
		'name'     => 'ဗမာစာ',
		'dir'      => 'ltr',
		'flag'     => 'mm',
		'facebook' => 'my_MM',
		'show'     => true,
	),
	'nb_NO' => array(
		'code'     => 'nb',
		'locale'   => 'nb_NO',
		'name'     => 'Norsk Bokmål',
		'dir'      => 'ltr',
		'flag'     => 'no',
		'facebook' => 'nb_NO',
		'show'     => true,
	),
	'ne_NP' => array(
		'code'     => 'ne',
		'locale'   => 'ne_NP',
		'name'     => 'नेपाली',
		'dir'      => 'ltr',
		'flag'     => 'np',
		'facebook' => 'ne_NP',
		'show'     => true,
	),
	'nl_BE' => array(
		'code'     => 'nl',
		'locale'   => 'nl_BE',
		'name'     => 'Nederlands',
		'dir'      => 'ltr',
		'flag'     => 'be',
		'facebook' => 'nl_BE',
		'show'     => true,
	),
	'nl_NL' => array(
		'code'     => 'nl',
		'locale'   => 'nl_NL',
		'name'     => 'Nederlands',
		'dir'      => 'ltr',
		'flag'     => 'nl',
		'facebook' => 'nl_NL',
		'show'     => true,
	),
	'nl_NL_formal' => array(
		'code'     => 'nl',
		'locale'   => 'nl_NL_formal',
		'name'     => 'Nederlands',
		'dir'      => 'ltr',
		'flag'     => 'nl',
		'w3c'      => 'nl-NL',
		'facebook' => 'nl_NL',
		'show'     => true,
	),
	'nn_NO' => array(
		'code'     => 'nn',
		'locale'   => 'nn_NO',
		'name'     => 'Norsk Nynorsk',
		'dir'      => 'ltr',
		'flag'     => 'no',
		'facebook' => 'nn_NO',
		'show'     => true,
	),
	'oci' => array(
		'code'     => 'oc',
		'locale'   => 'oci',
		'name'     => 'Occitan',
		'dir'      => 'ltr',
		'flag'     => 'occitania',
		'w3c'      => 'oc',
		'show'     => true,
	),
	'ory' => array(
		'facebook' => 'or_IN',
	),
	'pa_IN' => array(
		'code'     => 'pa',
		'locale'   => 'pa_IN',
		'name'     => 'ਪੰਜਾਬੀ',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'pa_IN',
		'show'     => true,
	),
	'pl_PL' => array(
		'code'     => 'pl',
		'locale'   => 'pl_PL',
		'name'     => 'Polski',
		'dir'      => 'ltr',
		'flag'     => 'pl',
		'facebook' => 'pl_PL',
		'show'     => true,
	),
	'ps' => array(
		'code'     => 'ps',
		'locale'   => 'ps',
		'name'     => 'پښتو',
		'dir'      => 'rtl',
		'flag'     => 'af',
		'facebook' => 'ps_AF',
		'show'     => true,
	),
	'pt_BR' => array(
		'code'     => 'pt',
		'locale'   => 'pt_BR',
		'name'     => 'Português',
		'dir'      => 'ltr',
		'flag'     => 'br',
		'facebook' => 'pt_BR',
		'show'     => true,
	),
	'pt_PT' => array(
		'code'     => 'pt',
		'locale'   => 'pt_PT',
		'name'     => 'Português',
		'dir'      => 'ltr',
		'flag'     => 'pt',
		'facebook' => 'pt_PT',
		'show'     => true,
	),
	'rhg' => array(
		'code'     => 'rhg',
		'locale'   => 'rhg',
		'name'     => 'Ruáinga',
		'dir'      => 'ltr',
		'flag'     => 'mm',
		'show'     => true,
	),
	'ro_RO' => array(
		'code'     => 'ro',
		'locale'   => 'ro_RO',
		'name'     => 'Română',
		'dir'      => 'ltr',
		'flag'     => 'ro',
		'facebook' => 'ro_RO',
		'show'     => true,
	),
	'roh' => array(
		'w3c'      => 'rm',
		'facebook' => 'rm_CH',
	),
	'ru_RU' => array(
		'code'     => 'ru',
		'locale'   => 'ru_RU',
		'name'     => 'Русский',
		'dir'      => 'ltr',
		'flag'     => 'ru',
		'facebook' => 'ru_RU',
		'show'     => true,
	),
	'sa_IN' => array(
		'facebook' => 'sa_IN',
	),
	'sah' => array(
		'code'     => 'sah',
		'locale'   => 'sah',
		'name'     => 'Сахалыы',
		'dir'      => 'ltr',
		'flag'     => 'ru',
		'show'     => true,
	),
	'si_LK' => array(
		'code'     => 'si',
		'locale'   => 'si_LK',
		'name'     => 'සිංහල',
		'dir'      => 'ltr',
		'flag'     => 'lk',
		'facebook' => 'si_LK',
		'show'     => true,
	),
	'sk_SK' => array(
		'code'     => 'sk',
		'locale'   => 'sk_SK',
		'name'     => 'Slovenčina',
		'dir'      => 'ltr',
		'flag'     => 'sk',
		'facebook' => 'sk_SK',
		'show'     => true,
	),
	'sl_SI' => array(
		'code'     => 'sl',
		'locale'   => 'sl_SI',
		'name'     => 'Slovenščina',
		'dir'      => 'ltr',
		'flag'     => 'si',
		'facebook' => 'sl_SI',
		'show'     => true,
	),
	'so_SO' => array(
		'code'     => 'so',
		'locale'   => 'so_SO',
		'name'     => 'Af-Soomaali',
		'dir'      => 'ltr',
		'flag'     => 'so',
		'facebook' => 'so_SO',
		'show'     => true,
	),
	'sq' => array(
		'code'     => 'sq',
		'locale'   => 'sq',
		'name'     => 'Shqip',
		'dir'      => 'ltr',
		'flag'     => 'al',
		'facebook' => 'sq_AL',
		'show'     => true,
	),
	'sr_RS' => array(
		'code'     => 'sr',
		'locale'   => 'sr_RS',
		'name'     => 'Српски језик',
		'dir'      => 'ltr',
		'flag'     => 'rs',
		'facebook' => 'sr_RS',
		'show'     => true,
	),
	'srd' => array(
		'w3c'      => 'sc',
		'facebook' => 'sc_IT',
	),
	'su_ID' => array(
		'code'     => 'su',
		'locale'   => 'su_ID',
		'name'     => 'Basa Sunda',
		'dir'      => 'ltr',
		'flag'     => 'id',
		'show'     => true,
	),
	'sv_SE' => array(
		'code'     => 'sv',
		'locale'   => 'sv_SE',
		'name'     => 'Svenska',
		'dir'      => 'ltr',
		'flag'     => 'se',
		'facebook' => 'sv_SE',
		'show'     => true,
	),
	'sw' => array(
		'facebook' => 'sw_KE',
	),
	'szl' => array(
		'code'     => 'szl',
		'locale'   => 'szl',
		'name'     => 'Ślōnskŏ gŏdka',
		'dir'      => 'ltr',
		'flag'     => 'pl',
		'facebook' => 'sz_PL',
		'show'     => true,
	),
	'ta_IN' => array(
		'code'     => 'ta',
		'locale'   => 'ta_IN',
		'name'     => 'தமிழ்',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'ta_IN',
		'show'     => true,
	),
	'ta_LK' => array(
		'code'     => 'ta',
		'locale'   => 'ta_LK',
		'name'     => 'தமிழ்',
		'dir'      => 'ltr',
		'flag'     => 'lk',
		'facebook' => 'ta_IN',
		'show'     => true,
	),
	'tah' => array(
		'code'     => 'ty',
		'locale'   => 'tah',
		'name'     => 'Reo Tahiti',
		'dir'      => 'ltr',
		'flag'     => 'pf',
		'show'     => true,
	),
	'te' => array(
		'code'     => 'te',
		'locale'   => 'te',
		'name'     => 'తెలుగు',
		'dir'      => 'ltr',
		'flag'     => 'in',
		'facebook' => 'te_IN',
		'show'     => true,
	),
	'tg' => array(
		'facebook' => 'tg_TJ',
	),
	'th' => array(
		'code'     => 'th',
		'locale'   => 'th',
		'name'     => 'ไทย',
		'dir'      => 'ltr',
		'flag'     => 'th',
		'facebook' => 'th_TH',
		'show'     => true,
	),
	'tl' => array(
		'code'     => 'tl',
		'locale'   => 'tl',
		'name'     => 'Tagalog',
		'dir'      => 'ltr',
		'flag'     => 'ph',
		'facebook' => 'tl_PH',
		'show'     => true,
	),
	'tr_TR' => array(
		'code'     => 'tr',
		'locale'   => 'tr_TR',
		'name'     => 'Türkçe',
		'dir'      => 'ltr',
		'flag'     => 'tr',
		'facebook' => 'tr_TR',
		'show'     => true,
	),
	'tt_RU' => array(
		'code'     => 'tt',
		'locale'   => 'tt_RU',
		'name'     => 'Татар теле',
		'dir'      => 'ltr',
		'flag'     => 'ru',
		'facebook' => 'tt_RU',
		'show'     => true,
	),
	'tuk' => array(
		'w3c'      => 'tk',
		'facebook' => 'tk_TM',
	),
	'tzm' => array(
		'facebook' => 'tz_MA',
	),
	'ug_CN' => array(
		'code'     => 'ug',
		'locale'   => 'ug_CN',
		'name'     => 'Uyƣurqə',
		'dir'      => 'ltr',
		'flag'     => 'cn',
		'show'     => true,
	),
	'uk' => array(
		'code'     => 'uk',
		'locale'   => 'uk',
		'name'     => 'Українська',
		'dir'      => 'ltr',
		'flag'     => 'ua',
		'facebook' => 'uk_UA',
		'show'     => true,
	),
	'ur' => array(
		'code'     => 'ur',
		'locale'   => 'ur',
		'name'     => 'اردو',
		'dir'      => 'rtl',
		'flag'     => 'pk',
		'facebook' => 'ur_PK',
		'show'     => true,
	),
	'uz_UZ' => array(
		'code'     => 'uz',
		'locale'   => 'uz_UZ',
		'name'     => 'Oʻzbek',
		'dir'      => 'ltr',
		'flag'     => 'uz',
		'facebook' => 'uz_UZ',
		'show'     => true,
	),
	'vec' => array(
		'code'     => 'vec',
		'locale'   => 'vec',
		'name'     => 'Vèneto',
		'dir'      => 'ltr',
		'flag'     => 'veneto',
		'show'     => true,
	),
	'vi' => array(
		'code'     => 'vi',
		'locale'   => 'vi',
		'name'     => 'Tiếng Việt',
		'dir'      => 'ltr',
		'flag'     => 'vn',
		'facebook' => 'vi_VN',
		'show'     => true,
	),
	'yor' => array(
		'facebook' => 'yo_NG',
	),
	'zh_CN' => array(
		'code'     => 'zh',
		'locale'   => 'zh_CN',
		'name'     => '中文 (中国)',
		'dir'      => 'ltr',
		'flag'     => 'cn',
		'facebook' => 'zh_CN',
		'show'     => true,
	),
	'zh_HK' => array(
		'code'     => 'zh',
		'locale'   => 'zh_HK',
		'name'     => '中文 (香港)',
		'dir'      => 'ltr',
		'flag'     => 'hk',
		'facebook' => 'zh_HK',
		'show'     => true,
	),
	'zh_TW' => array(
		'code'     => 'zh',
		'locale'   => 'zh_TW',
		'name'     => '中文 (台灣)',
		'dir'      => 'ltr',
		'flag'     => 'tw',
		'facebook' => 'zh_TW',
		'show'     => true,
	),
);
