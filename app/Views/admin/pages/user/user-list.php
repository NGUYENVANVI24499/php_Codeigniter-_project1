
<!-- Modal add user -->
<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="text-type-user">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title"> Thông tin tài khoản </div>
                </div>
                <div class="card-body ">
                    <form action="#" method="POST" enctype="multipart/form-data" id="add_user_form" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">Email</label>
                                <input value="<?= old('email') ?>" name="email" type="email" class="form-control"
                                    id="inputEmai" placeholder="Email" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tên hiển thị</label>
                            <input value="<?= old('name') ?>" name="name" type="text" class="form-control"
                                id="inputAddress" placeholder="Tên hiển thị người dùng" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Mật khẩu</label>
                                <input value="<?= old('password') ?>" name="password" type="password"
                                    class="form-control" id="password" placeholder="Nhập vào mật khẩu">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm">Xác nhận mật khẩu</label>
                                <input value="<?= old('password_confirm') ?>" name="password_confirm"
                                    type="password" class="form-control" id="password-confirm"
                                    placeholder="Xác nhận lại mật khẩu">
                            </div>
                        </div>
                        <button type="submit" id="btn-add-user" class="btn btn-success">Đăng ký</button>
                        <button type="reset" class="btn btn-secondary">Nhập lại</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<main class="dash-content">
    <div class="container-fluid">
        <h1 class="dash-title">Trang chủ / Tài khoản</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="easion-card-title">Danh sách tài khoản</div>
                        <a class="pl-3" href="javascript::void(0)" id="changeType">dung Ajax</a>
                        <a class="pl-3" href="javascript::void(0)" data-toggle="modal" data-target="#add_user_modal">Add New Post</a>
                    </div>
                    <?= view('messages/message'); ?>
                    <div class="card-body ">
                        <table id="datatable" class="cell-border">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>

                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user):?>
                                <tr>
                                    <td><?=$user['id']?> </td>
                                    <td><?=$user['name']?></td>
                                    <td><?=$user['email']?></td>
                                    
                                    <td class="text-center noneAjax">
                                        <a href="admin/user/edit/<?=$user['id']?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a data-url="<?=base_url()?>admin/user/delete/<?=$user['id']?>" class="btn btn-danger btn-del-confirm"><i
                                                class="far fa-trash-alt"></i></a>
                                    </td>
                                    <td style="display:none" class="text-center useAjax">
                                        <a data-toggle="modal" data-target="#add_user_modal" href="javascript::void(0)" id = "edit-user" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a data-url="<?=base_url()?>admin/user/delete/<?=$user['id']?>" id = "delete-user" class="btn btn-danger btn-del-confirm"><i
                                                class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                               <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
