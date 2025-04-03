    <br>
      
    <br>
<!--Real footer ends from here-->
<script>


function updateSizes(){
	var sizeString = '';
	for(var i=1;i<=12;i++){
		if(jQuery('#size'+i).val() != ''){
			sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
		}
	}
	jQuery('#sizes'). val(sizeString);
}

   function get_child_options(selected){ 
   if( typeof selected === 'object' ){
                    var selected = ' ';
                }    
    var parentID = jQuery('#parent').val();
    jQuery.ajax({
     url: '/webb/admin/aincludes/child.php',
     type: 'POST',
     data: {parentID : parentID,selected: selected},
     success: function(data){
      jQuery('#child').html(data);
     },
     error: function(){alert("Something went wrong with the child options.")},
    }); 
   }
   jQuery('select[name="parent"]').change(get_child_options);   

  </script>
</body>
</html>