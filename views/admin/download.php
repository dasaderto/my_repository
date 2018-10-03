<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");?>
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
               <div class="col-md-3 col-lg-3 col-sm-3 bar">
                  <? require_once(sidebar); ?>
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 ">
                  <div class="content">
                     <div class="title categoryttl">Загрузка Книг</div>
                     <div class="registration">
                        <form data-toggle="validator" role="form" method='post' enctype='multipart/form-data' id='uploadForm'>
                           <div class="form-group">
                              <label for="bookname" class="control-label">Введите название загружаемого файла</label>
                              <input type="text" name='bookname' id='bookname' class="form-control" placeholder="Введите название" required>
                           </div>
                           <div class="form-group">
                              <label for="fileauthor" class="control-label">Введите автора (Пушкин А.С.)</label>
                              <input list="fileauthor" name='fileauthor' class="form-control" placeholder="Введите автора" required autocomplete=off">
                              <datalist id='fileauthor'>
                                 <?$author_list=$showAll->ShowAuthors();?>
                                 <?foreach ($author_list as $key => $value) {?>
                                 <option value="<?=$value['author']?>"></option>
                                 <?}?>
                              </datalist>
                           </div>
                           <div class="form-group">
                              <label for="category">Выберите категорию или добавьте свою.(Не допустите ошибку при вводе, будет создана новая категория)</label>
                              <input name="downloadcat" list='downloadcat' class="form-control" placeholder='Введите категорию'>
                              <datalist id='downloadcat' name="downloadcat">
                                 <? $downcat=R::getAll("SELECT * FROM category");
                                    foreach ($downcat as $key => $value) {?>
                                 <option value='<?echo $value['category'];?>'></option>
                                 <?}?>
                              </datalist>
                           </div>
                           <div class="form-group">
                              <label for="rank">Для кого предназначена?</label>
                              <select name="rank" class="form-control">
                                 <option>10 класс</option>
                                 <option>11 класс</option>
                                 <option>1 курс</option>
                                 <option>2 курс</option>
                                 <option>3 курс</option>
                                 <option>4 курс</option>
                                 <option>Прочее</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="level">Выберите уровень доступа</label>
                              <select name="level" class="form-control">
                                 <option>Доступна всем</option>
                                 <option>Доступна только зарегистрированным пользователям</option>
                              </select>
                           </div>
                           <div class="form-group">
                             <div class="row">
                               <div class="col-md-6">
                                 <label for="fileimage">Выберите изображение</label>
                                 <input type="file" name='fileimage' class='form-control-file fileimage' accept=".jpeg,.png,.jpg">
                               </div>
                               <div class="col-md-6">
                                 <label for="filename">Выберите файл</label>
                                 <input type="file" name='filename' id='filename' class='form-control-file filename' accept=".pdf,.docx,.doc">
                               </div>
                             </div>
                           </div>
                           <div class="form-group">
                              <label for="comment">Небольшое описание:</label>
                              <textarea class="form-control" rows="3" name='about' id="comment"></textarea>
                           </div>
                           <div class="form-group text-center">
                              <b><span id='userhelp'></span></b>
                           </div>
                           <div class="form-group text-center">
                              <button type="submit" name="download" class="btn btn-primary" id="downbtn"><i class="fa fa-upload"></i> Загрузить</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-3 col-sm-3 share">
                  <? require_once(rightbar); ?>
               </div>
            </div>
         </div>
      </main>
      <? require_once(footer);?>
      <? require_once(require_foot);?>
   </body>
</html>
