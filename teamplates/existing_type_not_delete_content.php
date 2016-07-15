<?
// Разноцветные строки в таблице

$line_color[] = 'success';
$line_color[] = 'info';
$line_color[] = 'warning';
$line_color[] = 'danger';
?>


<!-- Объекты недвижимости по типу, который хотят удалить -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Выборка всех записей</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
	
	<link href="dist/css/css_my.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Урок №2 MVC.</a>
            </div>
            <!-- /.navbar-header -->


            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"> Выборка всех объектов недвижимости</a>
                        </li>
                        <li>
                            <a href="index.php?redirect=add_line"> Добавление объекта недвижимости</a>
                        </li>
                        <li>
                            <a href="index.php?redirect=all_types&controller=controller_realty_type"> Редактирование типа</a>
                        </li>
                        <li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Удаление типа объектов недвижимости</h1>

                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                Тип объектов недвижимости "
                                <?= $all_lines_of_type[0]['type']?>", нельзя удалить!!! Тип используется в следующих объявлениях:
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Тип</th>
                                                <th>Недвижимость</th>
                                                <th>Адрес</th>
                                                <th>Цена</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
										$i = 0;
										foreach($all_lines_of_type as $key => $massiv)
										{											
									?>
                                                <tr class="<?=$line_color[$i]?>">
                                                    <td>
                                                        <?= $all_lines_of_type[$key]['type']?>
                                                    </td>
                                                    <td>
                                                        <?= $all_lines_of_type[$key]['title']?>
                                                    </td>
                                                    <td>
                                                        <?= $all_lines_of_type[$key]['address']?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($all_lines_of_type[$key]['price'],0,' ',' ')?>
                                                    </td>
                                                </tr>
                                                <?php
										$i++;
										if($i == 3) $i = 0;	
										}	
									?>
                                        </tbody>
                                    </table>
                                    <a href="http://php-2.loc/less-MVC-1/main_type.php" class="btn btn-info"> Перейти к редактированию типов</a>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>