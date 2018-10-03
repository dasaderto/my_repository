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
                 <?  require_once(asidebar); ?>  
              </div>

              <div class="col-md-6 col-lg-6 col-sm-6 ">
                <div class=" content" style='overflow: hidden;'>
                <div class="title categoryttl">Редактирование отчетных книг</div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-content ">
                      <form action="" method='POST' class='col-md-8' >
                        <div class="row" style='margin-top:1rem;'>
                        <div class="form-group col-md-6">
                          <label for="userload" style='padding:2%;' class="text-center control-label">Выберите предмет</label>
                          <select name="subject" id="subject" class='form-control'  ></select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="userload" style='padding:2%;' class="text-center control-label">Выберите курс</label>
                          <select name="class" id="class" class='form-control'></select>
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="userload" style='padding:2%;' class="text-center control-label">Выберите автора</label>
                          <select name="workbook_author" id="workbook_author" class='form-control'></select>
                        </div>
                        <div class="form-group text-center">
                          <div class=".btn-group-justified user-btn">
                            <button type="button" class="btn btn-primary" id='load-workbook'>Загрузить данные книги</button>
                            <button type="button" class="btn btn-primary" id='edit-workbook' disabled>Редактировать данные</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <h4 class='text-center'><b>Данные книги</b></h4><br>
                   <div class="form-group row">
                      
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
