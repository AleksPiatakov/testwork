<?php
/*
  $Id: language.php,v 1.1.1.1 2003/09/18 19:03:49 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  browser language detection logic Copyright phpMyAdmin (select_lang.lib.php3 v1.24 04/19/2002)
                                   Copyright Stephane Garin <sgarin@sgarin.com> (detect_language.php v0.1 04/02/2002)
*/

class language {
    var $languages, $catalog_languages, $browser_languages, $language;

    function __construct($lng = '') {
        $this->languages = array(
            'ar' => 'ar([-_][[:alpha:]]{2})?|arabic',
            'bg' => 'bg|bulgarian',
            'br' => 'pt[-_]br|brazilian portuguese',
            'ca' => 'ca|catalan',
            'cs' => 'cs|czech',
            'da' => 'da|danish',
            'de' => 'de([-_][[:alpha:]]{2})?|german',
            'el' => 'el|greek',
            'en' => 'en([-_][[:alpha:]]{2})?|english',
            'es' => 'es([-_][[:alpha:]]{2})?|spanish',
            'et' => 'et|estonian',
            'fi' => 'fi|finnish',
            'fr' => 'fr([-_][[:alpha:]]{2})?|french',
            'gl' => 'gl|galician',
            'he' => 'he|hebrew',
            'hu' => 'hu|hungarian',
            'id' => 'id|indonesian',
            'it' => 'it|italian',
            'ja' => 'ja|japanese',
            'ko' => 'ko|korean',
            'ka' => 'ka|georgian',
            'lt' => 'lt|lithuanian',
            'lv' => 'lv|latvian',
            'nl' => 'nl([-_][[:alpha:]]{2})?|dutch',
            'no' => 'no|norwegian',
            'pl' => 'pl|polish',
            'pt' => 'pt([-_][[:alpha:]]{2})?|portuguese',
            'ro' => 'ro|romanian',
            'ru' => 'ru|russian',
            'sk' => 'sk|slovak',
            'sr' => 'sr|serbian',
            'sv' => 'sv|swedish',
            'th' => 'th|thai',
            'tr' => 'tr|turkish',
            'uk' => 'uk|ukrainian',
            'tw' => 'zh[-_]tw|chinese traditional',
            'zh' => 'zh|chinese simplified'
        );

        $this->catalog_languages = array();
        $languages_query = tep_db_query("SELECT `languages_id`, `name`, `code`, `image`, `directory` FROM " . TABLE_LANGUAGES . " WHERE `lang_status`='1' ORDER BY `sort_order`");
        while ($languages = tep_db_fetch_array($languages_query)) {
            $this->catalog_languages[$languages['code']] = array(
                'id' => $languages['languages_id'],
                'name' => $languages['name'],
                'code' => $languages['code'],
                'image' => $languages['image'],
                'directory' => $languages['directory']
            );
        }

        $this->browser_languages = '';
        $this->language = '';

        $this->set_language($lng);
    }

    static public function getLangsByKey($key = 'languages_id') {
        $result = [];
        $languages_query = tep_db_query("SELECT `languages_id`, `name`, `code`, `image`, `directory` FROM " . TABLE_LANGUAGES . " ORDER BY `sort_order`");
        while ($languages = tep_db_fetch_array($languages_query)) {
            $result[$languages[$key]] = array(
                'id' => $languages['languages_id'],
                'name' => $languages['name'],
                'code' => $languages['code'],
                'image' => $languages['image'],
                'directory' => $languages['directory']
            );
        }
        return $result;
    }


    function set_language($language) {
        if ((tep_not_null($language)) && (isset($this->catalog_languages[$language]))) {
            $this->language = $this->catalog_languages[$language];
        } else {
            $this->language = $this->catalog_languages[getConstantValue("DEFAULT_LANGUAGE")];
        }

        if (empty($this->language)) {
            $this->setAnyLanguage();
        }
    }

    function get_browser_language() {
        // a_berezin Opera default language fix start
        $this->language = $this->catalog_languages[getConstantValue("DEFAULT_LANGUAGE")];
        // a_berezin Opera default language fix end
        $this->browser_languages = explode(',', getenv('HTTP_ACCEPT_LANGUAGE'));

        for ($i = 0, $n = sizeof($this->browser_languages); $i<$n; $i++) {
            reset($this->languages);
            foreach ($this->languages as $key => $value) {
            // while (list($key, $value) = each($this->languages)) {
                if (preg_match('/^(' . $value . ')(;q=[0-9]\\.[0-9])?$/i', $this->browser_languages[$i]) && isset($this->catalog_languages[$key])) {
                    $this->language = $this->catalog_languages[$key];
                    break 2;
                }
            }
        }

        if (empty($this->language)) {
            $this->setAnyLanguage();
        }
    }

    private function setAnyLanguage() {
        $this->language = current($this->catalog_languages);
    }
}
