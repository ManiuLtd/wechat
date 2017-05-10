 $("#merchant_id").change(function(){
            var val = $(this).val()
            var urls="/admin/merchant/ajax_agents";
            var con = '';
            $.ajax({
                dataType:"json",
                type:"post",
                url:urls,
                async:true,
                data:{
                    id: val
                },
                success:function(wbObj){
                	
                  $.each(wbObj,function(i,v){
                       con += '<option value='+v.id+'>'+v.name+'</option>';
                  })
          		  $('#agent_id').html(con)
          		  $('#agent_id').trigger('change')
                }
            });
        })

        $("#agent_id").change(function(){
            var val = $(this).val()
            var urls="/admin/agent/ajax_products";
            var pcon = '';
            $.ajax({
                dataType:"json",
                type:"post",
                url:urls,
                async:true,
                data:{
                    id: val
                },
                success:function(wObj){
                	var pli = '';
                	$.each(wObj,function(i,v){
                	
            			pli+="<li class='list-group-item'><span class='badge badge-info'>"+v.name+"</span><div>";

            			$.each(v.goods,function(item,val){
							 pli +="<p class='pfloat'><input name='ids[]' type='checkbox' value="+val.id+">"+val.productName+"</p><p><input type='number' name=val-"+val.id+" class='pf' placeholder='数量'></p>"
            			});

            			pli+="</div></li>";
                	})

                	if(pli == ''){
                		pli = '<p class="text-center">暂无商品</p>';
                		$('.panel-footer').hide()
                	}else{
                		$('.panel-footer').show()
                	}
                	$('#productlist').html(pli)
                }
            });
        })

        $('#merchant_id').trigger('change')