@if (session('status'))
    <div class="alert alert-success" id='msg'>
       
    </div>

    <script>
    	$("#msg").html("{{session('status')}}").show(300).delay(2000).hide(300); 
    </script>
@endif