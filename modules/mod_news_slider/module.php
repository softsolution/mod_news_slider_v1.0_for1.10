<?php
/* ****************************************************************************************** */
/* created by soft-solution.ru                                                                */
/* module.php of module mod_news_slider InstantCMS 1.10                                       */
/* ****************************************************************************************** */

function mod_news_slider($module_id){

	$inCore = cmsCore::getInstance();
	$inDB   = cmsDatabase::getInstance();

	$inCore->loadModel('content');
	$model = new cms_model_content();

	$cfg = $inCore->loadModuleConfig($module_id);
        
        if (!isset($cfg['showlastnews'])) { $cfg['showlastnews'] = 1; }
        if (!isset($cfg['showimage'])) { $cfg['showimage'] = 0; }
        if (!isset($cfg['showdate'])) { $cfg['showdate'] = 1; }
	if (!isset($cfg['subs'])) { $cfg['subs'] = 1; }
	if (!isset($cfg['cat_id'])) { $cfg['cat_id'] = 1; }
	if (!isset($cfg['newscount'])) { $cfg['newscount'] = 5; }
        if (!isset($cfg['maxlen'])) { $cfg['maxlen']= 150; }
        
        if (!isset($cfg['autoSlide'])) { $cfg['autoSlide']= 1; }
        if (!isset($cfg['SlideInterval'])) { $cfg['SlideInterval']= 5000; }
        if (!isset($cfg['nav'])) { $cfg['nav']= 'top'; }
        if (!isset($cfg['autoHeight'])) { $cfg['autoHeight'] = 1;}
        if (!isset($cfg['effect'])) { $cfg['effect'] = 'default';}
        if (!isset($cfg['arrow'])) { $cfg['arrow'] = 0;}
        
        //увеличиваем счетчик новостей
        if($cfg['showlastnews']){
            $cfg['newscount']++;
        }

	if($cfg['cat_id']){
            if (!$cfg['subs']){
                //выбираем из категории
                $model->whereCatIs($cfg['cat_id']);
            } else {
                //выбираем из категории и подкатегорий
                $rootcat = $inDB->getNsCategory('cms_category', $cfg['cat_id']);
                if(!$rootcat) { return false; }
                $model->whereThisAndNestedCats($rootcat['NSLeft'], $rootcat['NSRight']);
            }
	}

	$inDB->where("con.showlatest = 1");

	$inDB->orderBy('con.pubdate', 'DESC');
	$inDB->limitPage(1, $cfg['newscount']);

	$content_list = $model->getArticlesList();
        if(!$content_list) { return false; }
        
        if($cfg['maxlen']){
            //дополнительная обработка массива
            foreach($content_list as $article){
                if (mb_strlen($article['description'])>$cfg['maxlen']) {
                    $article['description'] = mb_substr($article['description'], 0, $cfg['maxlen']). '...'; 
                }
            }
        }

        //извлекаем последнюю новость из массива
        if($cfg['showlastnews']){
            //ini $lastnews
            $lastnews = array_shift($content_list);
        }


        $smarty = $inCore->initSmarty('modules', 'mod_news_slider.tpl');
	$smarty->assign('articles', $content_list);
        $smarty->assign('lastnews', $lastnews);
	$smarty->assign('mid', $module_id);
	$smarty->assign('cfg', $cfg);
	$smarty->display('mod_news_slider.tpl');			

	return true;

}
?>