 @if($errors->any())
        <div >
            @foreach($errors->all() as $error)
            
               <div class="alert alert-info">
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                        <strong>Warning!</strong> {{$error}}
               </div>
          
            @endforeach
        </div>
  @endif