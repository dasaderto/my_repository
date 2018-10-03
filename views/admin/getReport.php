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

              <div class="col-md-9 col-lg-9 col-sm-9 ">
                <div class="content">
                  <div class="title categoryttl">Отчет об учебниках</div>
                    <?$report=$front->takeReport();?>
                    <div class="MyTbl table-responsive">
                    <table class="table table-bordered" id='myTable'>
                      <thead>
                        <tr>
                          <th scope="col">Класс</th>
                          <th scope="col">Предмет</th>
                          <th scope="col">Автор(-ы)</th>
                          <th scope="col">Количество</th>
                          <th scope="col">Заказать</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($report as $key => $value) {
                            echo "<tr>";
                            echo "<td>".$value['class']."</td>";
                            echo "<td>".$value['subject']."</td>";
                            echo "<td>".$value['author']."</td>";
                            echo "<td>".$value['amount'].'/'.$value['need']."</td>";
                            $needle=$value['amount']-=$value['need'];
                            if ($needle<0) {
                              echo '<td>'.abs($needle).'</td>';
                            }else{echo "<td> </td>";}
                             echo"</tr>";
                          }?>

                      </tbody>
                    </table>
                    </div>
                </div>
              </div>
            </div>
        </div>   
    </main>    
  
    <?require_once(footer);?>
 <?require_once(require_foot);?>

</body>
</html>