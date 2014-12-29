<?php

add_filter('body_class', 'geoip_add_body_classes');
function geoip_add_body_classes($classes) {
	if (!get_option('geoip-detect-set_css_country'))
		return $classes;
	
	$info = geoip_detect2_get_info_from_current_ip();

	if ($info->country->isoCode)
		$classes[] = 'geoip-country-' . $info->country->isoCode;
	
	if ($info->continent->code)
		$classes[] = 'geoip-continent-' . $info->continent->code;

	return $classes;
}


add_filter('geoip_detect2_locales', 'geoip_detect2_add_default_locales');
function geoip_detect2_add_default_locales($locales) {
	if (is_null($locales)) {
		$locales = array();
		
		if (defined('ICL_LANGUAGE_CODE'))
			$locales[] = ICL_LANGUAGE_CODE;
		
		$site_locale = get_locale();
		if ($site_locale) {
			$translate = array(
				'pt_BR' => 'pt-BR',
				'zh_CN' => 'zh-CN',
			);
			if (isset($translate[$site_locale]))
				$site_locale = $translate[$site_locale];
			else
				$site_locale = substr($site_locale, 0, 2);
			
			$locales[] = $site_locale;
		}
		$locales[] = 'en';
	}
	return $locales;
}