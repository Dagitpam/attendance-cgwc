
        $(document).ready(function() {
        $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $("#lga-dropdown").html('');
            $.ajax({
            url:"{{url('get-lga-by-state')}}",
            type: "POST",
            data: {
            state_id: state_id,
            _token: '{{csrf_token()}}'
        },
        dataType : 'json',
        success: function(result){
        $('#lga-dropdown').html('<option value="">Select LGA</option>'); 
        $.each(result.lgas,function(key,value){
        $("#lga-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
        }); 
        }
        });
        });        
        $('#state-dropdown').on('change', function() {
        var state_id = this.value;
        $("#city-dropdown").html('');
        $.ajax({
        url:"{{url('get-cities-by-state')}}",
        type: "POST",
        data: {
        state_id: state_id,
        _token: '{{csrf_token()}}'
        },
        dataType : 'json',
        success: function(result){
        $.each(result.cities,function(key,value){
        $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
        });
        }
        });
        });
        });
    