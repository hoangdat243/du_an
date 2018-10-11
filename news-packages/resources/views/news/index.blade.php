<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

 <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">


   

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Trang tin tức!</span></a>
            </div>

            <div class="clearfix"></div>

         

            <br />

          <!--menu -->
          @include('menu')
          <!--end menu -->
          </div>
        </div>

        

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Danh sách danh mục</h3>
              </div>

              <div class="title_right">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right ">
                
              </div>

            </div> 
            <div style="" class="col-md-12">
            <div class="x_panel">
              <h4>Tìm kiếm</h4>
            <form method="get" action="/search/news" id="demo-form" data-parsley-validate class="form-horizontal form-label-left  col-md-12" enctype="multipart/form-data">
                        
                      <div class="form-group col-md-3 col-sm-6 col-xs-12">
                        <label class="control-label">Tiêu đề tin </label>
                        <div class="">  
                          <input type="text"  name="name" class="form-control col-md-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group col-md-3 col-sm-6 col-xs-12">
                        <label class="control-label">Danh muc </label>
                        <div class="">  
                            <select class="form-control" name="category" >
                                <option value="" >Choose option</option>
                                @foreach($category as $v)
                                <option value="{{ $v->id }}" >{{$v->name}}</option>         
                                @endforeach                
                            </select>
                        </div>
                      </div>

                      <div class="form-group col-md-3 col-sm-6 col-xs-12">  
                        <label class="control-label" >Trạng thái</label>
                        <div class="">
                            <select class="form-control" name="status" >
                                <option value="" > Choose option </option>
                                <option value="0" >Draft</option>
                                <option value="1" >Publish</option>                          
                            </select>
                        </div>
                      </div>
                      <div class="form-group col-md-3 col-sm-6 col-xs-12">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       
                          <button type="submit" class="btn btn-success" style="margin-top:20px"">Tìm kiếm</button>
                        </div>
                      </div>

                    </form>
                </div>
            </div>
            

                <!--table -->
                <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="/news/create" class="btn btn-primary">Thêm mới danh mục</a>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>STT</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Tag  </th>
                          <th>Chuyên mục </th>
                          <th>Mô tả ngắn</th>
                          <th>Image</th>
                          <th>Công cụ</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach ($data as $key => $v)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $v->name }}</td>
                          <td>{{ $v->slug }}</td>
                          <td><ol>@foreach($v->tag as $a)<li> {{$a->name}}</li> @endforeach </ol></td>
                          <td>{{ $v->category->name }}</td>
                          <td>{{ $v->short_description }}</td>
                          <td> <img src="{{ $v->image }}" width="150"></td>
                          <td >
                        
                              <a  style="float: left;" href="/news/{{$v->id}}/edit" class="btn btn-success">Sửa</a>
                            
                            <form method="post" action="{{ route('news.destroy', $v->id) }}" style="float: left;">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger" onclick="return window.confirm('Bạn có chắc chắn muốn xóa')">Xóa</button>
                            </form>
                          </td>
                        @endforeach
                        </tr>
                         
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>

            
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



   

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
     <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
  
  </body>
</html>
