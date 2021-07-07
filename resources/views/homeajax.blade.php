<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel with Ajax</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token()}}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
.container{
    margin-top: 50px;
}

  </style>
</head>
<body>

    <div class="container">
       <div class="row">
           <div class="col-md-8">
               <h3>Customer table </h3>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- <tr>
                    <th scope="row">1</th>
                    <td>shovo</td>
                    <td>das</td>
                    <td>shovodas921@gmail.com</td>
                    <td>
                        <a href="" class="btn btn-sm btn-success">Edit</a>
                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr> --}}
            
                </tbody>
              </table>    
        
        </div>
           <div class="col-md-4">
               <h3 id="addca">Add Customer</h3>
               <h3 id="updatec">Update Customer</h3>
           
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Frist Name</label>
                  <input type="text" class="form-control" id="frist_name" placeholder="Frist name">
                  <span class="text-danger" id="frist_name_error" ></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="last name">
                    <span class="text-danger" id="last_name_error" ></span>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <span class="text-danger" id="email_error" ></span>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                  <input type="hidden" id="id">
               
                <button type="submit" id="addbutton" onclick="addData()"  class="btn btn-primary">Add</button>
                <button type="submit"id="updatebutton" onclick="updateData()" class="btn btn-primary">Update</button>
           

           </div>
       </div>

    </div>


    <script>

$('#addca').show();
$('#updatec').hide();
$('#addbutton').show();
$('#updatebutton').hide();


$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function allData(){
    $.ajax ({

        type:"GET",
        dataType:'json',
        
        url:"/customer/all",
        success:function(response){
          var data=""
          var i = 1
           $.each(response,function(key, value)
           {
          
            data = data + "<tr>"
            data = data +"<td>"+i++ +"</td>"
            data = data +"<td>"+value.frist_name+"</td>"
            data = data +"<td>"+value.last_name+"</td>"
            data = data +"<td>"+value.email+"</td>"
            data =data +"<td>"
            data = data + "<button class='btn btn-sm btn-primary mr-2' onclick='edit("+value.id+")'>Edit </button>"
            data = data + "<button class='btn btn-sm btn-danger' onclick='deleteData("+value.id+")'>Delete </button>"
            data =data +"</td>"
            data = data + "</tr>"
           })
            
           $('tbody').html(data);

        }
    });
}
allData();
function allClear()
{
  $('#frist_name').val('');
  $('#last_name').val('');
  $('#email').val('');
}
// add all data

  function addData(){

  var frist_name = $('#frist_name').val();
  var last_name =$('#last_name').val();
  var email =$('#email').val();

$.ajax({

  type:"POST",
  dataType:"json",
  data:{frist_name:frist_name,last_name:last_name,email:email},
  url:"/customer/store",
  success:function(data){
    console.log('successfully  data added');
  },
  error:function(error){
   console.log(error.responseJSON.errors.email);
   console.log(error.responseJSON.errors.frist_name);
   console.log(error.responseJSON.errors.last_name);
  }

})
allClear();
allData();

}

// edit part
function edit(id){
 $.ajax({
  type:"GET",
  dataType:"json",
  url:"/customer/edit/"+id,
  success:function(data){

    $('#addca').hide();
    $('#updatec').show();
    $('#addbutton').hide();
    $('#updatebutton').show();

  $('#id').val(data.id);
  $('#frist_name').val(data.frist_name);
  $('#last_name').val(data.last_name);
  $('#email').val(data.email);
  console.log(data)

  }

 })
}

// update data
function updateData(){
  var id = $('#id').val();
  var frist_name = $('#frist_name').val();
  var last_name =$('#last_name').val();
  var email =$('#email').val();
  $.ajax({
    type:"POST",
    dataType:"json",
    data:{frist_name:frist_name,last_name:last_name,email:email},
    url:"/customer/update/"+id,
    success:function(data){
      console.log('data updated');
      
    },
    error:function(error){
   console.log(error.responseJSON.errors.email);
   console.log(error.responseJSON.errors.frist_name);
   console.log(error.responseJSON.errors.last_name);
  }
  
  })
  allClear();
  allData();
}

// delete data

function deleteData(id){
  $.ajax({

    type:"GET",
    dataType:"json",
    url:"/customer/delete/"+id,
    success:function(data){
    console.log('successfully  data added');
  }

  })
  allData();
}



    </script>
    
    </body>
</html>
