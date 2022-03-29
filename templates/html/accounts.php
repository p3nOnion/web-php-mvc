<?php
/** @var TYPE_NAME $accounts */
//json_encode($accounts);

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    require("bootstrap.php");
    ?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="content-wrapper" style="min-height: 1203.6px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="accounts.php">List</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">STT
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">ID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Username
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Firstname
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Lastname
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Permission
                                        </th>
                                        <th style="text-align: center;" class="sorting" tabindex="0"
                                            aria-controls="example2" rowspan="1" colspan="1"
                                            aria-label="Platform(s): activate to sort column ascending">Edit
                                        </th>
                                        <th style="text-align: center;" class="sorting" tabindex="0"
                                            aria-controls="example2" rowspan="1" colspan="1"
                                            aria-label="Engine version: activate to sort column ascending">Delete
                                        </th>

                                    </tr>
                                    </thead>
                                    <?php $i = 1;
                                    foreach ($accounts as $account):
                                        if ($account[7] != 1) {
                                            ?>
                                            <tr id="row<?php echo $i; ?>">
                                                <th rowspan="1" colspan="1"><?php echo $i ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[0] ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[1] ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[3] ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[4] ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[5] ?></th>
                                                <th rowspan="1" colspan="1"><?php echo $account[7];
                                                    $i++; ?></th>
                                                <th style="text-align: center;">
                                                <span class="badge bg-primary" class="edit">
                                                          <a style="color: #1f1a32" href="#"
                                                             data-href="accounts.php?edit=" data-toggle="modale"
                                                             data-target="#confirm-delete">Edit<ion-icon
                                                                      name="create-outline"></ion-icon></a>
                                                        </span>

                                                </th>
                                                <th style="text-align: center;" class="delete">
                                                <span class="badge bg-danger">
                                                            <a style="color: #1f1a32" href=""
                                                               data-href="accounts.php?delete=" data-toggle="modal"
                                                               data-target="#confirm-delete">Delete<ion-icon
                                                                        name="trash-outline"></ion-icon></a>
                                                        </span>
                                                </th>
                                            </tr>

                                        <?php }endforeach; ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="   ModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Account???
            </div>
            <div class="modal-body">
                Agree to delete an account
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    // $("tr").on("click", "th", function () {
    //     var value = $(this).parent().text().split("\n");
    //     $('#confirm-delete').on('show.bs.modal', function (e) {
    //         var id = ('#row' + parseInt(value[1])).toString();
    //         $(id).remove();
    //         $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href') + parseInt(value[2]));
    //         // $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href') + parseInt(value[2]));
    //     });
    // });
    // $("tr").on("click", "th", function () {
    //     var value = $(this).parent().text().split("\n");
    //     console.log($(this).text);
    //     modal.style.display = "block";
    // });

</script>

</body>
</html>