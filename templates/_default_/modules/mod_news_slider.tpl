<link rel="stylesheet" href="/modules/mod_news_slider/css/coda-slider-2.0.css" type="text/css" media="screen" />
<script type="text/javascript" src="/modules/mod_news_slider/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/modules/mod_news_slider/js/jquery.coda-slider-2.0.js"></script>

<div id="mod_news_slider">
    {* Заголовок модуля *}
    <div class="news_events">Новости и события</div>
    {* Фиксированная последняя новость *}
    {if $cfg.showlastnews}
    <div class="lastnewsblock">
        <div class="titleblock"><a href="{$lastnews.url}">{$lastnews.title}</a></div>
        {if $lastnews.image && $cfg.showimage}
            <div class="mod_news_slider_image">
                <img src="/images/photos/small/{$lastnews.image}" border="0" width="50" height="50" alt="{$lastnews.title|escape:'html'}"/>
            </div>
        {/if}
        
        <div class="mod_news_slider_desc" style="overflow:hidden">
            {$lastnews.description|strip_tags|truncate:200}
        </div>
            
        {if $cfg.showdate}
            <div class="pubdate">
                {$lastnews.fpubdate}
            </div>
        {/if}
        
    </div>
    {/if}
    
    {* граница между блоками*}
    <div class="borderblock">&nbsp;</div>
    
    {* Слайдер новостей *}
    <div class="sliderblock">
        {* slider *}
        <div class="coda-slider-wrapper">
            {if $cfg.arrow}
            <div id="coda-nav-left-1" class="coda-nav-left"><a href="#" title="Назад">&#171;</a></div>
            <div id="coda-nav-right-1" class="coda-nav-right"><a href="#" title="Вперед">&#187;</a></div>
            {/if}
            <div class="coda-slider preload" id="coda-slider{$mid}">
            {foreach key=aid item=article from=$articles}
                <div class="panel">
                    <div class="panel-wrapper">
                        <div class="tab-nav"></div>
                            <div class="titleblock"><a href="{$article.url}">{$article.title}</a></div>
                            {if $article.image && $cfg.showimage}
                                <div class="mod_news_slider_image">
                                    <img src="/images/photos/small/{$article.image}" border="0" width="50" height="50" alt="{$article.title|escape:'html'}"/>
                                </div>
                            {/if}

                            <div class="mod_news_slider_desc" style="overflow:hidden">
                                {$article.description|strip_tags|truncate:200}
                            </div>

                        {if $cfg.showdate}
                            <div class="pubdate">
                                {$article.fpubdate}
                            </div>
                        {/if}
                    </div>
                </div>
            {/foreach}
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
{literal}
    <style>
        #mod_news_slider{background-color:#0060ff;display:block; color:#fff;padding:10px;}
        #mod_news_slider .news_events{font-weight:bold;font-size:18px;color:#fff;}
        
        #mod_news_slider .lastnewsblock{float:left;width:330px;padding: 10px 0 0 20px;}
        #mod_news_slider .titleblock {margin:0 0 5px 0;}
        #mod_news_slider .titleblock a {font-size:14px;color:#fff;text-decoration:underline;}
        #mod_news_slider .titleblock a:hover {text-decoration:none;}
        #mod_news_slider .mod_news_slider_image{}
        #mod_news_slider .mod_news_slider_desc{}
        #mod_news_slider .pubdate{font-size:12px;color:#99ccff;padding:4px 0 0 0;}
        
        #mod_news_slider .borderblock{float:left;width:30px;height:200px;}
        
        #mod_news_slider .sliderblock{float:left;width:330px;}
        #mod_news_slider .slide_entry{}
       
    </style>
 {/literal}
 
{literal}
<script type="text/javascript">
$().ready(function() {
    $('#coda-slider{/literal}{$mid}{literal}').codaSlider({
        {/literal}
        {if $cfg.autoSlide}
        autoSlide: true,
        autoSlideInterval: {$cfg.SlideInterval},
        {/if}
        {if $cfg.effect!='default'}
        slideEaseFunction: '{$cfg.effect}',
        {/if}
        {if !$cfg.autoHeight || $cfg.autoHeight==0}
        autoHeight: false,
        {/if}
        {if $cfg.nav=='hide'}
        dynamicTabs: false,
        {else}
        dynamicTabsPosition: '{$cfg.nav}',
        {/if}
        {literal}
        autoSlideStopWhenClicked: true,
        dynamicArrows: false,
        {/literal}
        panelTitleSelector: 'div.tab-nav'
        {literal}
    });
});
</script>
{/literal}