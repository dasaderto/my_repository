<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <?  require_once(head); ?>
   </head>
   <body>
      <? require_once(slider);?>
      <? require_once(header);?>
      <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <?  require_once(sidebar); ?>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 ">
                  <div class="content">
                     <div class="title categoryttl" id='title'>Популярные книги в библиотеке</div>
                     <div class="somebook">
                        <?if (method_exists('ContentModel','BookOnIndex')){
                           $top10=$showAll->BookOnIndex("books");
                           foreach ($top10 as $key => $value) { ?>
                        <div class='newbook'>
                           <?if (empty($value['img'])) $value['img']='DefaultBook.jpg'?>
                           <img alt="<?echo $value['name'];?>" height="104" src="<?=img?>/Books/<?echo $value['img'];?>" width="65">
                           <h3><i class='fa fa-book'></i>
                              <?$name=$front->transletter($value['name'])?>
                              <a href="<?=pathdetails?>?book=<?=urlencode($value['name'])?>&bookauthor=<?=urlencode($value['author']) ?>">
                              <?echo $value['name'];?>
                              </a>
                           </h3>
                           <span class='author-title'>
                           <i class='fa fa-user'></i>
                           <b>Автор:</b>
                           <a href='<?=pathcategory?>?authors=<?=urlencode($value['author']);?>'><?=$value['author'];?></a>
                           </span>
                           <span class='author-title'>
                           <i class='fa fa-calendar'></i>
                           <b>Добавлено:</b> <?=$value['date'];?>
                           </span>
                           <span><?=$value['about']?></span><br>
                           <span><font color='#6f6f6f'><i class="fa fa-eye"></i>Просмотрено <?= $value['viewed']?> раз</font></span>
                        </div>
                        <?}}else{echo 'Тут пока ничего нет!';}?>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <?  require_once(rightbar); ?>
               </div>
            </div>
         </div>
      </main>
      <?require_once(footer);?>
      <?require_once(require_foot);?>
   </body>
</html>
