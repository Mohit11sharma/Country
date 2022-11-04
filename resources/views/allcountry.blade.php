<html>
<head>
    <title>Select Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <style type="text/css">
        .dropdown-toggle{
            height: 40px;
            width: 400px !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6 class="text-white">Select Data</h6>
                    </div>
                    <div class="card-body" id="show_only">
                        <form method="post" action="{{url('add_country')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label>Select Type</label>
                                <select class="form-control selectoption" name="type">
                                  <option>Select category</option>
                                  <option value="Country">Country</option>
                                  <option value="States">States</option>
                                  <option value="Cities">Cities</option>
                                </select>
                            </div>

                            <div class="form-group country d-none">
                                <label>Select Country</label>
                                <select class="form-control" name="country" id="country_id">
                                    <option>Select Country</option>
                                    @foreach($country as $countries)
                                    <option value="{{$countries->id}}">{{$countries->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group state d-none">
                                <label>Select State</label>
                                <select class="form-control" name="state" id="state_id">
                                    <option>Select State</option>
                                    <option value=""></option>
                                </select>
                            </div>

                                <div class="form-group name d-none">
                                    <label>Name :</label>
                                    <input type="text" name="name" class="form-control"/>
                                </div> 

                              
                                <div class="form-group status d-none">
                                    <label>Status :</label>
                                    <input type="text" name="status" class="form-control"/>
                                </div> 
                                <div>
                                  <button type="submit" class="btn btn-success">submit</button>
                                </div> 
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<!-- Initialize the plugin: -->
<script>
        $(document).on("change",".selectoption",function(){
            
            var selectoption = $('.selectoption').val();

                if(selectoption=='Country'){
                    $(".name").removeClass('d-none');
                    $(".status").removeClass('d-none');
                    $(".country").addclass('d-none');
                    $(".state").addclass('d-none');
                }
                if(selectoption=='States'){
                    $(".country").removeClass('d-none');
                    $(".name").removeClass('d-none');
                    $(".status").removeClass('d-none');  
                }

                if(selectoption=='Cities'){
                    $(".country").removeClass('d-none');
                    $(".state").removeClass('d-none');
                    $(".name").removeClass('d-none');
                    $(".status").removeClass('d-none'); 
                }



            $('#country_id').on("change", function(){
               
                var state_id = $(this).val();

            //alert(state_id);


                    $.ajax({
                        url:('ajax_city'),
                        type:"POST",
                     data:{
                            substate:state_id,
                            _token:"{{csrf_token()}}"
                        },
                        
                        :function(res){
                            $('#state_id').html(res);
                        },
                    });
                });
        });

</script>


</html>