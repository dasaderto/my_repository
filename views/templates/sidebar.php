<aside class="hidden-sm hidden-xs">
  <div class="sidebar">
     <div class="title">
        Категории книг
     </div>
     <div class="sidecont">
        <?if (method_exists('ContentModel','ShowMenu')) {?>
        <ul class="nav nav-pills nav-stacked left-menu" id="accordion">
           <?$category_maps=$showAll->ShowMenu();
              foreach ($category_maps as $key => $value) {?>
           <li>
              <a data-toggle="collapse" data-parent="#accordion" href="#<?= $front->transletter($key)?>">
              <?echo $key?></a>
              <ul id="<?= $front->transletter($key)?>" class="nav nav-stacked collapse left-submenu">
                <?foreach ($value as $class){?>
                 <li>
                   <a href="<?=pathcategory?>?cat=<?=urlencode($key)?>&class=<?=urlencode($class);?>&page=1"><?=urldecode($class);?></a>
                 </li>
                <?}?>
              </ul>
           </li>
           <?}?>     
        </ul>
        <?}else{echo "<span><b>Ивините, в данный момент тут пусто. Обратитесь к системному администратору.</b></span>";}?>
     </div>
  </div>
</aside>

