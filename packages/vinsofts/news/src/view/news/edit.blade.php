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
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">


    <link href="../../select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../../select2/dist/js/select2.min.js"></script>

    <script src="../../ckeditor/ckeditor.js"></script>
    
    <style type="text/css">
      #preview img{
        width: 200px;
        height:120px;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span>Trang tin tức!</span></a>
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
                <h3> Sửa tin tức</h3>
              </div>

              
            </div> 
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
                <div class="x_panel">
                  <div class="x_title">
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  
                    <br />
                    <form method="post" action="{{ route('news.update', $data->id) }}" id="demo-form" data-parsley-validate class="form-horizontal form-label-left col-md-offset-2 col-md-8" enctype="multipart/form-data">
                    @method('put')    
                    @csrf
                      <div class="form-group">
                        <label class="control-label">Tên tin tức <span class="required">*</span>
                        </label>
                        <div class="">  
                          <input type="text"  name="txtName" class="form-control col-md-7 col-xs-12" value="{{$data->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Slug <small>(Để trống nếu tạo tự động)</small>
                        </label>
                        <div class="">  
                          <input type="text"  name="txtSlug"  class="form-control col-md-7 col-xs-12" value="{{$data->slug}}">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label">Tag</label>
                          <div class="">
                            <select class="form-control tag" name="slTag[]" multiple="multiple">
                                @foreach($tag as $v)
                                    <option <?php foreach($data->tag as $t){ if($t->id == $v->id){ ?> selected <?php }} ?> value="{{$v->id}}" >{{$v->name}}</option>  
                                @endforeach
                            </select>
                          </div>
                        </div>
                      <div class="form-group">  
                        <label class="control-label" >Meta Title <span class="required">*</span>
                        </label>
                        <div class="">
                          <input type="text"  name="txtMetaTitle" class="form-control col-md-7 col-xs-12" value="{{$data->meta_title}}">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label">Chuyên mục</label>
                          <div class="">
                            <select class="form-control" name="slCategory" >       
                              @foreach($category as $v)
                                <option <?php if($data->category->id== $v->id){ ?> selected <?php } ?> value="{{$v->id}}" >{{$v->name}}</option>  
                              @endforeach 
                            </select>
                          </div>
                        </div>

                         <div class="form-group">
                        <label class="control-label ">Ngày tạo<span class="required">*</span>
                        </label>
                        <div class="">
                          <input name="txtCreate" class="date-picker form-control col-md-7 col-xs-12" type="datetime-local" value="{{$data->created_at}}">
                        </div>
                      </div>
                      

                      <div class="form-group">  
                        <label class="control-label" >Mô tả ngắn <span class="required">*</span>
                        </label>
                        <div class="">
                          <input type="text"  name="txtShortDescription" class="form-control col-md-7 col-xs-12" value="{{$data->short_description}}">
                        </div>
                      </div>
                      
                      
                     
                          
                      <div class="form-group">
                        <label class="control-label ">Mô tả<span class="required">*</span>
                        </label>
                        <div class="">
                          
                          <textarea name="txtDescription" class="form-control" rows="5" id="comment">{{$data->meta_description}}</textarea>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label ">Status</label>
                        <div class="">
                            <div class="radio col-md-3 col-sm-6 col-xs-12">
                                <label>
                                  <input type="radio" class="flat" <?php if($data->status ==1){ ?> checked <?php } ?> name="rdStatus" value="1" > Draft
                                </label>
                              </div>
                              <div class="radio col-md-3 col-sm-6 col-xs-12">
                                  <label>
                                    <input type="radio" class="flat" <?php if($data->status ==2){ ?> checked <?php } ?> name="rdStatus" value="2"> Publish
                                  </label>
                              </div>
                          </div>
                      </div>  

                      
                      <div class="form-group">
                        <label class="control-label ">Hình ảnh</label>
                        <div class="">
                            <div class="radio col-md-3 col-sm-6 col-xs-12">
                            <input type="file"  name="fImage"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                        
                      </div>  
                      <div id="preview">
                            <img  src="{{$data->image}}" alt="">
                      </div>
                      <br>

                     <!-- edittor -->
                     <div class="form-group">
                          <label class="control-label ">Nội dung tin tức</label>
                      </div>
                     <textarea name="content">{{$data->content}}</textarea>
                      <script>
                        CKEDITOR.config.height = '500px';
                        CKEDITOR.replace( 'content', {
                          filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                          filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                          filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                          filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                          filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                          filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                          });
                      </script>
                      <!-- end editor -->

                      
                     <br>
                     <br>         
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
         
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



   

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
    
    <script type="text/javascript">
      $(".tag").select2();
  </script> 

  <script type="text/javascript">
    function readURL(input){
      if (input.files&&input.files[0]) {
        var reader=new FileReader();
        reader.onload=function(e){
          $('#preview img').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $(document).on('change','input[type="file"]',function(){
      readURL(this);
    })
  </script>
  </body>
</html>
