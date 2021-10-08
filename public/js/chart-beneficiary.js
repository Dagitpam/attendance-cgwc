var states = @json($states);
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function beneficiaries(state) {
            return state.beneficiaries.length;
        }

        function nameOfState(state) {
            return state.name;
        }

        function drawChart(states) {
            
            var noOfBeneficiaries = states.map(beneficiaries);
            var namesOfStates = states.map(nameOfState);

            var ctx = document.getElementById('states').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: namesOfStates
                    , datasets: [{
                        label: '# Beneficiaries By State'
                        , data: noOfBeneficiaries
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(states);