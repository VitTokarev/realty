


<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Редактировать пользователя</h1>
        <form action="" method="post">
            <input type="hidden" name="action" value="edit"/>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" placeholder="Имя пользователя" class="form-control" name="username" value = "<?=$user_edit->username?>">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" placeholder="Пароль" class="form-control" name="password">
            </div>
			<label>Роль пользователя: "<?=User::$roles[$user_edit->role]?>"</label>
			<div class="form-group input-group my-input-group">
                <select class="form-control" name="role">
                    <?php
                        foreach(User::$roles as $key => $role)
                        {
                            ?>
                            <option value="<?= $key ?>"><?= $role ?></option>
                            <?php
                        }
                    ?>

                </select>
            </div>


            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>Изменить</button>
        </form>

    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
