<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?  require_once(ahead); ?>  
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
                <div class="content" style='overflow: hidden;'>
                <div class="title categoryttl">Работа с данными пользователей</div>
                <div class="data-work">
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="form-content ">
                      <form action="" method='POST' >
                        <div class="form-group col-sm-8">
                          <label for="userload" style='padding:2%;' class="text-center control-label">Введите логин пользователя, данные которого необходимо отредактировать</label>
                          <input type="text" name='userload' class="form-control" id="userload" placeholder="Введите логин" required>
                          <span class="help-block userloaderror"></span>
                        </div>
                        <div class="form-group text-center">
                          <div class=".btn-group-justified user-btn">
                            <button type="button" class="btn btn-primary" id='load-data'>Загрузить данные пользователя</button>
                            <button type="button" class="btn btn-primary" id='edit-data' disabled>Редактировать данные</button>
                            <button type="button" class="btn btn-primary" id='delete-data' disabled>Удалить пользователя</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-sm-2"></div>
                  </div>
                  <h4 class='text-center'><b>Данные пользователя</b></h4><br>
                   <div class="form-group row">
                <div class="col-md-1 col-sm-1"></div>
                    <div class="col-md-2 col-sm-2">
                      <label for="userid">Код</label>
                      <input class="form-control" id="userid" type="text" placeholder='ID' readonly>
                    </div>
                    <div class="col-md-5 col-sm-5">
                      <label for="username">Логин</label>
                      <input class="form-control" id="username" type="text" placeholder='Логин' disabled>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <label for="userole">Роль</label>
                      <select class="form-control" id="userole" placeholder='Роль' disabled>
                        <option>Студент</option>
                        <option>Учитель</option>
                        <option>Администратор</option>
                      </select>
                      <span class="help-block userolerror" style='white-space:nowrap;'></span>
                    </div>
                  </div>
                  <div class="text-center expander">
                  <span class="expand-users" style='cursor: pointer;'>Развернуть</span> <i class="fa fa-angle-down"></i>
                </div>
                </div>   
                <div class="row user-tbl-data" style="display: none;">
                  <?$users=$front->takeUsers();?>
                  <hr>
                  <div class="MyTbl">
                    <table class="table table-bordered" id='myTable'>
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">login</th>
                          <th scope="col">role</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($users as $key => $value) {
                        switch ($value['role']) 
                        {
                          case 1: $role='Студент';break;
                          case 2: $role='Учитель';break;
                          case 3: $role='Администратор';break;
                        }
                            echo "<tr>";
                             echo "<td>".$value['id']."</td>";
                             echo "<td>".$value['login']."</td>";
                             echo "<td>".$role."</td>";
                            echo"</tr>";
                        }?>

                      </tbody>
                    </table>
                    </div>
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
