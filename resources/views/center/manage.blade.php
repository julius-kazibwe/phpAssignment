@extends('backend.l')
@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')
<div class="container">
<script>
    function redirect(){
        window.location.replace("/manage/centers");
    }
</script>
<div >  
<form method="POST" action="centers/search">
        <input name="search_text" placeholder="Name, location" />
        <button type="submit" {{$disabled}}> Search </button>   
        <button type="button" onclick= "redirect()" > Reset </button>
</form>
       
</div>
 @if(isset($centers))
 No of results returned: {{ $centers->count()}}
    <table class="table  .table-striped " id="center_table">
    <thead>
        <tr>
            <th> Name </th>
            <th> Location </th>
			<th> Vaccine </th>
            <th> Schedule</th>
            
            
        </tr>
     </thead>
    <tbody>
        @foreach($centers as $center )
        <tr id= "{{ $center->center_name . ' ' . $center->location }}" >
            <td> {{$center->center_name }} </td>
            <td> {{$center->location}} </td>
			 <td> {{$center_vaccines[$center->center_id]}} </td>
            <td> 
            <!-- redirect the user to the scheduling page for doctors of the schedule controller -->
                <form method="post" action="/manage/schedule/center/{{$center['center_id']}}">
                @method('GET')
                    <button type="submit" class="btn btn-primary" style= "background-color: green">Schedule</button>                       
                </form>
            </td>
            
            
        </tr>
        @endforeach
        </tbody>
        </table>

        
@else
    <!--Redirect this page to an appropiate error message -->
    An error ocurred.
@endif
</div>
@endsection