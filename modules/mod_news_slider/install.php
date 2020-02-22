<?php
/* ****************************************************************************************** */
/* created by soft-solution.ru                                                                */
/* install.php of module mod_news_slider InstantCMS 1.10                                      */
/* ****************************************************************************************** */

    function info_module_mod_news_slider(){

        //Заголовок (на сайте)
        $_module['title']        = 'Слайдер новостей';

        //Название (в админке)
        $_module['name']         = 'Слайдер новостей';

        //описание
        $_module['description']  = 'Модуль Слайдер новостей';

        //ссылка (идентификатор)
        $_module['link']         = 'mod_news_slider';

        //позиция
        $_module['position']     = 'top';

        //автор
        $_module['author']       = 'soft-solution.ru';

        //текущая версия
        $_module['version']      = '1.0';

        //
        // Настройки по-умолчанию
        //
        $_module['config'] = array();

        $_module['config']['showlastnews'] = 1;
        $_module['config']['showimage'] = 0;
        $_module['config']['showdate'] = 1;
	$_module['config']['subs'] = 1;
	$_module['config']['cat_id'] = 1;
	$_module['config']['newscount'] = 5;
        $_module['config']['maxlen']= 150;
        
        $_module['config']['autoSlide']= 1;
        $_module['config']['SlideInterval']= 5000; 
        $_module['config']['nav']= 'top';
        $_module['config']['autoHeight'] = 1;
        $_module['config']['effect'] = 'default';
        $_module['config']['arrow'] = 0;
        
        return $_module;

    }

// ========================================================================== //

    function install_module_mod_news_slider(){

        return true;

    }

// ========================================================================== //

    function upgrade_module_mod_news_slider(){

        return true;

    }

// ========================================================================== //

?>