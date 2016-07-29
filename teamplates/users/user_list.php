


<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Пользователи</h1>

        <?php

        // вывод данных тут
        if (count($users)>0)
        {
            ?>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Список
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Имя пользователя</th>
                                <th>Роль</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($users as $user)
                            {
                                ?>

                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= User::$roles[$user->role] ?></td>
                                    <td>                                        
                                        <a class="btn btn-success" href="index.php?redirect=users_edit&controller=controller_users&id=<?= $user->id ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="index.php?redirect=users_del&controller=controller_users&id=<?= $user->id ?>"><i class="fa fa-times-circle"></i></a>
										
										
										
                                    </td>
                                </tr>


                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
				</div>
            <a href="index.php?redirect=users_add&controller=controller_users" class="btn btn-success"><i class="fa fa-plus-circle"></i> Добавить</a>
            <?php
        }
        else
        {
            ?>
            <h2>Пока нет ни одной записи. Вы можете <a href="index.php?redirect=users_add&controller=controller_users">добавить</a> первую</h2>
            <?php
        }


        ?>

    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
