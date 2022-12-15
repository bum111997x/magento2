<?php

namespace Cowell\Region\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Locale implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $arrayLocales = [
            'af_ZA', /*Afrikaans (South Africa)*/
            'ar_DZ', /*Arabic (Algeria)*/
            'ar_EG', /*Arabic (Egypt)*/
            'ar_KW', /*Arabic (Kuwait)*/
            'ar_MA', /*Arabic (Morocco)*/
            'ar_SA', /*Arabic (Saudi Arabia)*/
            'az_Latn_AZ', /*Azerbaijani (Azerbaijan)*/
            'be_BY', /*Belarusian (Belarus)*/
            'bg_BG', /*Bulgarian (Bulgaria)*/
            'bn_BD', /*Bengali (Bangladesh)*/
            'bs_Latn_BA', /*Bosnian (Bosnia)*/
            'ca_ES', /*Catalan (Catalonia)*/
            'cs_CZ', /*Czech (Czech Republic)*/
            'cy_GB', /*Welsh (United Kingdom)*/
            'da_DK', /*Danish (Denmark)*/
            'de_AT', /*German (Austria)*/
            'de_CH', /*German (Switzerland)*/
            'de_DE', /*German (Germany)*/
            'de_LU', /*German (Luxembourg)*/
            'el_GR', /*Greek (Greece)*/
            'en_AU', /*English (Australian)*/
            'en_CA', /*English (Canadian)*/
            'en_GB', /*English (United Kingdom)*/
            'en_NZ', /*English (New Zealand)*/
            'en_US', /*English (United States)*/
            'es_AR', /*Spanish (Argentina)*/
            'es_CO', /*Spanish (Colombia)*/
            'es_PA', /*Spanish (Panama)*/
            'gl_ES', /*Galician (Galician)*/
            'es_CR', /*Spanish (Costa Rica)*/
            'es_ES', /*Spanish (Spain)*/
            'es_MX', /*Spanish (Mexico)*/
            'eu_ES', /*Basque (Basque)*/
            'es_PE', /*Spanish (Peru)*/
            'et_EE', /*Estonian (Estonia)*/
            'fa_IR', /*Persian (Iran)*/
            'fi_FI', /*Finnish (Finland)*/
            'fil_PH', /*Filipino (Philippines)*/
            'fr_BE', /*French (Belgium)*/
            'fr_CA', /*French (Canada)*/
            'fr_CH', /*French (Switzerland)*/
            'fr_FR', /*French (France)*/
            'fr_LU', /*French (Luxembourg)*/
            'gu_IN', /*Gujarati (India)*/
            'he_IL', /*Hebrew (Israel)*/
            'hi_IN', /*Hindi (India)*/
            'hr_HR', /*Croatian (Croatia)*/
            'hu_HU', /*Hungarian (Hungary)*/
            'id_ID', /*Indonesian (Indonesia)*/
            'is_IS', /*Icelandic (Iceland)*/
            'it_CH', /*Italian (Switzerland)*/
            'it_IT', /*Italian (Italy)*/
            'ja_JP', /*Japanese (Japan)*/
            'ka_GE', /*Georgian (Georgia)*/
            'km_KH', /*Khmer (Cambodia)*/
            'ko_KR', /*Korean (South Korea)*/
            'lo_LA', /*Lao (Laos)*/
            'lt_LT', /*Lithuanian (Lithuania)*/
            'lv_LV', /*Latvian (Latvia)*/
            'mk_MK', /*Macedonian (Macedonia)*/
            'mn_Cyrl_MN', /*Mongolian (Mongolia)*/
            'ms_MY', /*Malaysian (Malaysia)*/
            'ms_Latn_MY', /*Malaysian (Malaysia)*/
            'nl_BE', /*Dutch (Belgium)*/
            'nl_NL', /*Dutch (Netherlands)*/
            'nb_NO', /*Norwegian Bokmål (Norway)*/
            'nn_NO', /*Norwegian Nynorsk (Norway)*/
            'pl_PL', /*Polish (Poland)*/
            'pt_BR', /*Portuguese (Brazil)*/
            'pt_PT', /*Portuguese (Portugal)*/
            'ro_RO', /*Romanian (Romania)*/
            'ru_RU', /*Russian (Russia)*/
            'sk_SK', /*Slovak (Slovakia)*/
            'sl_SI', /*Slovenian (Slovenia)*/
            'sq_AL', /*Albanian (Albania)*/
            'sr_Cyrl_RS', /*Serbian (Cyrillic, Serbia)*/
            'sr_Latn_RS', /*Serbian (Latin, Serbia)*/
            'sv_SE', /*Swedish (Sweden)*/
            'sv_FI', /*Swedish (Finland)*/
            'sw_KE', /*Swahili (Kenya)*/
            'th_TH', /*Thai (Thailand)*/
            'tr_TR', /*Turkish (Turkey)*/
            'uk_UA', /*Ukrainian (Ukraine)*/
            'vi_VN', /*Vietnamese (Vietnam)*/
            'zh_Hans_CN', /*Chinese (China)*/
            'zh_Hant_HK', /*Chinese (Hong Kong SAR)*/
            'zh_Hant_TW', /*Chinese (Taiwan)*/
            'es_CL', /*Spanich (Chile)*/
            'lo_LA', /*Laotian*/
            'es_VE', /*Spanish (Venezuela)*/
            'en_IE', /*English (Ireland)*/
            'es_BO', /*Spanish (Bolivia)*/
            'es_US', /*Spanish (United States)*/
        ];
        $allLocales = array();
        foreach ($arrayLocales as $arrayLocale){
            $allLocales [] = ['label' => $arrayLocale, 'value' => $arrayLocale];
        }

        return $allLocales;
    }
}
