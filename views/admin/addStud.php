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
            <div class="title categoryttl">Добавление обучающихся</div>
            <div class="librarian_add">
             <form data-toggle="validator" method='post' id='addStudents'>
               <div class="form-group text-center">
                 <span>В данном разделе вам предоставляется возможность редактирования поступления и убывания обучающихся.
                   Для добавления обучающихся выберите курс, после чего выберите количество поступающих или убывающих обучающихся.
                   В самом конце введите год в котором обучающийся будет учиться.</span>
                 </div>
                 <div class="form-group">
                  <label for="stud_class">Выберите курс студента или введите вручную</label>
                  <input type="number" class='form-control' min='1' max='4' id='stud_class'>
                </div>
                <div class="form-group">
                  <label for="stud_numb">Выберите или введите вручную количество обучающхся</label>
                  <input type="number" class='form-control' min='1' max='100' id='stud_numb'>
                </div>
                <div class="form-group">
                  <label for="addDate">Выберите или введите год</label>
                  <input type="number" class='form-control' value='<?=date('Y')?>' min='2018' id='addDate'>
                </div>
                <div class="form-group text-center">
                  <button type='button' class='btn btn-primary' id='add_stud'>Добавить студентов</button>
                  <button type='button' class='btn btn-primary' id='del_stud'>Удалить студентов</button>
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