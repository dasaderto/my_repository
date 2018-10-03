<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php"); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?  require_once(head); ?> 
   </head>
   <body>
      <?  require_once(header); ?> 
      <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <? require_once(sidebar); ?>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 ">
                  <div class="content">
                     <?if (method_exists('ContentModel','detailsBook')) {
                        $detail=$showAll->detailsBook();
                        if (!empty($detail)){
                          foreach ($detail as $key => $value) {?>
                     <div class="title categoryttl"><?=$value['name']?></div>
                     <div class="somebook">
                        <div class='newbook container-fluid'>
                           <div class="row">
                           <div class="col-sm-4" style="overflow: hidden;">
                              <?if (empty($value['img'])) $value['img']='DefaultBook.jpg'?>
                              <img alt="<?echo $value['name'];?>" height="256" src="<?=img?>/Books/<?echo $value['img'];?>" width="180">
                           </div>
                           <div class="col-sm-8">
                              <h3><i class='fa fa-book'></i><b>Название: <?echo $value['name'];?></b><br></h3>
                              <span class='author-title'><i class='fa fa-bookmark'></i><b>Жанр:</b> 
                                 <a href="<?=pathcategory;?>?cat=<?=urlencode($value['category'])?>&page=1"><?=($value['category'])?></a></span>
                                 <span class='author-title'><i class='fa fa-user'></i><b>Автор:</b> 
                                    <a href='<?=pathcategory?>?authors=<?=urlencode($value['author']);?>&page=1'><?=$value['author'];?></a>
                                 </span>
                                 <span class='author-title'><i class='fa fa-calendar'></i><b>Добавлено:</b> <?=$value['date'];?>
                              </span>
                              <span><?=$value['about']?></span>
                              <ul id="reader">
                                 <li>
                                    <?$val=explode(".", $value['file']);
                                    if (end($val)=='pdf'){
                                     $href=files.$value['file'];
                                     $dhref=$href;
                                    }else{
                                     $href='https://view.officeapps.live.com/op/view.aspx?src=http%3A%2F%2Fspklibrary.akhost.ru%2Ffiles%2F'.$value['file'];
                                     $dhref=files.$value['file'];
                                  }
                                  ?>
                                  <i class='fa fa-header'></i><a href="<?echo $href;?>" class='watchhref'>Читать онлайн</a>
                               </li>
                               <li style='display:flex'><i class='fa fa-download'></i>Скачать: 
                                <a href="<? echo $dhref; ?>" class='watchhref' download><?= end($val).' ';?></a>
                                <?=sprintf("%.2f", $value['filesize']/1024/1024);?>Мб
                              </li>
                           </ul>
                           </div>
                        </div>
                     </div>
                     </div>
                     <?}
                        }else{echo "По данному произведению ничего нет!";}
                        }else{echo 'Ничего не найдено!';} ?>   
                  </div>
               </div>
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <? require_once(rightbar); ?>
               </div>
            </div>
         </div>
      </main>
      <?require_once(footer);?>
      <?require_once(require_foot);?>
   </body>
</html>