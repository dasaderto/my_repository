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
              <div class="col-md-3 col-lg-3 col-sm-3 bar">
                <?  require_once(asidebar); ?> 
              </div>

              <div class="col-md-6 col-lg-6 col-sm-6 ">
                <div class="content">
                <div class="title categoryttl">Добавление учебников</div>
                <div class="librarian_add">
                 <form data-toggle="validator" method='post'>
                   <div class="form-group text-center">
                     <span>В данном разделе вам предоставляется возможность добавления книг для последующего составления отчета.
                      Заполните все необходимые поля.
                    </div>
                    <div class="form-group">
                      <label for="subject">Введите предмет</label>
                      <input type="text" class='form-control' id='subject' minlength='3'>
                    </div>
                    <div class="form-group">
                      <label for="author">Введите автора(-ов) учебника</label>
                      <input type="text" class='form-control' id='author' minlength='5'>
                    </div>
                    <div class="form-group">
                      <label for="amount">Введите количество учебников</label>
                      <input type="number" class='form-control' id='amount'>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="publishing">Введите издательство</label>
                          <input type="text" class='form-control' id='publishing'>
                        </div>
                        <div class="col-md-6">
                         <label for="work_class">Для какого курса?</label>
                         <input type="number" class='form-control' id='work_class' min='1' max='11'>                          
                        </div>
                      </div>
                   </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="year_add">Введите год поступления</label>
                          <input type="number" class='form-control' id='year_add' min='2010' max='2050'>
                        </div>
                        <div class="col-md-6">
                         <label for="shelf_life">"Срок годности" учебника (лет)</label>
                         <input type="number" class='form-control' id='shelf_life' min='1' max='20'>
                       </div>
                     </div>
                   </div>
                   <div class="form-group">

                   </div>
                   <div class="form-group text-center">
                    <button type='button' class='btn btn-primary' id='add_work'>Добавить учебники</button>
                  </div>
                </form>
                </div>
              </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-3 share">
                 <?require_once(rightbar);?>
              </div>
      </div>
        </div>   
    </main>    
   
    <?require_once(footer);?>
 <?require_once(require_foot);?>
</body>
</html>